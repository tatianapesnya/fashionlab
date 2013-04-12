<?php 
/** _partners.php
 *
 * Template Name: Partners
 *
 * @author 	Pesnya Tatiana
 * @package The Bootstrap
 * @since	1.3.0	- 29.04.2012
 */

get_header(); ?>
    <!-- #content  BEGIN  -->  
<div class="container">
<div id="page" class="container">
<section id="primary" class="span8">
      <ul class="filter clearfix"> 
      <li><strong><?php _e('Filter','theme-text-domain'); ?>:</strong></li>
		<li class="active"><a href="javascript:void(0)" class="all"><?php _e('All','theme-text-domain'); ?></a></li> 
		<?php
						// Get the taxonomy
						$terms = get_terms('filter', $args);
						
						// set a count to the amount of categories in our taxonomy
						$count = count($terms); 
						
						// set a count value to 0
						$i=0;
						
						// test if the count has any categories
						if ($count > 0) {
							
							// break each of the categories into individual elements
							foreach ($terms as $term) {
								
								// increase the count by 1
								$i++;
								
								// rewrite the output for each category
								$term_list .= '<li><a href="javascript:void(0)" class="'. $term->slug .'">' . $term->name . '</a></li>';
								
								// if count is equal to i then output blank
								if ($count != $i)
								{
									$term_list .= '';
								}
								else 
								{
									$term_list .= '';
								}
							}
							
							// print out each of the categories in our new format
							echo $term_list;
						}
					?>
				</ul>
				<ul class="filterable-grid clearfix">
  
    			<?php $wpbp = new WP_Query(array(  'post_type' => 'partners', 'posts_per_page' =>'-1' ) ); ?>  
  
   				 <?php if ($wpbp->have_posts()) :  while ($wpbp->have_posts()) : $wpbp->the_post(); ?>  
   				 <?php $terms = get_the_terms( get_the_ID(), 'filter' ); ?>  
  				<li data-id="id-<?php echo  $count; ?>" data-type="<?php foreach ($terms as $term) { echo  strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" class="span3"> 
      			<?php the_content();?>
        		</li>  
  
    				<?php $count++; // Increase the count by 1 ?>		
					<?php endwhile; endif; // END the Wordpress Loop ?>
					<?php wp_reset_query(); // Reset the Query Loop?>
			
				</ul>
			</section>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer();?>
 