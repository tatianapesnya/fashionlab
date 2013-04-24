<?php

class PMXI_Import_Record extends PMXI_Model_Record {
	
	/**
	 * Some pre-processing logic, such as removing control characters from xml to prevent parsing errors
	 * @param string $xml
	 */
	public static function preprocessXml( & $xml) {		
		
		$xml = str_replace("&", "&amp;", str_replace("&amp;","&", $xml));
		
	}

	/**
	 * Validate XML to be valid for improt
	 * @param string $xml
	 * @param WP_Error[optional] $errors
	 * @return bool Validation status
	 */
	public static function validateXml( & $xml, $errors = NULL) {
		if (FALSE === $xml or '' == $xml) {
			$errors and $errors->add('form-validation', __('XML file does not exist, not accessible or empty', 'pmxi_plugin'));
		} else {
						
			PMXI_Import_Record::preprocessXml($xml);																						

			libxml_use_internal_errors(true);
			libxml_clear_errors();
			$_x = @simplexml_load_string($xml);
			$xml_errors = libxml_get_errors();			
			libxml_clear_errors();
			if ($xml_errors) {								
				$error_msg = '<strong>' . __('Invalid XML', 'pmxi_plugin') . '</strong><ul>';
				foreach($xml_errors as $error) {
					$error_msg .= '<li>';
					$error_msg .= __('Line', 'pmxi_plugin') . ' ' . $error->line . ', ';
					$error_msg .= __('Column', 'pmxi_plugin') . ' ' . $error->column . ', ';
					$error_msg .= __('Code', 'pmxi_plugin') . ' ' . $error->code . ': ';
					$error_msg .= '<em>' . trim(esc_html($error->message)) . '</em>';
					$error_msg .= '</li>';
				}
				$error_msg .= '</ul>';
				$errors and $errors->add('form-validation', $error_msg);				
			} else {
				return true;
			}
		}
		return false;
	}

	/**
	 * Initialize model instance
	 * @param array[optional] $data Array of record data to initialize object with
	 */
	public function __construct($data = array()) {
		parent::__construct($data);
		$this->setTable(PMXI_Plugin::getInstance()->getTablePrefix() . 'imports');
	}

	/**
	 * Check whether current import should be perfomed again according to scheduling options
	 */
	public function isDue()
	{
		if ( ! $this->scheduled or date('YmdHi') <= date('YmdHi', strtotime($this->registered_on))) return false; // scheduling is disabled or the task has been executed this very minute
		if ('0000-00-00 00:00:00' == $this->registered_on) return true; // never executed but scheduled
		
		$task = new _PMXI_Import_Record_Cron_Parser($this->scheduled);
		return $task->isDue($this->registered_on);
	}
	
	/**
	 * Import all files matched by path
	 * @param callback[optional] $logger Method where progress messages are submmitted
	 * @return PMXI_Import_Record
	 * @chainable
	 */
	public function execute($logger = NULL, $cron = true) {
		$this->set('registered_on', date('Y-m-d H:i:s'))->save(); // update registered_on to indicated that job has been exectured even if no files are going to be imported by the rest of the method
		
		$uploads = wp_upload_dir();	

		if ($this->path) {
			if (in_array($this->type, array('ftp'))) { // file paths support patterns
				$logger and call_user_func($logger, __('Reading files for import...', 'pmxi_plugin'));
				$files = PMXI_Helper::safe_glob($this->path, PMXI_Helper::GLOB_NODIR | PMXI_Helper::GLOB_PATH);
				$logger and call_user_func($logger, sprintf(_n('%s file found', '%s files found', count($files), 'pmxi_plugin'), count($files)));
			} else {  // single file path
				$files = array($this->path);
			}
			
			foreach ($files as $ind => $path) {

				!$cron and $logger and call_user_func($logger, sprintf(__('Importing %s (%s of %s)', 'pmxi_plugin'), $path, $ind + 1, count($files)));

				if ($this->type == 'url'){

					if ('zip' == $this->feed_type or '' == $this->feed_type and preg_match('%\W(zip)$%i', trim($path))) {		

						$filePath = '';					
						
						if ((empty($this->large_import) or $this->large_import == 'No') or ( ! $this->queue_chunk_number and $this->processing == 0 )) {

							$tmpname = $uploads['path'] . '/' . wp_unique_filename($uploads['path'], basename($path));

							@copy($path, $tmpname);				
							
							if (!file_exists($tmpname)) {
								
								get_file_curl($path, $tmpname);

							    if (!file_exists($tmpname)) $this->errors->add('form-validation', __('Failed upload ZIP archive', 'pmxi_plugin'));
							
							}							

							include_once(PMXI_Plugin::ROOT_DIR.'/libraries/pclzip.lib.php');

							$archive = new PclZip($tmpname);
						    if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, $uploads['path'], PCLZIP_OPT_REPLACE_NEWER)) == 0) {
						    	$this->errors->add('form-validation', 'Failed to open uploaded ZIP archive : '.$archive->errorInfo(true));			    	
						   	}
							else {																

								if (!empty($v_result_list)){
									foreach ($v_result_list as $unzipped_file) {
										if ($unzipped_file['status'] == 'ok') $filePath = $unzipped_file['filename'];
									}
								}
						    	if($uploads['error']){
									 $this->errors->add('form-validation', __('Can not create upload folder. Permision denied', 'pmxi_plugin'));
								}

								if(empty($filePath)){						
									$zip = zip_open(trim($tmpname));
									if (is_resource($zip)) {
										
										$filePath = '';
										while ($zip_entry = zip_read($zip)) {
											$filePath = zip_entry_name($zip_entry);												
										    $fp = fopen($uploads['path']."/".$filePath, "w");
										    if (zip_entry_open($zip, $zip_entry, "r")) {
										      $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
										      fwrite($fp,"$buf");
										      zip_entry_close($zip_entry);
										      fclose($fp);
										    }
										    break;
										}
										zip_close($zip);							

									} else {
								        $this->errors->add('form-validation', __('Failed to open uploaded ZIP archive. Can\'t extract files.', 'pmxi_plugin'));
								    }						
								}

								if (preg_match('%\W(csv)$%i', trim($filePath))){
																
									if (empty($this->large_import) or $this->large_import == 'No') {
										$filePath = PMXI_Plugin::csv_to_xml($filePath);																	
									}
									elseif ( $this->queue_chunk_number == 0 and $this->processing == 0 ) {
									
										$this->set(array('processing' => 1))->save(); // lock cron requests		

										include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');
										$csv = new PMXI_CsvParser($filePath, true); // create chunks
										$filePath = $csv->xml_path;									   					  

										$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process    					  

									}	
									else $filePath = '';

								}							
							}
						}
						
					} elseif ('csv' == $this->feed_type or '' == $this->feed_type and preg_match('%\W(csv)$%i', trim($path))) {																				

						if (empty($this->large_import) or $this->large_import == 'No') {																				
							// copy remote file in binary mode
							$filePath = pmxi_copy_url_file($path);									
							$filePath = PMXI_Plugin::csv_to_xml($filePath); // convert CSV to XML																					
						}
						elseif ( $this->queue_chunk_number == 0 and $this->processing == 0 ) {	

							$this->set(array('processing' => 1))->save(); // lock cron requests	
							// copy remote file in binary mode
							$filePath = pmxi_copy_url_file($path);									
							include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');					
							$csv = new PMXI_CsvParser($filePath, true); // create chunks
							$filePath = $csv->xml_path;	

							$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process    					  					
						}
						else $filePath = '';

					} else {
						
						if (empty($this->large_import) or $this->large_import == 'No') {	
							$fileInfo = ('gz' == $this->feed_type or '' == $this->feed_type and preg_match('%\W(gz)$%i', trim($path))) ? pmxi_gzfile_get_contents($path) : pmxi_copy_url_file($path, true);
							$filePath = $fileInfo['localPath'];				
							// detect CSV or XML 										
							if ( $fileInfo['type'] == 'csv') { // it is CSV file
								$filePath = PMXI_Plugin::csv_to_xml($filePath); // convert CSV to XML																						
							}
						} elseif( $this->queue_chunk_number == 0 and $this->processing == 0 ){
							
							$this->set(array('processing' => 1))->save(); // lock cron requests

							$fileInfo = ('gz' == $this->feed_type or '' == $this->feed_type and preg_match('%\W(gz)$%i', trim($path))) ? pmxi_gzfile_get_contents($path) : pmxi_copy_url_file($path, true);
							$filePath = $fileInfo['localPath'];		
							// detect CSV or XML 
							if ( $fileInfo['type'] == 'csv') { // it is CSV file																												
								include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');					
								$csv = new PMXI_CsvParser($filePath, true); // create chunks
								$filePath = $csv->xml_path;								
							}

							$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process 
						}											
					}

				} else { // if import type NOT URL

					if ($this->type == 'ftp'){
					
						// path to remote file
						$remote_file = $this->path;
										
						// set up basic connection
						$ftp_url = $this->path;
						$parsed_url = parse_url($ftp_url);
						$ftp_server = $parsed_url['host'] ;
						$conn_id = ftp_connect( $ftp_server );
						$is_ftp_ok = TRUE;				

						// login with username and password
						$ftp_user_name = $parsed_url['user'];
						$ftp_user_pass = urldecode($parsed_url['pass']);

						// hide warning message
						echo '<span style="display:none">';
						if ( !ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) ){
							$this->errors->add('form-validation', __('Login authentication failed', 'pmxi_plugin'));
							$is_ftp_ok = false;
						}
						echo '</span>';

						if ( $is_ftp_ok ){						

							$filePath = $uploads['path']  .'/'. basename($path);										
							
							get_file_curl($path, $filePath);						

							// close the connection and the file handler
							ftp_close($conn_id);

							$path = $filePath;

						}					

					}

