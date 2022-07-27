<?php
/**
 * LOOPS Registers the Custom post type.
 */
// function custom_post_type() {

// 	$postTypes = array(
// 		'practices' => array(
// 			'title'     => 'Practices',
// 			'menu_icon'	=> 'dashicons-admin-tools',
// 			'hierarchical' => true,
// 			'supports' => array( 'title','editor','thumbnail'),
// 			'rewrite'  => array( 'slug' => 'practices', 'with_front' => true),
// 		),
// 		'films' => array(
// 			'title'     => 'Films',
// 			'menu_icon'	=> 'dashicons-video-alt2',
// 			'hierarchical' => true,
// 			'supports' => array( 'title','thumbnail'),
// 			'rewrite'  => array( 'slug' => 'films', 'with_front' => true),
// 		),
// 		'events' => array(
// 			'title'     => 'Events',
// 			'menu_icon'	=> 'dashicons-sticky',
// 			'hierarchical' => true,
// 			'supports' => array( 'title','editor','thumbnail'),
// 			'rewrite'  => array( 'slug' => 'events', 'with_front' => true),
// 		),
// 	);

// 	foreach ($postTypes as $key => $value) {
// 		$args =	array(
// 			'labels' => array(
// 				"name"			     =>	__( $value['title'], 'gf-blog'),
// 				"singular_name"	     =>	__( $value['title'], 'gf-blog'),
// 				"add_new"			 =>	__('Add '. $value['title'] , 'gf-blog'),
// 				"add_new_item"	     =>	__('Add New '. $value['title'] , 'gf-blog'),
// 				"edit_item"		     =>	__('Edit '. $value['title'] , 'gf-blog'),
// 				"new_item"		     =>	__('New '. $value['title'] , 'gf-blog'),
// 				"view_item"		     =>	__('Show '. $value['title'] , 'gf-blog'),
// 				"search_items"	     =>	__('Search '. $value['title'] , 'gf-blog'),
// 				"not_found"		     =>	__('No '. $value['title'].' Found', 'gf-blog'),
// 				"not_found_in_trash" =>	__('No '. $value['title']. 'Found in the Trash', 'gf-blog'),
// 				"parent_item_colon"  =>	__('Parent '. $value['title'] , 'gf-blog'),
// 				"edit"			     =>	__('Edit ', 'gf-blog'),
// 				"view"			     =>	__('Show '. $value['title'], 'gf-blog')
// 			),
// 			'menu_icon'	          => $value['menu_icon'],
// 			'query_var'           => true,
// 			'public'              => true,
// 			'capability_type'     => 'post',
// 			'show_ui'             => true,
// 			'exclude_from_search' => false,
// 			'hierarchical'        => $value['hierarchical'],
// 			'has_archive'         => true,
// 			'show_in_menu'        => true,
// 			'show_in_nav_menus'   => true,
// 			'supports'            => $value['supports'],
// 			'rewrite'             => array( 'slug' => $key, 'with_front' => true),
// 		);
// 		register_post_type($key, $args);
// 	}
// }
// add_action('init', 'custom_post_type');


// function create_services_area() {
// 	$labels = array(
// 		'name'              => __( 'Practice Areas', 'gf-blog' ),
// 		'singular_name'     => __( 'Practice', 'gf-blog' ),
// 		'search_items'      => __( 'Search Practice Area', 'gf-blog' ),
// 		'all_items'         => __( 'All Practice Areas', 'gf-blog' ),
// 		'parent_item'       => __( 'Parent Practice', 'gf-blog' ),
// 		'parent_item_colon' => __( 'Parent Practice:', 'gf-blog' ),
// 		'edit_item'         => __( 'Edit Practice Area', 'gf-blog' ),
// 		'update_item'       => __( 'Update Practice Area', 'gf-blog' ),
// 		'add_new_item'      => __( 'Add Practice Area', 'gf-blog' ),
// 		'new_item_name'     => __( 'New Practice Area', 'gf-blog' ),
// 		'menu_name'         => __( 'Practice Areas', 'gf-blog' ),
// 	);
// 	register_taxonomy(
// 		'practice-areas', array('practices','films'),
// 		array(
// 			'labels'            => $labels,
// 			'hierarchical'      => true,
// 			'query_var'         => true,
// 			'show_admin_column' => true,
// 			'rewrite'	        => true
// 		)
// 	);
// }
// add_action( 'init', 'create_services_area' );