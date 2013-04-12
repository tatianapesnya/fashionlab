<?php  
  
    // function: post_type BEGIN  
    function store_post_type()  
    {  
    $labels = array(  
    'name' => __( 'Stores'),   
    'singular_name' => __('Store'),  
    'rewrite' => array(  
       'slug' => __( 'stores' )   
    ),  
    'add_new' => _x('Add Item', 'Stores'),   
    'edit_item' => __('Edit Store Item'),  
    'new_item' => __('New Store Item'),   
    'view_item' => __('View Store'),  
    'search_items' => __('Search Store'),   
    'not_found' =>  __('No Stores Items Found'),  
    'not_found_in_trash' => __('No Stores Items Found In Trash'),  
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
register_post_type(__( 'stores' ), $args);
        // We will fill this function in the next step  
    } // function: post_type END  
  
function stores_filter()  
{  
    register_taxonomy(  
        __( "filter_store" ),  
        array(__( "stores" )),  
        array(  
            "hierarchical" => true,  
            "label" => __( "Filter Store" ),  
            "singular_label" => __( "Filter Store" ),  
            "rewrite" => array(  
                'slug' => 'filter_store',  
                'hierarchical' => true  
            )  
        )  
    );  
} // function: stores_filter END  
add_action( 'init', 'store_post_type' );  
add_action( 'init', 'stores_filter', 0 );  
?>    