					if (preg_match('%\W(zip)$%i', trim(basename($path)))) {
						
						include_once(PMXI_Plugin::ROOT_DIR.'/libraries/pclzip.lib.php');

						$archive = new PclZip(trim($path));
					    if (($v_result_list = $archive->extract(PCLZIP_OPT_PATH, $uploads['path'], PCLZIP_OPT_REPLACE_NEWER)) == 0) {
					    	$this->errors->add('form-validation', 'Failed to open uploaded ZIP archive : '.$archive->errorInfo(true));			    	
					   	}
						else {
							
							$filePath = '';

							if (!empty($v_result_list)){
								foreach ($v_result_list as $unzipped_file) {
									if ($unzipped_file['status'] == 'ok') $filePath = $unzipped_file['filename'];
								}
							}
					    	if($uploads['error']){
								 $this->errors->add('form-validation', __('Can not create upload folder. Permision denied', 'pmxi_plugin'));
							}

							if(empty($filePath)){						
								$zip = zip_open(trim($path));
								if (is_resource($zip)) {																		
									while ($zip_entry = zip_read($zip)) {
										$filePath = zip_entry_name($zip_entry);												
									    $fp = fopen($uploads['path']."/".$filePath, "w");
									    if (zip_entry_open($zip, $zip_entry, "r")) {
									      $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
									      fwrite($fp,"$buf");
									      zip_entry_close($zip_entry);
									      fclose($fp);
									    }
									    break;
									}
									zip_close($zip);							

								} else {
							        $this->errors->add('form-validation', __('Failed to open uploaded ZIP archive. Can\'t extract files.', 'pmxi_plugin'));
							    }						
							}																					

							if (preg_match('%\W(csv)$%i', trim($filePath))){ // If CSV file found in archieve						

								if($uploads['error']){
									 $this->errors->add('form-validation', __('Can not create upload folder. Permision denied', 'pmxi_plugin'));
								}																		
								if (empty($this->large_import) or $this->large_import == 'No') {
									$filePath = PMXI_Plugin::csv_to_xml($filePath);																	
								}
								elseif ( $this->queue_chunk_number == 0 and $this->processing == 0 ){	

									$this->set(array('processing' => 1))->save(); // lock cron requests	

									include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');
									$csv = new PMXI_CsvParser($filePath, true); // create chunks
									$filePath = $csv->xml_path;					

									$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process

								}
								else $filePath = '';
							}							
						}							

					} elseif ( preg_match('%\W(csv)$%i', trim($path))) { // If CSV file uploaded										
						if($uploads['error']){
							 $this->errors->add('form-validation', __('Can not create upload folder. Permision denied', 'pmxi_plugin'));
						}									
		    			
		    			$filePath = $post['filepath'];					
						
						if (empty($this->large_import) or $this->large_import == 'No') {
							$filePath = PMXI_Plugin::csv_to_xml($path);					
						} 
						elseif ( $this->queue_chunk_number == 0 and $this->processing == 0 ) {		

							$this->set(array('processing' => 1))->save(); // lock cron requests	

							include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');					
							$csv = new PMXI_CsvParser($path, true);					
							$filePath = $csv->xml_path;			

							$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process			
						}
						else $filePath = '';	

					} elseif(preg_match('%\W(gz)$%i', trim($path))) { // If gz file uploaded
						$fileInfo = pmxi_gzfile_get_contents($path);
						$filePath = $fileInfo['localPath'];		

						// detect CSV or XML 
						if ( $fileInfo['type'] == 'csv') { // it is CSV file									
							if (empty($this->large_import) or $this->large_import == 'No') {																
								$filePath = PMXI_Plugin::csv_to_xml($filePath); // convert CSV to XML																						
							}
							elseif ( $this->queue_chunk_number == 0 and $this->processing == 0 ) {	

								$this->set(array('processing' => 1))->save(); // lock cron requests

								include_once(PMXI_Plugin::ROOT_DIR.'/libraries/XmlImportCsvParse.php');					
								$csv = new PMXI_CsvParser($filePath, true); // create chunks
								$filePath = $csv->xml_path;		

								$this->set(array('queue_chunk_number' => 1, 'processing' => 0))->save(); // set pointer to the first chunk and unlock cron process																				
							}
							else $filePath = '';
						}					

					} else $filePath = $path;
				}
				
				// if empty file path, than it's mean feed in cron process. Take feed path from history.
				if (empty($filePath)){
					$history = new PMXI_File_List();
					$history->setColumns('id', 'name', 'registered_on', 'path')->getBy(array('import_id' => $this->id), 'id DESC');				
					if ($history->count()){
						$history_file = new PMXI_File_Record();
						$history_file->getBy('id', $history[0]['id']);
						$filePath =	$history_file->path;						
					}
				}
				
				// if feed path founded
				if ( ! empty($filePath) ) {

					if ( $this->large_import == 'Yes' and $this->queue_chunk_number == 1 and $this->processing == 0 ){ // large import first cron request

						$this->set(array('processing' => 1))->save(); // lock cron requests																		
						
						set_time_limit(0);							

						$file = new PMXI_Chunk($filePath, array('element' => $this->root_element, 'path' => $uploads['path']));					
					    
					    // chunks counting		    
					    $chunks = 0;
					    while ($xml = $file->read()) {
					    	if (!empty($xml)) {				
					    		$xml = $file->encoding . "\n" . $xml;
					      		PMXI_Import_Record::preprocessXml($xml);
						      	$dom = new DOMDocument('1.0', 'UTF-8');
								$old = libxml_use_internal_errors(true);
								$dom->loadXML(preg_replace('%xmlns\s*=\s*([\'"]).*\1%sU', '', $xml)); // FIX: libxml xpath doesn't handle default namespace properly, so remove it upon XML load
								libxml_use_internal_errors($old);
								$xpath = new DOMXPath($dom);
								if (($elements = @$xpath->query($this->xpath)) and $elements->length) $chunks++;
								unset($dom, $xpath, $elements);
						    }
						}
						unset($file);

						$this->set(array('count' => $chunks, 'processing' => 0))->save(); // set pointer to the first chunk, updates feed elements count and unlock cron process					    

					} elseif ($this->large_import == 'No') {
						ob_start();
						$filePath && @readgzfile($filePath);					
						$xml = ob_get_clean();										
				
						if (empty($xml)) {
							$xml = @file_get_contents($filePath);										
							if (empty($xml)) get_file_curl($filePath, $uploads['path']  .'/'. basename($filePath));
							if (empty($xml)) $xml = @file_get_contents($uploads['path']  .'/'. basename($filePath));
						}
					}
					if (($this->large_import == 'Yes' and $this->queue_chunk_number == 1 and $this->processing == 0) or $this->large_import == 'No'){						

						// update history
						$history_file = new PMXI_File_Record();
						$history_file->set(array(
							'name' => $this->name,
							'import_id' => $this->id,
							'path' => $filePath,
							'contents' => (isset($xml)) ? $xml : '',
							'registered_on' => date('Y-m-d H:i:s'),
						))->save();
					}
				}
											
				do_action( 'pmxi_before_xml_import', $this->id );					

				// compose data to look like result of wizard steps									
				if (empty($this->large_import) or $this->large_import == 'No'){

					PMXI_Import_Record::preprocessXml($xml);					

					$this->process($xml, false, false, $cron );

				}
				elseif( $this->large_import == 'Yes' and $this->queue_chunk_number and $this->processing == 0 ){	

					$this->set(array('processing' => 1))->save(); // lock cron requests						

					set_time_limit(0);							

					$file = new PMXI_Chunk($filePath, array('element' => $this->root_element, 'path' => $uploads['path']));					
				    
				    $loop = 1; $start_cron = time();
				    while ($xml = $file->read()) {					      						    					    					    					    	
				    	if (!empty($xml)) {				 
				    		$xml = $file->encoding . "\n" . $xml;     	
				      		PMXI_Import_Record::preprocessXml($xml);	      						      							      					      							      					      		
					      	$dom = new DOMDocument('1.0', 'UTF-8');															
							$old = libxml_use_internal_errors(true);
							$dom->loadXML(preg_replace('%xmlns\s*=\s*([\'"]).*\1%sU', '', $xml)); // FIX: libxml xpath doesn't handle default namespace properly, so remove it upon XML load							
							libxml_use_internal_errors($old);
							$xpath = new DOMXPath($dom);
							if (($elements = @$xpath->query($this->xpath)) and $elements->length){
								if ($loop >= $this->queue_chunk_number){
									$this->process($xml, false, $this->queue_chunk_number, $cron);
									if ( $this->count != $this->queue_chunk_number ) $this->set(array('queue_chunk_number' => $this->queue_chunk_number + 1))->save();								  		
								}
								$loop++;
							}
							unset($dom, $xpath, $elements);							
					    }
					    if (time() - $start_cron > 120) // (2 mins) skipping scheduled imports if any for the next hit					    	
					    	break; 
					    
					}
					unset($file);			

					$this->set(array('processing' => 0))->save(); // unlock cron requests			

					// delect, if cron process if finished
					if ( $this->count == $this->queue_chunk_number ){
						
						if (! empty($this->options['is_delete_missing'])){
							$postList = new PMXI_Post_List();				
							$current_post_ids = (empty($this->current_post_ids)) ? array() : json_decode($this->current_post_ids, true);	
							$missing_ids = array();
							foreach ($postList->getBy(array('import_id' => $this->id, 'post_id NOT IN' => $current_post_ids)) as $missingPost) {
								empty($this->options['is_keep_attachments']) and wp_delete_attachments($missingPost['post_id']);
								$missing_ids[] = $missingPost['post_id'];
								
								$sql = "delete a
								FROM ".PMXI_Plugin::getInstance()->getTablePrefix()."posts a
								WHERE a.id=%d";
								
								$this->wpdb->query( 
									$this->wpdb->prepare($sql, $missingPost['id'])
								);
																
							}

							if (!empty($missing_ids) && is_array($missing_ids)){
								$sql = "delete a,b,c
								FROM ".$this->wpdb->posts." a
								LEFT JOIN ".$this->wpdb->term_relationships." b ON ( a.ID = b.object_id )
								LEFT JOIN ".$this->wpdb->postmeta." c ON ( a.ID = c.post_id )				
								WHERE a.ID IN (".implode(',', $missing_ids).");";

								$this->wpdb->query( 
									$this->wpdb->prepare($sql, '')
								);
							}
						}

						$this->set(array(
							'processing' => 0,
							'triggered' => 0,
							'queue_chunk_number' => 0,
							'current_post_ids' => ''
						))->save();
					}					
				}

				do_action( 'pmxi_after_xml_import', $this->id );			

			}			
		}
		return $this;
	}
	
	/**
	 * Perform import operation
	 * @param string $xml XML string to import
	 * @param callback[optional] $logger Method where progress messages are submmitted
	 * @return PMXI_Import_Record
	 * @chainable
	 */
	public function process($xml, $logger = NULL, $chunk = false, $is_cron = false) {
		add_filter('user_has_cap', array($this, '_filter_has_cap_unfiltered_html')); kses_init(); // do not perform special filtering for imported content
		
		$this->options += PMXI_Plugin::get_default_import_options(); // make sure all options are defined
		// If import process NOT in large file mode the save history file

		$postRecord = new PMXI_Post_Record();
		
		$tmp_files = array();
		// compose records to import
		$records = array();
		$chunk_records = array();
		if ($this->options['is_import_specified']) {
			foreach (preg_split('% *, *%', $this->options['import_specified'], -1, PREG_SPLIT_NO_EMPTY) as $chank) {
				if (preg_match('%^(\d+)-(\d+)$%', $chank, $mtch)) {
					$records = array_merge($records, range(intval($mtch[1]), intval($mtch[2])));
				} else {
					$records = array_merge($records, array(intval($chank)));
				}
			}
			
			$chunk_records = $records;

			if ($this->large_import == 'Yes' and !empty($records)){

				$_SESSION['pmxi_import']['count'] = count($records);								

				$records_count = $_SESSION['pmxi_import']['created_records'] + $_SESSION['pmxi_import']['updated_records'] + $_SESSION['pmxi_import']['skipped_records'] + $_SESSION['pmxi_import']['errors'];

				if (!in_array($chunk, $records) and (!$this->options['create_chunks'] or $is_cron)){
					$logger and call_user_func($logger, __('<b>SKIPPED</b>: by specified records option', 'pmxi_plugin'));
					$_SESSION['pmxi_import']['warnings']++;
					// Time Elapsed
					if ( ! $is_cron ){						
						$progress_msg = '<p class="import_process_bar"> Created ' . $_SESSION['pmxi_import']['created_records'] . ' / Updated ' . $_SESSION['pmxi_import']['updated_records'] . ' of '. $_SESSION['pmxi_import']['count'].' records.</p><span class="import_percent">' . ceil(($records_count/$_SESSION['pmxi_import']['count']) * 100) . '</span><span class="warnings_count">' .  $_SESSION['pmxi_import']['warnings'] . '</span><span class="errors_count">' . $_SESSION['pmxi_import']['errors'] . '</span>';
						$logger and call_user_func($logger, $progress_msg);
					}
					$_SESSION['pmxi_import']['chunk_number']++;
					return;
				}
				else $records = array();
			}				
		}
		try { 						
			
			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing titles...', 'pmxi_plugin'));
			$titles = XmlImportParser::factory($xml, $this->xpath, $this->template['title'], $file)->parse($records); $tmp_files[] = $file;
			if ($this->large_import != 'Yes') $_SESSION['pmxi_import']['count'] = count($titles);

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing excerpts...', 'pmxi_plugin'));			
			$post_excerpt = array();
			if (!empty($this->options['post_excerpt'])){
				$post_excerpt = XmlImportParser::factory($xml, $this->xpath, $this->options['post_excerpt'], $file)->parse($records); $tmp_files[] = $file;
			}
			else{
				count($titles) and $post_excerpt = array_fill(0, count($titles), '');
			}

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing authors...', 'pmxi_plugin'));			
			$post_author = array();
			$current_user = wp_get_current_user();

			if (!empty($this->options['author'])){
				$post_author = XmlImportParser::factory($xml, $this->xpath, $this->options['author'], $file)->parse($records); $tmp_files[] = $file;
				foreach ($post_author as $key => $author) {
					$user = get_user_by('login', $author) or $user = get_user_by('slug', $author) or $user = get_user_by('email', $author) or ctype_digit($author) and $user = get_user_by('id', $author);
					$post_author[$key] = (!empty($user)) ? $user->ID : $current_user->ID;
				}
			}
			else{								
				count($titles) and $post_author = array_fill(0, count($titles), $current_user->ID);
			}			

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing slugs...', 'pmxi_plugin'));			
			$post_slug = array();
			if (!empty($this->options['post_slug'])){
				$post_slug = XmlImportParser::factory($xml, $this->xpath, $this->options['post_slug'], $file)->parse($records); $tmp_files[] = $file;
			}
			else{
				count($titles) and $post_slug = array_fill(0, count($titles), '');
			}

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing contents...', 'pmxi_plugin'));			 						
			$contents = XmlImportParser::factory(
				(intval($this->template['is_keep_linebreaks']) ? $xml : preg_replace('%\r\n?|\n%', ' ', $xml)),
				$this->xpath,
				$this->template['content'],
				$file)->parse($records
			); $tmp_files[] = $file;						
										
			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing dates...', 'pmxi_plugin'));
			if ('specific' == $this->options['date_type']) {
				$dates = XmlImportParser::factory($xml, $this->xpath, $this->options['date'], $file)->parse($records); $tmp_files[] = $file;
				$warned = array(); // used to prevent the same notice displaying several times
				foreach ($dates as $i => $d) {
					$time = strtotime($d);
					if (FALSE === $time) {
						in_array($d, $warned) or $logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: unrecognized date format `%s`, assigning current date', 'pmxi_plugin'), $warned[] = $d));
						$_SESSION['pmxi_import']['warnings']++;
						$time = time();
					}
					$dates[$i] = date('Y-m-d H:i:s', $time);
				}
			} else {
				$dates_start = XmlImportParser::factory($xml, $this->xpath, $this->options['date_start'], $file)->parse($records); $tmp_files[] = $file;
				$dates_end = XmlImportParser::factory($xml, $this->xpath, $this->options['date_end'], $file)->parse($records); $tmp_files[] = $file;
				$warned = array(); // used to prevent the same notice displaying several times
				foreach ($dates_start as $i => $d) {
					$time_start = strtotime($dates_start[$i]);
					if (FALSE === $time_start) {
						in_array($dates_start[$i], $warned) or $logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: unrecognized date format `%s`, assigning current date', 'pmxi_plugin'), $warned[] = $dates_start[$i]));
						$_SESSION['pmxi_import']['warnings']++;
						$time_start = time();
					}
					$time_end = strtotime($dates_end[$i]);
					if (FALSE === $time_end) {
						in_array($dates_end[$i], $warned) or $logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: unrecognized date format `%s`, assigning current date', 'pmxi_plugin'), $warned[] = $dates_end[$i]));
						$_SESSION['pmxi_import']['warnings']++;
						$time_end = time();
					}					
					$dates[$i] = date('Y-m-d H:i:s', mt_rand($time_start, $time_end));
				}
			}
			
			$tags = array();
			if ($this->options['tags']) {
				($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing tags...', 'pmxi_plugin'));
				$tags_raw = XmlImportParser::factory($xml, $this->xpath, $this->options['tags'], $file)->parse($records); $tmp_files[] = $file;

				foreach ($tags_raw as $i => $t_raw) {
					$tags[$i] = '';
					if ('' != $t_raw){
						$tags[$i] = implode(', ', str_getcsv($t_raw, $this->options['tags_delim']));
						//var_dump( $this->options['tags_delim'], str_getcsv($t_raw, $this->options['tags_delim']));exit;
					}
				}
			} else {
				count($titles) and $tags = array_fill(0, count($titles), '');
			}

			// [posts categories]
			require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');

			if ('post' == $this->options['type']) {				
								
				$cats = array();

				$categories_hierarchy = (!empty($this->options['categories'])) ?  json_decode($this->options['categories']) : array();

				if ((!empty($categories_hierarchy) and is_array($categories_hierarchy))){						

					($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing categories...', 'pmxi_plugin'));
					$categories = array();
					
					foreach ($categories_hierarchy as $k => $category): if ("" == $category->xpath) continue;							
						$cats_raw = XmlImportParser::factory($xml, $this->xpath, str_replace('\'','"',$category->xpath), $file)->parse($records); $tmp_files[] = $file;										
						$warned = array(); // used to prevent the same notice displaying several times
						foreach ($cats_raw as $i => $c_raw) {
							if (empty($categories_hierarchy[$k]->cat_ids[$i])) $categories_hierarchy[$k]->cat_ids[$i] = array();
							if (empty($cats[$i])) $cats[$i] = array();
							$count_cats = count($cats[$i]);							
							if ('' != $c_raw) foreach (str_getcsv($c_raw, html_entity_decode($this->options['categories_delim'])) as $c_cell) if ('' != $c_cell) {
								$delimeted_categories = explode(html_entity_decode($this->options['categories_delim']),  html_entity_decode($c_raw));								
								if (!empty($delimeted_categories)){
									foreach ($delimeted_categories as $j => $cc) if ('' != $cc) {
										$cat = get_term_by('name', trim($cc), 'category') or $cat = get_term_by('slug', trim($cc), 'category') or ctype_digit($cc) and $cat = get_term_by('id', trim($cc), 'category');									
										if ( !empty($category->parent_id) ) {
											foreach ($categories_hierarchy as $key => $value){
												if ($value->item_id == $category->parent_id and !empty($value->cat_ids[$i])){												
													foreach ($value->cat_ids[$i] as $parent) {		
														if (!$j or !$this->options['categories_auto_nested']){
															$cats[$i][] = array(
																'name' => trim($cc),
																'parent' => (is_array($parent)) ? $parent['name'] : $parent, // if parent taxonomy exists then return ID else return TITLE
																'assign' => $category->assign
															);
														}
														elseif($this->options['categories_auto_nested']){
															$cats[$i][] = array(
																'name' => trim($cc),
																'parent' => $delimeted_categories[$j - 1], // if parent taxonomy exists then return ID else return TITLE
																'assign' => $category->assign
															);	
														}													
													}
												}
											}
										}
										else {
											if (!$j or !$this->options['categories_auto_nested']){
												$cats[$i][] = array(
													'name' => trim($cc),
													'parent' => false,
													'assign' => $category->assign
												);
											}
											elseif ($this->options['categories_auto_nested']){
												$cats[$i][] = array(
													'name' => trim($cc),
													'parent' => $delimeted_categories[$j - 1],
													'assign' => $category->assign
												);
											}
											
										}
									}
								}
							}
							if ($count_cats < count($cats[$i])) $categories_hierarchy[$k]->cat_ids[$i][] = $cats[$i][count($cats[$i]) - 1];
						}						
					endforeach;					
				} else{
					count($titles) and $cats = array_fill(0, count($titles), '');
				}
				
			}			
			// [/posts categories]
			
			// [custom taxonomies]
			$taxonomies = array();
			$taxonomies_param = $this->options['type'].'_taxonomies';
			if ('page' == $this->options['type']) {
				$taxonomies_object_type = 'page';
			} elseif ('' != $this->options['custom_type']) {
				$taxonomies_object_type = $this->options['custom_type'];
			} else {
				$taxonomies_object_type = 'post';
			}

			if (!empty($this->options[$taxonomies_param]) and is_array($this->options[$taxonomies_param])): foreach ($this->options[$taxonomies_param] as $tx_name => $tx_template) if ('' != $tx_template) {
				$tx = get_taxonomy($tx_name);				
				if (in_array($taxonomies_object_type, $tx->object_type)) {
					($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, sprintf(__('Composing terms for `%s` taxonomy...', 'pmxi_plugin'), $tx->labels->name));
					$txes = array();
					
					$taxonomies_hierarchy = json_decode($tx_template);
					foreach ($taxonomies_hierarchy as $k => $taxonomy){	if ("" == $taxonomy->xpath) continue;								
						$txes_raw =  XmlImportParser::factory($xml, $this->xpath, str_replace('\'','"',$taxonomy->xpath), $file)->parse($records); $tmp_files[] = $file;						
						$warned = array();
						foreach ($txes_raw as $i => $tx_raw) {
							if (empty($taxonomies_hierarchy[$k]->txn_names[$i])) $taxonomies_hierarchy[$k]->txn_names[$i] = array();
							if (empty($taxonomies[$tx_name][$i])) $taxonomies[$tx_name][$i] = array();
							$count_cats = count($taxonomies[$tx_name][$i]);
							if ('' != $tx_raw) foreach (str_getcsv($tx_raw, (!empty($taxonomy->delim)) ? html_entity_decode($taxonomy->delim) : ',') as $tx_cell) if ('' != $tx_cell) {										
								$delimeted_taxonomies = str_getcsv(html_entity_decode($tx_cell), (!empty($taxonomy->delim)) ? html_entity_decode($taxonomy->delim) : ',');
								foreach ($delimeted_taxonomies as $j => $cc) if ('' != $cc) {									
									$cat = get_term_by('name', trim($cc), $tx_name) or $cat = get_term_by('slug', trim($cc), $tx_name) or ctype_digit($cc) and $cat = get_term_by('id', $cc, $tx_name);
									if (!empty($taxonomy->parent_id)) {																			
										foreach ($taxonomies_hierarchy as $key => $value){
											if ($value->item_id == $taxonomy->parent_id and !empty($value->txn_names[$i])){													
												foreach ($value->txn_names[$i] as $parent) {	
													if (!$j or !$taxonomy->auto_nested){																																																																
														$taxonomies[$tx_name][$i][] = array(
															'name' => trim($cc),
															'parent' => $parent,
															'assign' => $taxonomy->assign
														);
													}
													elseif ($taxonomy->auto_nested){
														$taxonomies[$tx_name][$i][] = array(
															'name' => trim($cc),
															'parent' => $delimeted_taxonomies[$j - 1],
															'assign' => $taxonomy->assign
														);
													}																	
												}											
											}
										}
										
									}
									else {	
										if (!$j or !$taxonomy->auto_nested){
											$taxonomies[$tx_name][$i][] = array(
												'name' => trim($cc),
												'parent' => false,
												'assign' => $taxonomy->assign
											);
										}
										elseif ($taxonomy->auto_nested) {
											$taxonomies[$tx_name][$i][] = array(
												'name' => trim($cc),
												'parent' => $delimeted_taxonomies[$j - 1],
												'assign' => $taxonomy->assign
											);
										}
									}
								}	
							}
							if ($count_cats < count($taxonomies[$tx_name][$i])) $taxonomies_hierarchy[$k]->txn_names[$i][] = $taxonomies[$tx_name][$i][count($taxonomies[$tx_name][$i]) - 1];
						}
					}
				}
			}; endif;
			// [/custom taxonomies]			

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing custom parameters...', 'pmxi_plugin'));
			$meta_keys = array(); $meta_values = array();			
			
			foreach ($this->options['custom_name'] as $j => $custom_name) {
				$meta_keys[$j]   = XmlImportParser::factory($xml, $this->xpath, $custom_name, $file)->parse($records); $tmp_files[] = $file;
				$meta_values[$j] = XmlImportParser::factory($xml, $this->xpath, $this->options['custom_value'][$j], $file)->parse($records); $tmp_files[] = $file;
			}					
			// serialized custom post fields
			$serialized_meta = array();
			if (!empty($meta_keys)){
				foreach ($meta_keys as $j => $custom_name) {													
					if (!in_array($custom_name[0], array_keys($serialized_meta))){
						$serialized_meta[stripcslashes($custom_name[0])] = array($meta_values[$j]);						
					}
					else{
						$serialized_meta[stripcslashes($custom_name[0])][] = $meta_values[$j];
					}
				}
			}		

			// serialized featured images
			if ( ! (($uploads = wp_upload_dir()) && false === $uploads['error'])) {
				$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': ' . $uploads['error']);
				$logger and call_user_func($logger, __('<b>WARNING</b>: No featured images will be created', 'pmxi_plugin'));				
				$_SESSION['pmxi_import']['warnings']++;				
			} else {
				($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing URLs for featured images...', 'pmxi_plugin'));
				$featured_images = array();
				if ($this->options['featured_image']) {
					// Detect if images is separated by comma
					$imgs = explode(',',$this->options['featured_image']);					
					if (!empty($imgs)){
						$parse_multiple = true;
						foreach($imgs as $img) if (!preg_match("/{.*}/", trim($img))) $parse_multiple = false;			

						if ($parse_multiple)
						{
							foreach($imgs as $img) 
							{								
								$posts_images = XmlImportParser::factory($xml, $this->xpath, trim($img), $file)->parse($records); $tmp_files[] = $file;								
								foreach($posts_images as $i => $val) $featured_images[$i][] = $val;								
							}
						}
						else
						{
							$featured_images = XmlImportParser::factory($xml, $this->xpath, $this->options['featured_image'], $file)->parse($records); $tmp_files[] = $file;								
						}
					}
					
				} else {
					count($titles) and $featured_images = array_fill(0, count($titles), '');
				}
			}	

			// serialized attachments
			if ( ! (($uploads = wp_upload_dir()) && false === $uploads['error'])) {
				$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': ' . $uploads['error']);				
				$logger and call_user_func($logger, __('<b>WARNING</b>: No attachments will be created', 'pmxi_plugin')); 				
				$_SESSION['pmxi_import']['warnings']++;
			} else {
				($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing URLs for attachments files...', 'pmxi_plugin'));
				$attachments = array();
				if ($this->options['attachments']) {
					// Detect if attachments is separated by comma
					$atchs = explode(',', $this->options['attachments']);					
					if (!empty($atchs)){
						$parse_multiple = true;
						foreach($atchs as $atch) if (!preg_match("/{.*}/", trim($atch))) $parse_multiple = false;			

						if ($parse_multiple)
						{
							foreach($atchs as $atch) 
							{								
								$posts_attachments = XmlImportParser::factory($xml, $this->xpath, trim($atch), $file)->parse($records); $tmp_files[] = $file;								
								foreach($posts_attachments as $i => $val) $attachments[$i][] = $val;								
							}
						}
						else
						{
							$attachments = XmlImportParser::factory($xml, $this->xpath, $this->options['attachments'], $file)->parse($records); $tmp_files[] = $file;								
						}
					}
					
				} else {
					count($titles) and $attachments = array_fill(0, count($titles), '');
				}
			}				

			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Composing unique keys...', 'pmxi_plugin'));
			$unique_keys = XmlImportParser::factory($xml, $this->xpath, $this->options['unique_key'], $file)->parse($records); $tmp_files[] = $file;
			
			($chunk == 1 or (empty($this->large_import) or $this->large_import == 'No')) and $logger and call_user_func($logger, __('Processing posts...', 'pmxi_plugin'));
			
			if ('post' == $this->options['type'] and '' != $this->options['custom_type']) {
				$post_type = $this->options['custom_type'];
			} else {
				$post_type = $this->options['type'];
			}					

			// Import WooCommerce products
			if ( $post_type == "product" and class_exists('PMWI_Plugin')) {				

				$product = new PMWI_Import_Record();
				extract( $product->process($this, count($titles), $xml, $logger, $chunk) );
												
			}

			$current_post_ids = array();
			foreach ($titles as $i => $void) {					

				if (!empty($chunk_records) and $this->large_import == 'Yes' and $this->options['create_chunks'] and !$is_cron and !in_array($_SESSION['pmxi_import']['chunk_number'], $chunk_records)) {
					$_SESSION['pmxi_import']['skipped_records']++;
					$_SESSION['pmxi_import']['chunk_number']++;

					$logger and call_user_func($logger, __('<b>SKIPPED</b>: by specified records option', 'pmxi_plugin'));
					$_SESSION['pmxi_import']['warnings']++;
					// Time Elapsed
					if ( ! $is_cron ){
						$records_count = $_SESSION['pmxi_import']['created_records'] + $_SESSION['pmxi_import']['updated_records'] + $_SESSION['pmxi_import']['skipped_records'] + $_SESSION['pmxi_import']['errors'];
						$progress_msg = '<p class="import_process_bar"> Created ' . $_SESSION['pmxi_import']['created_records'] . ' / Updated ' . $_SESSION['pmxi_import']['updated_records'] . ' of '. $_SESSION['pmxi_import']['count'].' records.</p><span class="import_percent">' . ceil(($records_count/$_SESSION['pmxi_import']['count']) * 100) . '</span><span class="warnings_count">' .  $_SESSION['pmxi_import']['warnings'] . '</span><span class="errors_count">' . $_SESSION['pmxi_import']['errors'] . '</span>';
						$logger and call_user_func($logger, $progress_msg);
					}						
					$this->set(array(
						'imported' => $this->imported + 1,	
						'created'  => $_SESSION['pmxi_import']['created_records'],
						'updated'  => $_SESSION['pmxi_import']['updated_records']				
					))->save();					
					continue;
				} 								

				if (empty($titles[$i])) {
					if (class_exists('PMWI_Plugin') and !empty($single_product_parent_ID[$i])){
						$titles[$i] = $single_product_parent_ID[$i] . ' Product Variation';
					}
					else{
						$logger and call_user_func($logger, __('<b>SKIPPED</b>: by empty title', 'pmxi_plugin'));
						$_SESSION['pmxi_import']['skipped_records']++;
						$_SESSION['pmxi_import']['chunk_number']++;	
						$_SESSION['pmxi_import']['warnings']++;
						$this->set(array(
							'imported' => $this->imported + 1,	
							'created'  => $_SESSION['pmxi_import']['created_records'],
							'updated'  => $_SESSION['pmxi_import']['updated_records']				
						))->save();					
						continue;				
					}
				}
						
				$articleData = array(
					'post_type' => $post_type,
					'post_status' => $this->options['status'],
					'comment_status' => $this->options['comment_status'],
					'ping_status' => $this->options['ping_status'],
					'post_title' => ($this->template['fix_characters']) ? utf8_encode(html_entity_decode($titles[$i])) : (($this->template['is_leave_html']) ? html_entity_decode($titles[$i]) : $titles[$i]),
					'post_excerpt' => ($this->template['fix_characters']) ? utf8_encode(html_entity_decode($post_excerpt[$i])) : (($this->template['is_leave_html']) ? html_entity_decode($post_excerpt[$i]) : $post_excerpt[$i]),
					'post_name' => $post_slug[$i],
					'post_content' => ($this->template['fix_characters']) ? utf8_encode(html_entity_decode($contents[$i])) : (($this->template['is_leave_html']) ? html_entity_decode($contents[$i]) : $contents[$i]),
					'post_date' => $dates[$i],
					'post_date_gmt' => get_gmt_from_date($dates[$i]),
					'post_author' => $post_author[$i] ,
					'tags_input' => $tags[$i]
				);				

				if ('post' != $articleData['post_type']){					
					$articleData += array(
						'menu_order' => $this->options['order'],
						'post_parent' => $this->options['parent'],
					);
				}				
				
				// Re-import Records Matching
				$post_to_update = false; $post_to_update_id = false;
				
				// if Auto Matching re-import option selected
				if ("manual" != $this->options['duplicate_matching']){
					$postRecord->clear();
					// find corresponding article among previously imported
					$postRecord->getBy(array(
						'unique_key' => $unique_keys[$i],
						'import_id' => $this->id,
					));
					if ( ! $postRecord->isEmpty() ) 
						$post_to_update = get_post($post_to_update_id = $postRecord->post_id);
											
				// if Manual Matching re-import option seleted
				} else {
					
					$postRecord->clear();
					// find corresponding article among previously imported
					$postRecord->getBy(array(
						'unique_key' => $unique_keys[$i],
						'import_id' => $this->id,
					));
					
					if ('custom field' == $this->options['duplicate_indicator']) {
						$custom_duplicate_value = XmlImportParser::factory($xml, $this->xpath, $this->options['custom_duplicate_value'], $file)->parse($records); $tmp_files[] = $file;
						$custom_duplicate_name = XmlImportParser::factory($xml, $this->xpath, $this->options['custom_duplicate_name'], $file)->parse($records); $tmp_files[] = $file;
					}
					else{
						count($titles) and $custom_duplicate_name = $custom_duplicate_value = array_fill(0, count($titles), '');					
					}

					// handle duplicates according to import settings
					if ($duplicates = $this->findDuplicates($articleData, $custom_duplicate_name[$i], $custom_duplicate_value[$i])) {															
						$duplicate_id = array_shift($duplicates);
						if ($duplicate_id) {														
							$post_to_update = get_post($post_to_update_id = $duplicate_id);
						}						
					}
				}
				
				// Duplicate record is founded
				if ($post_to_update){
					// Do not update already existing records option selected
					if ("yes" == $this->options['is_keep_former_posts']) {
						$current_post_ids[] = $_SESSION['pmxi_import']['current_post_ids'][]  = $post_to_update_id;
						if ($is_cron){
							$tmp_array = (!empty($this->current_post_ids)) ? json_decode($this->current_post_ids, true) : array();
							$tmp_array[] = $post_to_update_id;
							$this->set(array(
								'current_post_ids' => json_encode($tmp_array)
							))->save();
						}					
						$_SESSION['pmxi_import']['skipped_records']++;		
						$logger and call_user_func($logger, sprintf(__('<b>SKIPPED</b>: Previously imported record found for `%s`', 'pmxi_plugin'), $articleData['post_title']));
						$_SESSION['pmxi_import']['warnings']++;
						if ( ! $is_cron ){
							$records_count = $_SESSION['pmxi_import']['created_records'] + $_SESSION['pmxi_import']['updated_records'] + $_SESSION['pmxi_import']['skipped_records'] + $_SESSION['pmxi_import']['errors'];
							$progress_msg = '<p class="import_process_bar"> Created ' . $_SESSION['pmxi_import']['created_records'] . ' / Updated ' . $_SESSION['pmxi_import']['updated_records'] . ' of '. $_SESSION['pmxi_import']['count'].' records.</p><span class="import_percent">' . ceil(($records_count/$_SESSION['pmxi_import']['count']) * 100) . '</span><span class="warnings_count">' .  $_SESSION['pmxi_import']['warnings'] . '</span><span class="errors_count">' . $_SESSION['pmxi_import']['errors'] . '</span>';
							$logger and call_user_func($logger, $progress_msg);
						}					
						$_SESSION['pmxi_import']['chunk_number']++;
						continue;
					}
					$articleData['ID'] = $post_to_update_id;
					// preserve date of already existing article when duplicate is found					
					if ($this->options['is_keep_categories']) { // preserve categories and tags of already existing article if corresponding setting is specified
					
						$cats_list = get_the_category($articleData['ID']);
						if (is_wp_error($cats_list)) {
							$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Unable to get current categories for article #%d, updating with those read from XML file', 'pmxi_plugin'), $articleData['ID']));
							$_SESSION['pmxi_import']['warnings']++;
						} else {
							$cats_new = array();
							foreach ($cats_list as $c) {
								$cats_new[] = $c->cat_ID;
							}
							$cats[$i] = $cats_new;
						}
						
						$tags_list = get_the_tags($articleData['ID']);

						if (is_wp_error($tags_list)) {
							$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Unable to get current tags for article #%d, updating with those read from XML file', 'pmxi_plugin'), $articleData['ID']));
							$_SESSION['pmxi_import']['warnings']++;
						} else {
							$tags_new = array();
							if ($tags_list) foreach ($tags_list as $t) {
								$tags_new[] = $t->name;
							}
							$articleData['tags_input'] = implode(', ', $tags_new);
						}
						
						foreach (array_keys($taxonomies) as $tx_name) {
							$txes_list = get_the_terms($articleData['ID'], $tx_name);
							if (is_wp_error($txes_list)) {
								$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Unable to get current taxonomies for article #%d, updating with those read from XML file', 'pmxi_plugin'), $articleData['ID']));
								$_SESSION['pmxi_import']['warnings']++;
							} else {
								$txes_new = array();
								if (!empty($txes_list)):
									foreach ($txes_list as $t) {
										$txes_new[] = $t->name;
									}
								endif;
								$taxonomies[$tx_name][$i] = $txes_new;
							}
						}
					}						
					if ($this->options['is_keep_dates']) { // preserve date of already existing article when duplicate is found
						$articleData['post_date'] = $post_to_update->post_date;
						$articleData['post_date_gmt'] = $post_to_update->post_date_gmt;
					}
					if ($this->options['is_keep_status']) { // preserve status and trashed flag
						$articleData['post_status'] = $post_to_update->post_status;
					}
					if ($this->options['is_keep_content']){ 
						$articleData['post_content'] = $post_to_update->post_content;
					}
					if ($this->options['is_keep_title']){ 
						$articleData['post_title'] = $post_to_update->post_title;												
					}
					if ($this->options['is_keep_excerpt']){ 
						$articleData['post_excerpt'] = $post_to_update->post_excerpt;												
					}										
					if ($this->options['is_keep_menu_order']){ 
						$articleData['menu_order'] = $post_to_update->menu_order;
					}
					// handle obsolete attachments (i.e. delete or keep) according to import settings
					if ( ! $this->options['is_keep_images'] and ! $this->options['no_create_featured_image']){ 						
						wp_delete_attachments($articleData['ID']);
					}
				}
				elseif ( ! $postRecord->isEmpty() ){
					
					// existing post not found though it's track was found... clear the leftover, plugin will continue to treat record as new
					$postRecord->delete();
					
				}
				
				// no new records are created. it will only update posts it finds matching duplicates for
				if ($this->options['not_create_records'] and empty($articleData['ID'])){ 
					$_SESSION['pmxi_import']['skipped_records']++;		
					$logger and call_user_func($logger, sprintf(__('<b>SKIPPED</b>: by "Not add new records" option for `%s`', 'pmxi_plugin'), $articleData['post_title']));
					if ( ! $is_cron ){
						$records_count = $_SESSION['pmxi_import']['created_records'] + $_SESSION['pmxi_import']['updated_records'] + $_SESSION['pmxi_import']['skipped_records'] + $_SESSION['pmxi_import']['errors'];
						$progress_msg = '<p class="import_process_bar"> Created ' . $_SESSION['pmxi_import']['created_records'] . ' / Updated ' . $_SESSION['pmxi_import']['updated_records'] . ' of '. $_SESSION['pmxi_import']['count'].' records.</p><span class="import_percent">' . ceil(($records_count/$_SESSION['pmxi_import']['count']) * 100) . '</span><span class="warnings_count">' .  $_SESSION['pmxi_import']['warnings'] . '</span><span class="errors_count">' . $_SESSION['pmxi_import']['errors'] . '</span>';
						$logger and call_user_func($logger, $progress_msg);
					}					
					$_SESSION['pmxi_import']['chunk_number']++;					
					continue;
				}

				// cloak urls with `WP Wizard Cloak` if corresponding option is set
				if ( ! empty($this->options['is_cloak']) and class_exists('PMLC_Plugin')) {
					if (preg_match_all('%<a\s[^>]*href=(?(?=")"([^"]*)"|(?(?=\')\'([^\']*)\'|([^\s>]*)))%is', $articleData['post_content'], $matches, PREG_PATTERN_ORDER)) {
						$hrefs = array_unique(array_merge(array_filter($matches[1]), array_filter($matches[2]), array_filter($matches[3])));
						foreach ($hrefs as $url) {
							if (preg_match('%^\w+://%i', $url)) { // mask only links having protocol
								// try to find matching cloaked link among already registered ones
								$list = new PMLC_Link_List(); $linkTable = $list->getTable();
								$rule = new PMLC_Rule_Record(); $ruleTable = $rule->getTable();
								$dest = new PMLC_Destination_Record(); $destTable = $dest->getTable();
								$list->join($ruleTable, "$ruleTable.link_id = $linkTable.id")
									->join($destTable, "$destTable.rule_id = $ruleTable.id")
									->setColumns("$linkTable.*")
									->getBy(array(
										"$linkTable.destination_type =" => 'ONE_SET',
										"$linkTable.is_trashed =" => 0,
										"$linkTable.preset =" => '',
										"$linkTable.expire_on =" => '0000-00-00',
										"$ruleTable.type =" => 'ONE_SET',
										"$destTable.weight =" => 100,
										"$destTable.url LIKE" => $url,
									), NULL, 1, 1)->convertRecords();
								if ($list->count()) { // matching link found
									$link = $list[0];
								} else { // register new cloaked link
									global $wpdb;
									$slug = max(
										intval($wpdb->get_var("SELECT MAX(CONVERT(name, SIGNED)) FROM $linkTable")),
										intval($wpdb->get_var("SELECT MAX(CONVERT(slug, SIGNED)) FROM $linkTable")),
										0
									);
									$i = 0; do {
										is_int(++$slug) and $slug > 0 or $slug = 1;
										$is_slug_found = ! intval($wpdb->get_var("SELECT COUNT(*) FROM $linkTable WHERE name = '$slug' OR slug = '$slug'"));
									} while( ! $is_slug_found and $i++ < 100000);
									if ($is_slug_found) {
										$link = new PMLC_Link_Record(array(
											'name' => strval($slug),
											'slug' => strval($slug),
											'header_tracking_code' => '',
											'footer_tracking_code' => '',
											'redirect_type' => '301',
											'destination_type' => 'ONE_SET',
											'preset' => '',
											'forward_url_params' => 1,
											'no_global_tracking_code' => 0,
											'expire_on' => '0000-00-00',
											'created_on' => date('Y-m-d H:i:s'),
											'is_trashed' => 0,
										));
										$link->insert();
										$rule = new PMLC_Rule_Record(array(
											'link_id' => $link->id,
											'type' => 'ONE_SET',
											'rule' => '',
										));
										$rule->insert();
										$dest = new PMLC_Destination_Record(array(
											'rule_id' => $rule->id,
											'url' => $url,
											'weight' => 100,
										));
										$dest->insert();
									} else {
										$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Unable to create cloaked link for %s', 'pmxi_plugin'), $url));
										$_SESSION['pmxi_import']['warnings']++;
										$link = NULL;
									}
								}
								if ($link) { // cloaked link is found or created for url
									$articleData['post_content'] = preg_replace('%' . preg_quote($url, '%') . '(?=([\s\'"]|$))%i', $link->getUrl(), $articleData['post_content']);
								}
							}
						}
					}
				}															

				// insert article being imported				
				$pid = wp_insert_post($articleData, true);				

				if (is_wp_error($pid)) {
					$logger and call_user_func($logger, __('<b>ERROR</b>', 'pmxi_plugin') . ': ' . $pid->get_error_message());
					$_SESSION['pmxi_import']['errors']++;
				} else {
					
					do_action( 'pmxi_saved_post', $pid); // hook that was triggered immediately after post saved

					$current_post_ids[] = $_SESSION['pmxi_import']['current_post_ids'][] = $pid;
					if ($is_cron){
						$tmp_array = (!empty($this->current_post_ids)) ? json_decode($this->current_post_ids, true) : array();
						$tmp_array[] = $pid;
						$this->set(array(
							'current_post_ids' => json_encode($tmp_array)
						))->save();
					}
					if ("manual" != $this->options['duplicate_matching'] or empty($articleData['ID'])){						
						// associate post with import
						$postRecord->isEmpty() and $postRecord->set(array(
							'post_id' => $pid,
							'import_id' => $this->id,
							'unique_key' => $unique_keys[$i],
							'product_key' => (class_exists('PMWI_Plugin')) ? $single_product_ID[$i] : ''
						))->insert();
					}
					
					// [custom fields]
					$existing_meta_keys = array();
					foreach (get_post_meta($pid, '') as $cur_meta_key => $cur_meta_val) $existing_meta_keys[] = $cur_meta_key;
					
					$keep_custom_fields_specific = (!$this->options['keep_custom_fields'] and !empty($this->options['keep_custom_fields_specific'])) ? array_map('trim', explode(',', $this->options['keep_custom_fields_specific'])) : array();

					$current_meta_keys = array();					
					$encoded_meta = array();
					foreach ($serialized_meta as $m_key => $values) { 
						
						if (($this->options['keep_custom_fields'] and in_array($m_key, $existing_meta_keys)) or (in_array($m_key, $existing_meta_keys) and !$this->options['keep_custom_fields'] and in_array($m_key, $keep_custom_fields_specific))) continue;												
						
						if (count($values) > 1)
						{
							$current_meta_keys[] = $m_key;
							$serialized_value = array();
							foreach ($values as $k => $value) { if (is_numeric($k)) $serialized_value[] = $value[$i]; else $serialized_value[$k] = $value[$i]; }							
							update_post_meta($pid, $m_key, $serialized_value);
							do_action( 'pmxi_update_post_meta', $pid, $m_key, $serialized_value); // hook that was triggered after serialized post meta data updated
						}
						else 
						{												
							if (strpos($m_key, '[') !== false){
								$m_key = str_replace(array('\'','"'), "", $m_key);								
								$meta_name = substr($m_key, 0, strpos($m_key, '['));
								$meta_key = substr($m_key, strpos($m_key, '[') + 1, -1);
								$current_meta_keys[] = $meta_name;
								if (!empty($meta_name) and !empty($meta_key)){ 
									if (!is_array($encoded_meta[$meta_name])) $encoded_meta[$meta_name] = array();
									$encoded_meta[$meta_name][$meta_key] = $values[0][$i];
								}								
							}	
							else{
								$current_meta_keys[] = $m_key;
								update_post_meta($pid, $m_key, $values[0][$i]);								
							}
							do_action( 'pmxi_update_post_meta', $pid, $m_key, $values[0][$i]); // hook that was triggered after post meta data updated													
						}
					}
					
					if (!empty($encoded_meta))
						foreach ($encoded_meta as $key => $value) 
							update_post_meta($pid, $key, $value);										

					if ( ! $this->options['keep_custom_fields'] ) {
						foreach (get_post_meta($pid, '') as $cur_meta_key => $cur_meta_val) { // delete keys which are no longer correspond to import settings
							if ( ! in_array($cur_meta_key, $current_meta_keys) and  ! empty($articleData['ID']) and ! in_array($cur_meta_key, $keep_custom_fields_specific)) {
								if ($cur_meta_key != '_thumbnail_id' or !$this->options['is_keep_images'] and !$this->options['no_create_featured_image']) delete_post_meta($pid, $cur_meta_key);
							}
						}
					}
					// [/custom fields]

					if ( $post_type == "product" and class_exists('PMWI_Plugin')){

						global $woocommerce;

						// Add any default post meta
						add_post_meta( $pid, 'total_sales', '0', true );

						// Get types
						$product_type 		= empty( $product_types[$i] ) ? 'simple' : sanitize_title( stripslashes( $product_types[$i] ) );
						$is_downloadable 	= $product_downloadable[$i];
						$is_virtual 		= $product_virtual[$i];
						$is_featured 		= $product_featured[$i];

						// Product type + Downloadable/Virtual
						wp_set_object_terms( $pid, $product_type, 'product_type' );
						update_post_meta( $pid, '_downloadable', ($is_downloadable == "yes") ? 'yes' : 'no' );
						update_post_meta( $pid, '_virtual', ($is_virtual == "yes") ? 'yes' : 'no' );						

						// Update post meta
						update_post_meta( $pid, '_regular_price', stripslashes( $product_regular_price[$i] ) );
						update_post_meta( $pid, '_sale_price', stripslashes( $product_sale_price[$i] ) );
						update_post_meta( $pid, '_tax_status', stripslashes( $product_tax_status[$i] ) );
						update_post_meta( $pid, '_tax_class', stripslashes( $product_tax_class[$i] ) );			
						update_post_meta( $pid, '_visibility', stripslashes( $product_visibility[$i] ) );			
						update_post_meta( $pid, '_purchase_note', stripslashes( $product_purchase_note[$i] ) );
						update_post_meta( $pid, '_featured', ($is_featured == "yes") ? 'yes' : 'no' );

						// Dimensions
						if ( $is_virtual == 'no' ) {
							update_post_meta( $pid, '_weight', stripslashes( $product_weight[$i] ) );
							update_post_meta( $pid, '_length', stripslashes( $product_length[$i] ) );
							update_post_meta( $pid, '_width', stripslashes( $product_width[$i] ) );
							update_post_meta( $pid, '_height', stripslashes( $product_height[$i] ) );
						} else {
							update_post_meta( $pid, '_weight', '' );
							update_post_meta( $pid, '_length', '' );
							update_post_meta( $pid, '_width', '' );
							update_post_meta( $pid, '_height', '' );
						}

						// Save shipping class
						$product_shipping_class = $product_shipping_class[$i] > 0 && $product_type != 'external' ? absint( $product_shipping_class[$i] ) : '';
						wp_set_object_terms( $pid, $product_shipping_class, 'product_shipping_class');

						// Unique SKU
						$sku				= get_post_meta($pid, '_sku', true);
						$new_sku 			= esc_html( trim( stripslashes( $product_sku[$i] ) ) );
						
						if ( $new_sku == '' ) {
							update_post_meta( $pid, '_sku', '' );
						} elseif ( $new_sku !== $sku ) {
							if ( ! empty( $new_sku ) ) {
								if (
									$this->wpdb->get_var( $this->wpdb->prepare("
										SELECT ".$this->wpdb->posts.".ID
									    FROM ".$this->wpdb->posts."
									    LEFT JOIN ".$this->wpdb->postmeta." ON (".$this->wpdb->posts.".ID = ".$this->wpdb->postmeta.".post_id)
									    WHERE ".$this->wpdb->posts.".post_type = 'product'
									    AND ".$this->wpdb->posts.".post_status = 'publish'
									    AND ".$this->wpdb->postmeta.".meta_key = '_sku' AND ".$this->wpdb->postmeta.".meta_value = '%s'
									 ", $new_sku ) )
									) {
									$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Product SKU must be unique.', 'pmxi_plugin')));
									
								} else {
									update_post_meta( $pid, '_sku', $new_sku );
								}
							} else {
								update_post_meta( $pid, '_sku', '' );
							}
						}

						// Save Attributes
						$attributes = array();

						if ( !empty($serialized_attributes) ) {							
							
							$attribute_position = 0;

							foreach ($serialized_attributes as $attr_name => $attr_data) {
								
								$is_visible 	= ( $attr_data['is_visible'][$i] == "yes" ) ? 1 : 0;
								$is_variation 	= ( $attr_data['in_variation'][$i] == "yes" ) ? 1 : 0;
								$is_taxonomy 	= 0;

								// Text based, separate by pipe
						 		$values = implode( ' | ', array_map( 'sanitize_text_field', explode( '|', $attr_data['value'][$i] ) ) );

						 		// Custom attribute - Add attribute to array and set the values
							 	$attributes[ sanitize_title( $attr_name ) ] = array(
							 		'name' 			=> sanitize_text_field( $attr_name ),
							 		'value' 		=> $values,
							 		'position' 		=> $attribute_position,
							 		'is_visible' 	=> $is_visible,
							 		'is_variation' 	=> $is_variation,
							 		'is_taxonomy' 	=> $is_taxonomy
							 	);

							 	$attribute_position++;
							}							
						}						
						
						update_post_meta( $pid, '_product_attributes', $attributes );

						// Sales and prices
						if ( in_array( $product_type, array( 'variable', 'grouped' ) ) ) {

							// Variable and grouped products have no prices
							update_post_meta( $pid, '_regular_price', '' );
							update_post_meta( $pid, '_sale_price', '' );
							update_post_meta( $pid, '_sale_price_dates_from', '' );
							update_post_meta( $pid, '_sale_price_dates_to', '' );
							update_post_meta( $pid, '_price', '' );

						} else {

							$date_from = '';
							$date_to = '';

							// Dates
							if ( $date_from )
								update_post_meta( $pid, '_sale_price_dates_from', strtotime( $date_from ) );
							else
								update_post_meta( $pid, '_sale_price_dates_from', '' );

							if ( $date_to )
								update_post_meta( $pid, '_sale_price_dates_to', strtotime( $date_to ) );
							else
								update_post_meta( $pid, '_sale_price_dates_to', '' );

							if ( $date_to && ! $date_from )
								update_post_meta( $pid, '_sale_price_dates_from', strtotime( 'NOW', current_time( 'timestamp' ) ) );

							// Update price if on sale
							if ( $product_sale_price[$i] != '' && $date_to == '' && $date_from == '' )
								update_post_meta( $pid, '_price', stripslashes( $product_sale_price[$i] ) );
							else
								update_post_meta( $pid, '_price', stripslashes( $product_regular_price[$i] ) );

							if ( $product_sale_price[$i] != '' && $date_from && strtotime( $date_from ) < strtotime( 'NOW', current_time( 'timestamp' ) ) )
								update_post_meta( $pid, '_price', stripslashes($product_sale_price[$i]) );

							if ( $date_to && strtotime( $date_to ) < strtotime( 'NOW', current_time( 'timestamp' ) ) ) {
								update_post_meta( $pid, '_price', stripslashes($product_regular_price[$i]) );
								update_post_meta( $pid, '_sale_price_dates_from', '');
								update_post_meta( $pid, '_sale_price_dates_to', '');
							}
						}

						// Update parent if grouped so price sorting works and stays in sync with the cheapest child
						if ( "" != $single_product_parent_ID[$i] || $product_type == 'grouped') {

							$clear_parent_ids = array();

							$postRecord->clear();
							// find corresponding article among previously imported
							$postRecord->getBy(array(
								'product_key' => $single_product_parent_ID[$i],
								'import_id' => $this->id,
							));
							if ( ! $postRecord->isEmpty() ) 
								$product_parent_post = get_post($product_parent_post_id = $postRecord->post_id);

							if ( $product_parent_post_id > 0 )
								$clear_parent_ids[] = $product_parent_post_id;

							if ( $product_type == 'grouped' )
								$clear_parent_ids[] = $pid;							

							if ( $clear_parent_ids ) {
								foreach( $clear_parent_ids as $clear_id ) {

									$children_by_price = get_posts( array(
										'post_parent' 	=> $clear_id,
										'orderby' 		=> 'meta_value_num',
										'order'			=> 'asc',
										'meta_key'		=> '_price',
										'posts_per_page'=> 1,
										'post_type' 	=> 'product',
										'fields' 		=> 'ids'
									) );
									if ( $children_by_price ) {
										foreach ( $children_by_price as $child ) {
											$child_price = get_post_meta( $child, '_price', true );
											update_post_meta( $clear_id, '_price', $child_price );
										}
									}

									// Clear cache/transients
									$woocommerce->clear_product_transients( $clear_id );
								}
							}
						}

						// Sold Individuall
						if ( "yes" == $product_sold_individually[$i] ) {
							update_post_meta( $pid, '_sold_individually', 'yes' );
						} else {
							update_post_meta( $pid, '_sold_individually', '' );
						}

						// Stock Data
						if ( get_option('woocommerce_manage_stock') == 'yes' ) {

							if ( $product_type == 'grouped' ) {

								update_post_meta( $pid, '_stock_status', stripslashes( $product_stock_status[$i] ) );
								update_post_meta( $pid, '_stock', '' );
								update_post_meta( $pid, '_manage_stock', 'no' );
								update_post_meta( $pid, '_backorders', 'no' );

							} elseif ( $product_type == 'external' ) {

								update_post_meta( $pid, '_stock_status', 'instock' );
								update_post_meta( $pid, '_stock', '' );
								update_post_meta( $pid, '_manage_stock', 'no' );
								update_post_meta( $pid, '_backorders', 'no' );

							} elseif ( ! empty( $product_manage_stock[$i] ) ) {

								// Manage stock
								update_post_meta( $pid, '_stock', (int) $product_stock_qty[$i] );
								update_post_meta( $pid, '_stock_status', stripslashes( $product_stock_status[$i] ) );
								update_post_meta( $pid, '_backorders', stripslashes( $product_allow_backorders[$i] ) );
								update_post_meta( $pid, '_manage_stock', 'yes' );

								// Check stock level
								if ( $product_type !== 'variable' && $product_allow_backorders[$i] == 'no' && (int) $product_stock_qty[$i] < 1 )
									update_post_meta( $pid, '_stock_status', 'outofstock' );

							} else {

								// Don't manage stock
								update_post_meta( $pid, '_stock', '' );
								update_post_meta( $pid, '_stock_status', stripslashes( $product_stock_status[$i] ) );
								update_post_meta( $pid, '_backorders', stripslashes( $product_allow_backorders[$i] ) );
								update_post_meta( $pid, '_manage_stock', 'no' );

							}

						} else {

							update_post_meta( $pid, '_stock_status', stripslashes( $product_stock_status[$i] ) );

						}

						// Upsells
						if ( !empty( $product_up_sells[$i] ) ) {
							$upsells = array();
							$ids = explode(',', $product_up_sells[$i]);
							foreach ( $ids as $id ){								
								$args = array(
									'post_type' => 'product',
									'meta_query' => array(
										array(
											'key' => '_sku',
											'value' => $id,						
										)
									)
								);			
								$query = new WP_Query( $args );
								
								if ( $query->have_posts() ) $upsells[] = $query->post->ID;

								wp_reset_postdata();
							}								

							update_post_meta( $pid, '_upsell_ids', $upsells );
						} else {
							delete_post_meta( $pid, '_upsell_ids' );
						}

						// Cross sells
						if ( !empty( $product_cross_sells[$i] ) ) {
							$crosssells = array();
							$ids = explode(',', $product_cross_sells[$i]);
							foreach ( $ids as $id ){
								$args = array(
									'post_type' => 'product',
									'meta_query' => array(
										array(
											'key' => '_sku',
											'value' => $id,						
										)
									)
								);			
								$query = new WP_Query( $args );
								
								if ( $query->have_posts() ) $crosssells[] = $query->post->ID;

								wp_reset_postdata();
							}								

							update_post_meta( $pid, '_crosssell_ids', $crosssells );
						} else {
							delete_post_meta( $pid, '_crosssell_ids' );
						}

						// Downloadable options
						if ( $is_downloadable == 'yes' ) {

							$_download_limit = absint( $product_download_limit[$i] );
							if ( ! $_download_limit )
								$_download_limit = ''; // 0 or blank = unlimited

							$_download_expiry = absint( $product_download_expiry[$i] );
							if ( ! $_download_expiry )
								$_download_expiry = ''; // 0 or blank = unlimited

							// file paths will be stored in an array keyed off md5(file path)
							if ( !empty( $product_file_paths[$i] ) ) {
								$_file_paths = array();
								$file_paths = str_replace( "\r\n", "\n", esc_attr( $product_file_paths[$i] ) );
								$file_paths = trim( preg_replace( "/\n+/", "\n", $file_paths ) );
								if ( $file_paths ) {
									$file_paths = explode( "\n", $file_paths );

									foreach ( $file_paths as $file_path ) {
										$file_path = trim( $file_path );
										$_file_paths[ md5( $file_path ) ] = $file_path;
									}
								}

								// grant permission to any newly added files on any existing orders for this product
								do_action( 'woocommerce_process_product_file_download_paths', $pid, 0, $_file_paths );

								update_post_meta( $pid, '_file_paths', $_file_paths );
							}
							if ( isset( $product_download_limit[$i] ) )
								update_post_meta( $pid, '_download_limit', esc_attr( $_download_limit ) );
							if ( isset( $product_download_expiry[$i] ) )
								update_post_meta( $pid, '_download_expiry', esc_attr( $_download_expiry ) );
						}

						// Product url
						if ( $product_type == 'external' ) {
							if ( isset( $product_url[$i] ) && $product_url[$i] )
								update_post_meta( $pid, '_product_url', esc_attr( $product_url[$i] ) );
							if ( isset( $product_button_text[$i] ) && $product_button_text[$i] )
								update_post_meta( $pid, '_button_text', esc_attr( $product_button_text[$i] ) );
						}

						// Product Gallery
						if ( "" != $product_gallery[$i] ){

							$gallery_attachment_ids = array();

							// you must first include the image.php file
							// for the function wp_generate_attachment_metadata() to work
							require_once(ABSPATH . 'wp-admin/includes/image.php');
							
							if ( ! is_array($product_gallery[$i]) ) $product_gallery[$i] = array($product_gallery[$i]);
											
							foreach ($product_gallery[$i] as $product_gallery_image)
							{							
								$imgs = str_getcsv($product_gallery_image, $this->options['product_gallery_delim']);

								if (!empty($imgs)) {								
									foreach ($imgs as $img_url) { if (empty($img_url)) continue;									
										$create_image = false;
																				
										$image_filename = wp_unique_filename($uploads['path'], basename(parse_url(trim($img_url), PHP_URL_PATH)));
										$image_filepath = $uploads['path'] . '/' . url_title($image_filename);
										$img_url = str_replace(" ", "%20", trim($img_url));
										if ( ! file_put_contents($image_filepath, @file_get_contents($img_url)) and ! get_file_curl($img_url, $image_filepath)) {										
											$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Product gallery image %s cannot be saved locally as %s', 'pmxi_plugin'), $img_url, $image_filepath));
											$_SESSION['pmxi_import']['warnings']++;
											unlink($image_filepath); // delete file since failed upload may result in empty file created										
										} elseif( ! ($image_info = @getimagesize($image_filepath)) or ! in_array($image_info[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
											$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Product gallery image %s is not a valid image and cannot be set as gallery item.', 'pmxi_plugin'), $img_url));
											$_SESSION['pmxi_import']['warnings']++;
										} else {
											$create_image = true;											
										}																			

										if ($create_image){
											$attachment = array(
												'post_mime_type' => image_type_to_mime_type($image_info[2]),
												'guid' => $uploads['url'] . '/' . $image_filename,
												'post_title' => $image_filename,
												'post_content' => '',
											);
											if (($image_meta = wp_read_image_metadata($image_filepath))) {
												if (trim($image_meta['title']) && ! is_numeric(sanitize_title($image_meta['title'])))
													$attachment['post_title'] = $image_meta['title'];
												if (trim($image_meta['caption']))
													$attachment['post_content'] = $image_meta['caption'];
											}
											$attid = wp_insert_attachment($attachment, $image_filepath, $pid);
											if (is_wp_error($attid)) {
												$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': ' . $pid->get_error_message());
												$_SESSION['pmxi_import']['warnings']++;
											} else {																								
												wp_update_attachment_metadata($attid, wp_generate_attachment_metadata($attid, $image_filepath));												
												$gallery_attachment_ids[] = $attid;
											}
										}																	
									}
								}
							}
							// Store product gallery
							if ( !empty($gallery_attachment_ids)) update_post_meta($pid, '_product_image_gallery', implode(',', $gallery_attachment_ids));
						}

						// Do action for product type
						do_action( 'woocommerce_process_product_meta_' . $product_type, $pid );

						// Clear cache/transients
						$woocommerce->clear_product_transients( $pid );

						// VARIATIONS
						if ("" != $single_product_parent_ID[$i] and $product_type == 'variable' and $product_parent_post_id){
							
							$variable_enabled = ($product_enabled[$i] == "yes") ? 'yes' : 'no'; 

							$attributes = (array) maybe_unserialize( get_post_meta( $product_parent_post_id, '_product_attributes', true ) );

							// Enabled or disabled
							$post_status = ( $variable_enabled == 'yes' ) ? 'publish' : 'private';

							// Generate a useful post title
							$variation_post_title = sprintf( __( 'Variation #%s of %s', 'woocommerce' ), absint( $pid ), esc_html( get_the_title( $product_parent_post_id ) ) );

							// Update or Add post							

								$variation = array(
									'post_title' 	=> $variation_post_title,
									'post_content' 	=> '',
									'post_status' 	=> $post_status,									
									'post_parent' 	=> $product_parent_post_id,
									'post_type' 	=> 'product_variation'									
								);

							if ( ! $pid ) {

								$pid = wp_insert_post( $variation );

								do_action( 'woocommerce_create_product_variation', $pid );

							} else {

								$this->wpdb->update( $this->wpdb->posts, $variation, array( 'ID' => $pid ) );

								do_action( 'woocommerce_update_product_variation', $pid );

							}

							if ( $product_tax_class[ $i ] !== 'parent' )
								update_post_meta( $pid, '_tax_class', sanitize_text_field( $product_tax_class[ $i ] ) );
							else
								delete_post_meta( $pid, '_tax_class' );

							if ( $is_downloadable == 'yes' ) {
								update_post_meta( $pid, '_download_limit', sanitize_text_field( $product_download_limit[ $i ] ) );
								update_post_meta( $pid, '_download_expiry', sanitize_text_field( $product_download_expiry[ $i ] ) );

								$_file_paths = array();
								$file_paths = str_replace( "\r\n", "\n", $product_file_paths[ $i ] );
								$file_paths = trim( preg_replace( "/\n+/", "\n", $file_paths ) );
								if ( $file_paths ) {
									$file_paths = explode( "\n", $file_paths );

									foreach ( $file_paths as $file_path ) {
										$file_path = sanitize_text_field( $file_path );
										$_file_paths[ md5( $file_path ) ] = $file_path;
									}
								}

								// grant permission to any newly added files on any existing orders for this product
								do_action( 'woocommerce_process_product_file_download_paths', $product_parent_post_id, $pid, $_file_paths );

								update_post_meta( $pid, '_file_paths', $_file_paths );
							} else {
								update_post_meta( $pid, '_download_limit', '' );
								update_post_meta( $pid, '_download_expiry', '' );
								update_post_meta( $pid, '_file_paths', '' );
							}

							// Remove old taxonomies attributes so data is kept up to date
							if ( $pid ) {
								$this->wpdb->query( $this->wpdb->prepare( "DELETE FROM {$this->wpdb->postmeta} WHERE meta_key LIKE 'attribute_%%' AND post_id = %d;", $pid ) );
								wp_cache_delete( $pid, 'post_meta');
							}

							// Update taxonomies
							foreach ($serialized_attributes as $attr_name => $attr_data) {
																
								$is_variation 	= ( $attr_data['in_variation'][$i] == "yes" ) ? 1 : 0;								

								if ($is_variation){
									// Don't use woocommerce_clean as it destroys sanitized characters
									$values = sanitize_title($attr_data['value'][$i]);									

									update_post_meta( $pid, 'attribute_' . sanitize_title( $attr_name ), $values );
								}
								
							}

							do_action( 'woocommerce_save_product_variation', $pid );

							// Update parent if variable so price sorting works and stays in sync with the cheapest child
							$post_parent = $product_parent_post_id;

							$children = get_posts( array(
								'post_parent' 	=> $post_parent,
								'posts_per_page'=> -1,
								'post_type' 	=> 'product_variation',
								'fields' 		=> 'ids',
								'post_status'	=> 'publish'
							) );

							$lowest_price = $lowest_regular_price = $lowest_sale_price = $highest_price = $highest_regular_price = $highest_sale_price = '';

							if ( $children ) {
								foreach ( $children as $child ) {

									$child_price 			= get_post_meta( $child, '_price', true );
									$child_regular_price 	= get_post_meta( $child, '_regular_price', true );
									$child_sale_price 		= get_post_meta( $child, '_sale_price', true );

									// Regular prices
									if ( ! is_numeric( $lowest_regular_price ) || $child_regular_price < $lowest_regular_price )
										$lowest_regular_price = $child_regular_price;

									if ( ! is_numeric( $highest_regular_price ) || $child_regular_price > $highest_regular_price )
										$highest_regular_price = $child_regular_price;

									// Sale prices
									if ( $child_price == $child_sale_price ) {
										if ( $child_sale_price !== '' && ( ! is_numeric( $lowest_sale_price ) || $child_sale_price < $lowest_sale_price ) )
											$lowest_sale_price = $child_sale_price;

										if ( $child_sale_price !== '' && ( ! is_numeric( $highest_sale_price ) || $child_sale_price > $highest_sale_price ) )
											$highest_sale_price = $child_sale_price;
									}
								}

						    	$lowest_price 	= $lowest_sale_price === '' || $lowest_regular_price < $lowest_sale_price ? $lowest_regular_price : $lowest_sale_price;
								$highest_price 	= $highest_sale_price === '' || $highest_regular_price > $highest_sale_price ? $highest_regular_price : $highest_sale_price;
							}

							update_post_meta( $post_parent, '_price', $lowest_price );
							update_post_meta( $post_parent, '_min_variation_price', $lowest_price );
							update_post_meta( $post_parent, '_max_variation_price', $highest_price );
							update_post_meta( $post_parent, '_min_variation_regular_price', $lowest_regular_price );
							update_post_meta( $post_parent, '_max_variation_regular_price', $highest_regular_price );
							update_post_meta( $post_parent, '_min_variation_sale_price', $lowest_sale_price );
							update_post_meta( $post_parent, '_max_variation_sale_price', $highest_sale_price );

							// Update default attribute options setting
							$default_attributes = array();
							
							foreach ( $attributes as $attribute ) {
								$default_attributes[sanitize_title( $attribute['name'] )] = array();
								foreach ( $children as $child ) {
									if ( $attribute['is_variation'] ) {
										
										$value = esc_attr(trim( get_post_meta($child, 'attribute_'.sanitize_title($attribute['name']), true)));

										if (!empty($value) and empty($default_attributes[sanitize_title($attribute['name'])]))
											$default_attributes[sanitize_title($attribute['name'])] = $value;
										
									}
								}
							}

							update_post_meta( $post_parent, '_default_attributes', $default_attributes );
						}

					}					

					if ('post' != $articleData['post_type'] and !empty($this->options['page_template'])) update_post_meta($pid, '_wp_page_template', $this->options['page_template']);
					
					// [featured image]
					if ( ! empty($uploads) and false === $uploads['error'] and !empty($featured_images[$i]) and (empty($articleData['ID']) or empty($this->options['is_keep_images']))) {

						if ( $this->options['no_create_featured_image'] and has_post_thumbnail($pid) ){ 
							// do not download files if "no create featured image" is checked
							$logger and call_user_func($logger, sprintf(__('<b>Featured image SKIPPED</b>: The featured image is always exists fot the %s', 'pmxi_plugin'), $articleData['post_title']));							
						}
						else{
							require_once(ABSPATH . 'wp-admin/includes/image.php');
							
							if ( ! is_array($featured_images[$i]) ) $featured_images[$i] = array($featured_images[$i]);
							$post_thumbnail = false;	
							$success_images = false;					
							foreach ($featured_images[$i] as $featured_image)
							{							
								$imgs = str_getcsv($featured_image, $this->options['featured_delim']);						
								if (!empty($imgs)) {								
									foreach ($imgs as $img_url) { if (empty($img_url)) continue;									
										$create_image = false;
										if (base64_decode($img_url, true) !== false){
											$img = @imagecreatefromstring(base64_decode($img_url));									    
										    if($img)
										    {	
										    	$image_filename = md5(time()) . '.jpg';
										    	$image_filepath = $uploads['path'] . '/' . $image_filename;
										    	imagejpeg($img, $image_filepath);
										    	if( ! ($image_info = @getimagesize($image_filepath)) or ! in_array($image_info[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
													$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: File %s is not a valid image and cannot be set as featured one', 'pmxi_plugin'), $image_filepath));
													$_SESSION['pmxi_import']['warnings']++;
												} else {
													$create_image = true;											
												}	
										    } 
										} 
										else {
										
											$image_filename = wp_unique_filename($uploads['path'], basename(parse_url(trim($img_url), PHP_URL_PATH)));
											$image_filepath = $uploads['path'] . '/' . url_title($image_filename);
											$img_url = str_replace(" ", "%20", trim($img_url));
											if ( ! file_put_contents($image_filepath, @file_get_contents($img_url)) and ! get_file_curl($img_url, $image_filepath)) {										
												$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: File %s cannot be saved locally as %s', 'pmxi_plugin'), $img_url, $image_filepath));
												$_SESSION['pmxi_import']['warnings']++;
												unlink($image_filepath); // delete file since failed upload may result in empty file created										
											} elseif( ! ($image_info = @getimagesize($image_filepath)) or ! in_array($image_info[2], array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
												$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: File %s is not a valid image and cannot be set as featured one', 'pmxi_plugin'), $img_url));
												$_SESSION['pmxi_import']['warnings']++;
											} else {
												$create_image = true;											
											}	
										}									

										if ($create_image){
											$attachment = array(
												'post_mime_type' => image_type_to_mime_type($image_info[2]),
												'guid' => $uploads['url'] . '/' . $image_filename,
												'post_title' => $image_filename,
												'post_content' => '',
											);
											if (($image_meta = wp_read_image_metadata($image_filepath))) {
												if (trim($image_meta['title']) && ! is_numeric(sanitize_title($image_meta['title'])))
													$attachment['post_title'] = $image_meta['title'];
												if (trim($image_meta['caption']))
													$attachment['post_content'] = $image_meta['caption'];
											}
											$attid = wp_insert_attachment($attachment, $image_filepath, $pid);
											if (is_wp_error($attid)) {
												$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': ' . $pid->get_error_message());
												$_SESSION['pmxi_import']['warnings']++;
											} else {
												// you must first include the image.php file
												// for the function wp_generate_attachment_metadata() to work
												require_once(ABSPATH . 'wp-admin/includes/image.php');
												wp_update_attachment_metadata($attid, wp_generate_attachment_metadata($attid, $image_filepath));
												$success_images = true;
												if ( ! $post_thumbnail ) { 												
													if ( ! $this->options['no_create_featured_image'] or ! has_post_thumbnail($pid)){ 
														set_post_thumbnail($pid, $attid); 
														$post_thumbnail = true; 
													}
												}
											}
										}																	
									}
								}
							}
							// Create entry as Draft if no images are downloaded successfully
							if ( ! $success_images and "yes" == $this->options['create_draft'] ) wp_update_post(array('ID' => $pid, 'post_status' => 'draft'));
						}
					}
					// [/featured image]

					// [attachments]
					if ( ! empty($uploads) and false === $uploads['error'] and !empty($attachments[$i])) {

						// you must first include the image.php file
						// for the function wp_generate_attachment_metadata() to work
						require_once(ABSPATH . 'wp-admin/includes/image.php');

						if ( ! is_array($attachments[$i]) ) $attachments[$i] = array($attachments[$i]);

						foreach ($attachments[$i] as $attachment) { if ("" == $attachment) continue;
							
							$atchs = str_getcsv($attachment, $this->options['atch_delim']);

							if (!empty($atchs)) {
								foreach ($atchs as $atch_url) {	if (empty($atch_url)) continue;									

									$attachment_filename = wp_unique_filename($uploads['path'], basename(parse_url(trim($atch_url), PHP_URL_PATH)));										
									$attachment_filepath = $uploads['path'] . '/' . url_title($attachment_filename);
																		
									if ( ! file_put_contents($attachment_filepath, @file_get_contents(trim($atch_url))) and ! get_file_curl(trim($atch_url), $attachment_filepath)) {												
										$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Attachment file %s cannot be saved locally as %s', 'pmxi_plugin'), trim($atch_url), $attachment_filepath));
										$_SESSION['pmxi_import']['warnings']++;
										unlink($attachment_filepath); // delete file since failed upload may result in empty file created												
									} elseif( ! $wp_filetype = wp_check_filetype(basename($attachment_filename), null )) {
										$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Can\'t detect attachment file type %s', 'pmxi_plugin'), trim($atch_url)));
										$_SESSION['pmxi_import']['warnings']++;
									} else {

										$attachment_data = array(
										    'guid' => $uploads['baseurl'] . _wp_relative_upload_path( $attachment_filepath ), 
										    'post_mime_type' => $wp_filetype['type'],
										    'post_title' => preg_replace('/\.[^.]+$/', '', basename($attachment_filepath)),
										    'post_content' => '',
										    'post_status' => 'inherit'
										);
										$attach_id = wp_insert_attachment( $attachment_data, $attachment_filepath, $pid );												

										if (is_wp_error($attach_id)) {
											$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': ' . $pid->get_error_message());
											$_SESSION['pmxi_import']['warnings']++;
										} else {
											wp_update_attachment_metadata($attach_id, wp_generate_attachment_metadata($attach_id, $attachment_filepath));											
										}										
									}																
								}
							}
						}
					}
					// [/attachments]
					
					// [custom taxonomies]
					foreach ($taxonomies as $tx_name => $txes) {
						// create term if not exists
						foreach ($txes[$i] as $key => $single_tax) {							
							if (is_array($single_tax)){

								$parent_id = (!empty($single_tax['parent'])) ? $this->recursion_taxes($single_tax['parent'], $tx_name) : '';

								$term = term_exists( $single_tax['name'], $tx_name, $parent_id );
								if ( empty($term) ){									

									$term_attr = array('parent'=> (!empty($parent_id)) ? $parent_id : 0);
																		
									$term = wp_insert_term(
										$single_tax['name'], // the term 
									  	$tx_name, // the taxonomy
									  	$term_attr
									);
								}
								
								if ( empty($term) or is_wp_error($term) ){
									unset($txes[$i][$key]);
									$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: `%s`', 'pmxi_plugin'), $term->get_error_message()));
									$_SESSION['pmxi_import']['warnings']++;
								}
								else{
									$cat_id = $term['term_id'];
									if ($cat_id and $single_tax['assign']) 
										$txes[$i][$key] = $single_tax['name'];		
									else 
										unset($txes[$i][$key]);
								}									
							}
						}
						
						// associate taxes with post
						$term_ids = wp_set_object_terms($pid, $txes[$i], $tx_name);
						if (is_wp_error($term_ids)) {
							$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': '.$term_ids->get_error_message());
							$_SESSION['pmxi_import']['warnings']++;
						}
					}
					// [/custom taxonomies]
					
					// [categories]
					if (!empty($cats[$i])){

						if ( ! $this->options['is_keep_categories']) wp_set_object_terms( $pid, NULL, 'category' );

						// create categories if it's doesn't exists						
						foreach ($cats[$i] as $key => $single_cat) {												
							if (is_array($single_cat)){									
								if (!empty($single_cat['parent'])){									
									$cat = get_term_by('name', $single_cat['parent'], 'category') or $cat = get_term_by('slug', $single_cat['parent'], 'category') or ctype_digit($single_cat['parent']) and $cat = get_term_by('id', $single_cat['parent'], 'category');								
									if ($cat)
										$cat_id = wp_create_category($single_cat['name'], $cat->term_id);
								}
								else $cat_id = wp_create_category($single_cat['name']);		
								
								if ($cat_id and $single_cat['assign']) 
									$cats[$i][$key] = $cat_id;			
								else 
									unset($cats[$i][$key]);
							}
						}						
						// associate categories with post
						$cats_ids = wp_set_post_terms($pid, $cats[$i], 'category');
						if (is_wp_error($cats_ids)) {
							$logger and call_user_func($logger, __('<b>WARNING</b>', 'pmxi_plugin') . ': '.$cats_ids->get_error_message());
							$_SESSION['pmxi_import']['warnings']++;
						}
					}
					// [/categories]

					if (empty($articleData['ID'])) {
						$_SESSION['pmxi_import']['created_records']++;																									
						$logger and call_user_func($logger, sprintf(__('`%s` post created successfully', 'pmxi_plugin'), $articleData['post_title']));
					} else {
						$_SESSION['pmxi_import']['updated_records']++;										
						$logger and call_user_func($logger, sprintf(__('`%s` post updated successfully', 'pmxi_plugin'), $articleData['post_title']));
					}
					
					$records_count = 0;

					// Time Elapsed
					if ( ! $is_cron){												
						
						if ($this->large_import == 'No') $_SESSION['pmxi_import']['count'] = count($titles);
						
						$records_count = $_SESSION['pmxi_import']['created_records'] + $_SESSION['pmxi_import']['updated_records'] + $_SESSION['pmxi_import']['skipped_records'] + $_SESSION['pmxi_import']['errors'];

						$progress_msg = '<p class="import_process_bar"> Created ' . $_SESSION['pmxi_import']['created_records'] . ' / Updated ' . $_SESSION['pmxi_import']['updated_records'] . ' of '. $_SESSION['pmxi_import']['count'].' records.</p><span class="import_percent">' . ceil(($records_count/$_SESSION['pmxi_import']['count']) * 100) . '</span><span class="warnings_count">' .  $_SESSION['pmxi_import']['warnings'] . '</span><span class="errors_count">' . $_SESSION['pmxi_import']['errors'] . '</span>';
						$logger and call_user_func($logger, $progress_msg);
					}
					
				}
				
				if ($this->large_import == 'Yes' and $chunk){
					$this->set(array(
						'imported' => $this->imported + 1,	
						'created'  => $_SESSION['pmxi_import']['created_records'],
						'updated'  => $_SESSION['pmxi_import']['updated_records']				
					))->save();
					$_SESSION['pmxi_import']['chunk_number']++;
				}				

				wp_cache_flush();
			}			
			if (!$is_cron and ($records_count == $_SESSION['pmxi_import']['count'] + $_SESSION['pmxi_import']['skipped_records']) and ! empty($this->options['is_delete_missing'])) { // delete posts which are not in current import set				
				$logger and call_user_func($logger, 'Removing previously imported posts which are no longer actual...');
				$postList = new PMXI_Post_List();				
				
				$missing_ids = array();
				foreach ($postList->getBy(array('import_id' => $this->id, 'post_id NOT IN' => $_SESSION['pmxi_import']['current_post_ids'])) as $missingPost) {
					empty($this->options['is_keep_attachments']) and wp_delete_attachments($missingPost['post_id']);
					$missing_ids[] = $missingPost['post_id'];
					
					$sql = "delete a
					FROM ".PMXI_Plugin::getInstance()->getTablePrefix()."posts a
					WHERE a.id=%d";
					
					$this->wpdb->query( 
						$this->wpdb->prepare($sql, $missingPost['id'])
					);					
				}

				if (!empty($missing_ids)){
					$sql = "delete a,b,c
					FROM ".$this->wpdb->posts." a
					LEFT JOIN ".$this->wpdb->term_relationships." b ON ( a.ID = b.object_id )
					LEFT JOIN ".$this->wpdb->postmeta." c ON ( a.ID = c.post_id )				
					WHERE a.ID IN (".implode(',', $missing_ids).");";

					$this->wpdb->query( 
						$this->wpdb->prepare($sql, '')
					);
				}

			}
			
		} catch (XmlImportException $e) {
			$logger and call_user_func($logger, __('<b>ERROR</b>', 'pmxi_plugin') . ': ' . $e->getMessage());
			$_SESSION['pmxi_import']['errors']++;	
		}		

		$this->set('registered_on', date('Y-m-d H:i:s'))->save(); // specify execution is successful
		
		!$is_cron and ($records_count == $_SESSION['pmxi_import']['count'] + $_SESSION['pmxi_import']['skipped_records']) and $logger and call_user_func($logger, __('Cleaning temporary data...', 'pmxi_plugin'));
		foreach ($tmp_files as $file) { // remove all temporary files created
			unlink($file);
		}
		
		if (($is_cron or $records_count == $_SESSION['pmxi_import']['count'] + $_SESSION['pmxi_import']['skipped_records']) and $this->options['is_delete_source']) {
			$logger and call_user_func($logger, __('Deleting source XML file...', 'pmxi_plugin'));
			if ( ! @unlink($this->path)) {
				$logger and call_user_func($logger, sprintf(__('<b>WARNING</b>: Unable to remove %s', 'pmxi_plugin'), $this->path));
			}
		}
		!$is_cron and ($records_count == $_SESSION['pmxi_import']['count'] + $_SESSION['pmxi_import']['skipped_records']) and $logger and call_user_func($logger, 'Done');
		
		remove_filter('user_has_cap', array($this, '_filter_has_cap_unfiltered_html')); kses_init(); // return any filtering rules back if they has been disabled for import procedure
		
		return $this;
	}

	public function recursion_taxes($parent, $tx_name){
		if (is_array($parent)){
			if (empty($parent['parent'])){
				$term = term_exists( $parent['name'], $tx_name);
				if ( empty($term) ){
					$term = wp_insert_term(
						$parent['name'], // the term 
					  	$tx_name // the taxonomy			  	
					);
				}
				return $term['term_id'];
			}
			else{
				$parent_id = $this->recursion_taxes($parent['parent'], $tx_name);
				$term = term_exists( $parent['name'], $tx_name, $parent_id);
				if ( empty($term) ){
					$term = wp_insert_term(
						$parent, // the term 
					  	$tx_name, // the taxonomy			  	
					  	$parent_id
					);
				}
				return $term['term_id'];
			}			
		}
		else{
			$term = term_exists( $parent, $tx_name);
			if ( empty($term) ){
				$term = wp_insert_term(
					$parent, // the term 
				  	$tx_name // the taxonomy			  	
				);
			}
			return $term['term_id'];	
		}
	}
	
	public function _filter_has_cap_unfiltered_html($caps)
	{
		$caps['unfiltered_html'] = true;
		return $caps;
	}
	
	/**
	 * Find duplicates according to settings
	 */
	public function findDuplicates($articleData, $custom_duplicate_name = '', $custom_duplicate_value = '')
	{		
		if ('custom field' == $this->options['duplicate_indicator']){
			$duplicate_ids = array();
			$args = array(
				'post_type' => $articleData['post_type'],
				'meta_query' => array(
					array(
						'key' => $custom_duplicate_name,
						'value' => $custom_duplicate_value,						
					)
				)
			);			
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) $duplicate_ids[] = $query->post->ID;

			wp_reset_postdata();

			return $duplicate_ids;
		}
		else{
			$field = 'post_' . $this->options['duplicate_indicator']; // post_title or post_content
			return $this->wpdb->get_col($this->wpdb->prepare("
				SELECT ID FROM " . $this->wpdb->posts . "
				WHERE
					post_type = %s
					AND ID != %s
					AND REPLACE(REPLACE(REPLACE($field, ' ', ''), '\\t', ''), '\\n', '') = %s
				",
				$articleData['post_type'],
				isset($articleData['ID']) ? $articleData['ID'] : 0,
				preg_replace('%[ \\t\\n]%', '', $articleData[$field])
			));
		}
	}
	
	/**
	 * Clear associations with posts
	 * @param bool[optional] $keepPosts When set to false associated wordpress posts will be deleted as well
	 * @return PMXI_Import_Record
	 * @chainable
	 */
	public function deletePosts($keepPosts = TRUE) {
		$post = new PMXI_Post_List();
		if ($keepPosts) {
			$this->wpdb->query($this->wpdb->prepare('DELETE FROM ' . $post->getTable() . ' WHERE import_id = %s', $this->id));
		} else {
			$ids = array();
			foreach ($post->getBy('import_id', $this->id)->convertRecords() as $p) {
				empty($this->options['is_keep_attachments']) and empty($this->options['is_keep_images']) and wp_delete_attachments($p->post_id);
				$ids[] = $p->post_id;				
				//wp_delete_post($p->post_id, TRUE);
			}
			if (!empty($ids)){

				/*$sql = "delete a,b,c,d
				FROM ".$this->wpdb->posts." a
				LEFT JOIN ".$this->wpdb->term_relationships." b ON ( a.ID = b.object_id )
				LEFT JOIN ".$this->wpdb->postmeta." c ON ( a.ID = c.post_id )
				LEFT JOIN ".$this->wpdb->term_taxonomy." d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
				LEFT JOIN ".$this->wpdb->terms." e ON ( e.term_id = d.term_id )
				WHERE a.ID IN (".implode(',', $ids).");";*/

				$sql = "delete a,b,c
				FROM ".$this->wpdb->posts." a
				LEFT JOIN ".$this->wpdb->term_relationships." b ON ( a.ID = b.object_id )
				LEFT JOIN ".$this->wpdb->postmeta." c ON ( a.ID = c.post_id )				
				WHERE a.ID IN (".implode(',', $ids).");";

				$this->wpdb->query( 
					$this->wpdb->prepare($sql, '')
				);
			}
		}
		return $this;
	}
	/**
	 * Delete associated files
	 * @return PMXI_Import_Record
	 * @chainable
	 */
	public function deleteFiles() {
		$fileList = new PMXI_File_List();
		foreach($fileList->getBy('import_id', $this->id)->convertRecords() as $f) {
			$f->delete();
		}
		return $this;
	}
	
	/**
	 * @see parent::delete()
	 * @param bool[optional] $keepPosts When set to false associated wordpress posts will be deleted as well
	 */
	public function delete($keepPosts = TRUE) {
		$this->deletePosts($keepPosts)->deleteFiles();
		
		return parent::delete();
	}
	
}

