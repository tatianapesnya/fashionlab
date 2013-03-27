<?php  
  
    // function: post_type BEGIN  
    function post_type()  
    {  
    $labels = array(  
    'name' => __( 'Partners'),   
    'singular_name' => __('Partner'),  
    'rewrite' => array(  
       'slug' => __( 'partners' )   
    ),  
    'add_new' => _x('Add Item', 'Partners'),   
    'edit_item' => __('Edit Partner Item'),  
    'new_item' => __('New Partner Item'),   
    'view_item' => __('View Partner'),  
    'search_items' => __('Search Partner'),   
    'not_found' =>  __('No Partners Items Found'),  
    'not_found_in_trash' => __('No Partners Items Found In Trash'),  
    'parent_item_colon' => ''  
);  
    $args = array(  
    'labels' => $labels,  
    'public' => true,  
    'publicly_queryable' => true,  
    'show_ui' => true,  
    'query_var' => true,  
    'rewrite' => true,  
    'capability_type' => 'post',  
    'hierarchical' => false,  
    'menu_position' => null,  
    'supports' => array(  
        'title',  
        'editor',  
        'thumbnail'  
    )  
);  
register_post_type(__( 'partners' ), $args);
        // We will fill this function in the next step  
    } // function: post_type END  
 // function: partners_messages BEGIN  
function partners_messages($messages)  
{  
    $messages[__( 'partners' )] =   
        array(  
            0 => '',   
            1 => sprintf(('partners Updated. <a href="%s">View partners</a>'), esc_url(get_permalink($post_ID))),  
            2 => __('Custom Field Updated.'),  
            3 => __('Custom Field Deleted.'),  
            4 => __('partners Updated.'),  
            5 => isset($_GET['revision']) ? sprintf( __('partners Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,  
            6 => sprintf(__('partners Published. <a href="%s">View partners</a>'), esc_url(get_permalink($post_ID))),  
            7 => __('partners Saved.'),  
            8 => sprintf(__('partners Submitted. <a target="_blank" href="%s">Preview partners</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),  
            9 => sprintf(__('partners Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview partners</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),  
            10 => sprintf(__('partners Draft Updated. <a target="_blank" href="%s">Preview partnerso</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),  
        );  
    return $messages;  
  
} // function: partners_messages END  
// function: partners_filter BEGIN  
function partners_filter()  
{  
    register_taxonomy(  
        __( "filter" ),  
        array(__( "partners" )),  
        array(  
            "hierarchical" => true,  
            "label" => __( "Filter" ),  
            "singular_label" => __( "Filter" ),  
            "rewrite" => array(  
                'slug' => 'filter',  
                'hierarchical' => true  
            )  
        )  
    );  
} // function: partners_filter END  
add_action( 'init', 'post_type' );  
add_action( 'init', 'partners_filter', 0 );  
add_filter( 'post_updated_messages', 'partners_messages' );  
?>    