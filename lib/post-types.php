<?php

add_action( 'init', 'hm_register_post_types' );
function hm_register_post_types() {
	/** ---------------------------------------- *
	 *                  Services
	 * ---------------------------------------- */
	register_post_type( 'hm_service', array(
		'labels'              => array(
			'name'               => __( 'Transportation Services', THEME_TEXTDOMAIN ),
			'singular_name'      => __( 'Transportation Service', THEME_TEXTDOMAIN ),
			'add_new'            => __( 'Add New', THEME_TEXTDOMAIN ),
			'add_new_item'       => __( 'Add new Transportation Service', THEME_TEXTDOMAIN ),
			'view_item'          => __( 'View Transportation Service', THEME_TEXTDOMAIN ),
			'edit_item'          => __( 'Edit Transportation Service', THEME_TEXTDOMAIN ),
			'new_item'           => __( 'New Transportation Service', THEME_TEXTDOMAIN ),
			'search_items'       => __( 'Search Transportation Services', THEME_TEXTDOMAIN ),
			'not_found'          => __( 'No Transportation Services found', THEME_TEXTDOMAIN ),
			'not_found_in_trash' => __( 'No Transportation Services found in trash', THEME_TEXTDOMAIN ),
		),
		'public'              => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'_edit_link'          => 'post.php?post=%d',
		'rewrite'             => array(
			'slug'       => 'service',
			'with_front' => false,
		),
		'has_archive'         => false,
		'query_var'           => true,
		'menu_icon'           => 'dashicons-car',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	) );

	/** ---------------------------------------- *
	 *                  Team
	 * ---------------------------------------- */
	register_post_type( 'hm_team', array(
		'labels'              => array(
			'name'               => __( 'Team', THEME_TEXTDOMAIN ),
			'singular_name'      => __( 'Team', THEME_TEXTDOMAIN ),
			'add_new'            => __( 'Add Person', THEME_TEXTDOMAIN ),
			'add_new_item'       => __( 'Add New Person', THEME_TEXTDOMAIN ),
			'view_item'          => __( 'View Person', THEME_TEXTDOMAIN ),
			'edit_item'          => __( 'Edit Person', THEME_TEXTDOMAIN ),
			'new_item'           => __( 'New Person', THEME_TEXTDOMAIN ),
			'search_items'       => __( 'Search Person', THEME_TEXTDOMAIN ),
			'not_found'          => __( 'No Person found', THEME_TEXTDOMAIN ),
			'not_found_in_trash' => __( 'No Person in trash', THEME_TEXTDOMAIN ),
		),
		'public'              => true,
		'publicly_queryable'  => false,
		'exclude_from_search' => true,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'team',
			'with_front' => false,
		),
		'has_archive'         => false,
		'query_var'           => true,
		'menu_icon'           => 'dashicons-groups',
		'supports'            => array( 'title' ),
	) );
}