/**
 * Cron schedule parser 
 */
class _PMXI_Import_Record_Cron_Parser
{
    /**
     * @var array Cron parts
     */
    private $_cronParts;

    /**
     * Constructor
     *
     * @param string $schedule Cron schedule string (e.g. '8 * * * *').  The 
     *      schedule can handle ranges (10-12) and intervals
     *      (*\/10 [remove the backslash]).  Schedule parts should map to
     *      minute [0-59], hour [0-23], day of month, month [1-12], day of week [1-7]
     *
     * @throws InvalidArgumentException if $schedule is not a valid cron schedule
     */
    public function __construct($schedule)
    {
        $this->_cronParts = explode(' ', $schedule);
        if (count($this->_cronParts) != 5) {
            throw new Exception($schedule . ' is not a valid cron schedule string');
        }
    }

    /**
     * Check if a date/time unit value satisfies a crontab unit
     *
     * @param DateTime $nextRun Current next run date
     * @param string $unit Date/time unit type (e.g. Y, m, d, H, i)
     * @param string $schedule Cron schedule variable
     *
     * @return bool Returns TRUE if the unit satisfies the constraint
     */
    public function unitSatisfiesCron(DateTime $nextRun, $unit, $schedule)
    {
        $unitValue = (int)$nextRun->format($unit);

        if ($schedule == '*') {
            return true;
        } if (strpos($schedule, '-')) {
            list($first, $last) = explode('-', $schedule);
            return $unitValue >= $first && $unitValue <= $last;
        } else if (strpos($schedule, '*/') !== false) {
            list($delimiter, $interval) = explode('*/', $schedule);
            return $unitValue % (int)$interval == 0;
        } else {
            return $unitValue == (int)$schedule;
        }
    }

