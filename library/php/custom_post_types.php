<?php
// let's create the function for the custom type
function custom_post_types() { 
	
	// EVENTS
	register_post_type('event', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => 'Events', /* This is the Title of the Group */
			'singular_name' => 'Event', /* This is the individual type */
			'all_items' => 'All Events', /* the all items menu item */
			'add_new' => 'Add New', /* The add new menu item */
			'add_new_item' => 'Add New Event', /* Add New Display Title */
			'edit' => 'Edit', /* Edit Dialog */
			'edit_item' => 'Edit Event', /* Edit Display Title */
			'new_item' => 'New Event', /* New Display Title */
			'view_item' => 'View Event', /* View Display Title */
			'search_items' => 'Search Events', /* Search Custom Type Title */ 
			'not_found' =>  'Nothing found...', /* This displays if there are no entries yet */ 
			'not_found_in_trash' => 'Nothing found in the trash...', /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => 'This is the example custom post type', /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'events', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'events', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title')
	 	) /* end of options */
	); /* end of register post type */
	
	// FAQS
	register_post_type('faq', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => 'FAQs', /* This is the Title of the Group */
			'singular_name' => 'FAQ', /* This is the individual type */
			'all_items' => 'All FAQs', /* the all items menu item */
			'add_new' => 'Add New', /* The add new menu item */
			'add_new_item' => 'Add New FAQ', /* Add New Display Title */
			'edit' => 'Edit', /* Edit Dialog */
			'edit_item' => 'Edit FAQ', /* Edit Display Title */
			'new_item' => 'New FAQ', /* New Display Title */
			'view_item' => 'View FAQ', /* View Display Title */
			'search_items' => 'Search FAQs', /* Search Custom Type Title */ 
			'not_found' =>  'Nothing found...', /* This displays if there are no entries yet */ 
			'not_found_in_trash' => 'Nothing found in the trash...', /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => 'This is the example custom post type', /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'faqs', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'faqs', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title')
	 	) /* end of options */
	); /* end of register post type */
	
}

// adding the function to the Wordpress init
add_action( 'init', 'custom_post_types');