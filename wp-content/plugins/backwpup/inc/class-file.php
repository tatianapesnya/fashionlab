<?php
/**
 * Class for methods for file/folder related things
 */
class BackWPup_File {

	/**
	 *
	 * Get the folder for blog uploads
	 *
	 * @return string
	 */
	public static function get_upload_dir() {

		if ( is_multisite() ) {
			if ( get_site_option( 'ms_files_rewriting' ) && defined( 'UPLOADBLOGSDIR' ) )
				return trailingslashit(  str_replace( '\\', '/',ABSPATH . UPLOADBLOGSDIR ) );
			elseif ( defined( 'UPLOADS' ) && ! ( is_multisite() && get_site_option( 'ms_files_rewriting' ) ) )
				return trailingslashit(  str_replace( '\\', '/',ABSPATH . UPLOADS ) );
			elseif ( defined( 'MULTISITE' ) )
				return trailingslashit(  str_replace( '\\', '/',ABSPATH . '/sites/' ) );
			else
				return trailingslashit(  str_replace( '\\', '/',ABSPATH ) );			
		} else {
			$upload_dir = wp_upload_dir();
			return trailingslashit( str_replace( '\\', '/',$upload_dir[ 'basedir' ] ) );
		}

	}

	/**
	 *
	 * check if path in open basedir
	 *
	 * @param string $dir the folder to check
	 *
	 * @return bool is it in open basedir
	 */
	public static function is_in_open_basedir( $dir ) {

		$ini_open_basedir = str_replace( '\\', '/',ini_get( 'open_basedir' ) );

		if ( empty( $ini_open_basedir ) )
			return TRUE;

		$open_base_dirs = explode( PATH_SEPARATOR, $ini_open_basedir );
		$dir            = trailingslashit( str_replace( '\\', '/', $dir ) );

		foreach ( $open_base_dirs as $open_base_dir ) {
			if ( stripos( $dir, trailingslashit( $open_base_dir ) <= 1 ) )
				return TRUE;
		}

		return FALSE;
	}

	/**
	 *
	 * get size of files in folder
	 *
	 * @param string $folder the folder to calculate
	 * @param bool $deep went thrue suborders
	 * @return int folder size in byte
	 */
	public static function get_folder_size( $folder, $deep = TRUE ) {

		$files_size = 0;
		
		if ( ! is_readable( $folder ) )
			return $files_size; 
		
		if ( $dir = opendir( $folder ) ) {
			while ( FALSE !== ( $file = readdir( $dir ) ) ) {
				if ( in_array( $file, array( '.', '..' ) ) )
					continue;
				if ( is_file( $folder . '/' . $file ) )
					$files_size = $files_size + @filesize( $folder . '/' . $file );
				if ( $deep && is_dir( $folder . '/' . $file ) )
					$files_size = $files_size + self::get_folder_size( $folder . '/' . $file, TRUE );
			}
			closedir( $dir );
		}

		return $files_size;
	}
}