    /**
     * Get the date in which the cron will run next
     *
     * @param string|DateTime (optional) $fromTime Set the relative start time
     *
     * @return DateTime
     */
    public function getNextRunDate($fromTime = 'now')
    {
        $nextRun = ($fromTime instanceof DateTime) ? $fromTime : new DateTime($fromTime);
        $nextRun->setTime($nextRun->format('H'), $nextRun->format('i'), 0);
        $nextRun->modify('+1 minute'); // make sure we don't return the very date is submitted to the function
        $nextRunLimit = clone $nextRun; $nextRunLimit->modify('+1 year');
        
        while ($nextRun < $nextRunLimit) { // Set a hard limit to bail on an impossible date

            // Adjust the month until it matches.  Reset day to 1 and reset time.
            if ( ! $this->unitSatisfiesCron($nextRun, 'm', $this->getSchedule('month'))) {
                $nextRun->modify('+1 month');
                $nextRun->setDate($nextRun->format('Y'), $nextRun->format('m'), 1);
                $nextRun->setTime(0, 0, 0);
                continue;
            }

            // Adjust the day of the month by incrementing the day until it matches. Reset time.
            if ( ! $this->unitSatisfiesCron($nextRun, 'd', $this->getSchedule('day_of_month'))) {
                $nextRun->modify('+1 day');
                $nextRun->setTime(0, 0, 0);
                continue;
            }

            // Adjust the day of week by incrementing the day until it matches.  Resest time.
            if ( ! $this->unitSatisfiesCron($nextRun, 'N', $this->getSchedule('day_of_week'))) {
                $nextRun->modify('+1 day');
                $nextRun->setTime(0, 0, 0);
                continue;
            }

            // Adjust the hour until it matches the set hour.  Set seconds and minutes to 0
            if ( ! $this->unitSatisfiesCron($nextRun, 'H', $this->getSchedule('hour'))) {
                $nextRun->modify('+1 hour');
                $nextRun->setTime($nextRun->format('H'), 0, 0);
                continue;
            }

            // Adjust the minutes until it matches a set minute
            if ( ! $this->unitSatisfiesCron($nextRun, 'i', $this->getSchedule('minute'))) {
                $nextRun->modify('+1 minute');
                continue;
            }

            break;
        }

        return $nextRun;
    }

