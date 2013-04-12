<?php
/** _author-template.php
 * Template Name: Author Template
 *
 * The template for displaying Author Profile pages.
 *
 */
 
/* Loads the "Author Filter Template" based on the query var "filter_type"
 * If current page has variable key "filter_type" in the query, load the appropriate template and return.
 */ 
get_header(); ?>
<div class="container">
<div id="page" class="container">
<section id="primary" class="span8">
        <div id="content" role="main">
                <hgroup>
                        <h1 class="display-name"><a href="<?php the_author_meta('ID', $author); ?>"><?php echo the_author(); ?></a></h1>
                </hgroup>
                <?php tha_content_before(); ?>
                <?php tha_content_top();
                
       
        
                
                        rewind_posts();
                        // If a user has filled out their description, show a bio on their entries.
                        if ( get_the_author_meta( 'description' ) ) : ?>
                        <div id="author-info" class="row">
                                <h2 class="span8"><?php printf( __( 'About %s', 'the-bootstrap' ), get_the_author() ); ?></h2>
                                <div id="author-avatar" class="span1">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'the-bootstrap_author_bio_avatar_size', 70 ) ); ?>
                                </div><!-- #author-avatar -->
                                <div id="author-description" class="span7">
                                        <?php the_author_meta( 'description' ); ?>
                                </div><!-- #author-description  -->
                        </div><!-- #author-info -->
                        <?php endif; 
                        the_post();
                get_template_part( '/partials/content', 'page' );

                tha_content_bottom(); ?>

        <?php tha_content_after(); ?>
                
               
                <?php // Recently Added
                      /*  $link = add_query_arg('filter_type', 'user_added', get_author_posts_url($user_id));
                       
                        $args = array(
                                'view' => 'grid-medium',
                                'title' => __('Recently Added', 'dp'),
                                'link' => $link,
                                'author' => $user_id,
                                'post_type' => 'post',
                                'ignore_sticky_posts' => true,
                                'posts_per_page' => 2
                        );
                        dp_section_box($args);
                ?> */
               
 get_sidebar(); ?>
</div><!-- #page -->
</div><!-- .container -->
<?php get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */