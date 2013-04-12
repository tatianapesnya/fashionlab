<?php
/** sidebar-stylists.php
 *
 * @author		Pesnya Tatiana
 * @package		The Bootstrap
 */

tha_sidebars_before(); ?>
<section id="secondary" class="widget-area span4" role="complementary">
	<?php tha_sidebar_top();
	
	if ( ! dynamic_sidebar( 'stylists' ) ) {
		the_widget( 'WP_Widget_Meta', array(), array(
		'before_widget'	=>	'<aside id="%1$s" class="widget well %2$s">',
		'after_widget'	=>	'</aside>',
		'before_title'	=>	'<h2 class="widget-title">',
		'after_title'	=>	'</h2>',
		) );
	} // end sidebar widget area
	
	tha_sidebar_bottom(); ?>
</section><!-- #secondary .widget-area -->
<?php tha_sidebars_after();


/* End of file sidebar.php */
/* Location: ./wp-content/themes/the-bootstrap/sidebar.php */