    /**
     * Get all or part of the cron schedule string
     *
     * @param string $part Specify the part to retrieve or NULL to get the full
     *      cron schedule string.  $part can be the PHP date() part of a date
     *      formatted string or one of the following values:
     *      NULL, 'minute', 'hour', 'month', 'day_of_week', 'day_of_month'
     *
     * @return string
     */
    public function getSchedule($part = null)
    {
        switch ($part) {
            case 'minute': case 'i':
                return $this->_cronParts[0];
            case 'hour': case 'H':
                return $this->_cronParts[1];
            case 'day_of_month': case 'd':
                return $this->_cronParts[2];
            case 'month': case 'm':
                return $this->_cronParts[3];
            case 'day_of_week': case 'N':
                return $this->_cronParts[4];
            default:
                return implode(' ', $this->_cronParts);
        }
    }

    /**
     * Deterime if the cron is due to run based on the current time, last run
     * time, and the next run time.
     * 
     * If the relative next run time based on the last run time is not equal to 
     * the next suggested run time based on the current time, then the cron 
     * needs to run.
     *
     * @param string|DateTime $lastRun (optional) Date the cron was last run.
     *
     * @return bool Returns TRUE if the cron is due to run or FALSE if not
     */
    public function isDue($lastRun = 'now')
    {
        return $this->getNextRunDate($lastRun) < $this->getNextRunDate();
    }
}
