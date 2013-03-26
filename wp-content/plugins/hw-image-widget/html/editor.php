<style type="text/css">
	div.hwim .text-preview {
		height: 100px;
		overflow: scroll;
		resize: vertical;
		width: 100%;
		display: inline-block;
		cursor: text;
	}
	div.hwim .form-padding {
		margin-bottom: 12px;
	}
</style>
<!-- Modal for Widget -->
<div id="hwim-lb" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>HW Image Widget</h3>
	</div>
	<div class="modal-body">
		<?php
		wp_editor( '', 'hwim-tinymce', $tinymce_settings );
		?>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><?php _e( 'Discard Changes', 'hwim' ); ?></button>
		<a href="#" class="btn btn-primary" data-dismiss="modal"><?php _e( 'Save Changes', 'hwim' ); ?></a>
	</div>
</div>