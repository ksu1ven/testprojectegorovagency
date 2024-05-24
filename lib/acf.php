<?php

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => __( 'Theme Options', THEME_TEXTDOMAIN ),
		'menu_title' => __( 'Theme Options', THEME_TEXTDOMAIN ),
		'menu_slug'  => 'theme-options',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

	acf_add_options_page(array(
		'page_title' 	=> __( 'Global Parts', THEME_TEXTDOMAIN ),
		'menu_title'	=> __( 'Global Parts', THEME_TEXTDOMAIN ),
		'menu_slug' 	=> 'global-parts-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'icon_url'      => 'dashicons-block-default'
	));
}

add_filter( 'acf/settings/show_admin', 'hm_acf_show_admin' );
function hm_acf_show_admin( $show ) {
	if ( defined( 'WP_LOCAL_DEV' ) && WP_LOCAL_DEV ) {
		return true;
	}

	return false;
}

add_action('acf/init', 'hm_add_google_maps_api_key');
function hm_add_google_maps_api_key() {
	$api_key = hm_get_google_maps_api_key();

	acf_update_setting( 'google_api_key', $api_key );
}

/**
 * Register Gutenberg Block Theme category
 *
 * @see https://www.advancedcustomfields.com/resources/local-json/
 *
 * @param  array $paths ACF loads all .json files from multiple load points
 * @return array
 */
add_filter( 'block_categories_all', 'hm_register_theme_blocks_category', 10, 2 );
function hm_register_theme_blocks_category( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'hm-sections',
				'title' => 'Sections',
			),
		),
		array(
			array(
				'slug'  => 'hm-components',
				'title' => 'Components',
			),
		)
	);
}

add_filter('acf/load_field/name=form_id', 'hm_populate_form_ids');
function hm_populate_form_ids( $field ) {
	$field['choices'] = array();
	$forms            = hm_get_forms();

	if ( ! empty( $forms ) ) {
		foreach ( $forms as $form_id => $label ) {
			$field['choices'][ $form_id ] = $label;
		}
	}

	return $field;
}

function hm_get_forms() {
	static $ninja_forms_list = null;

	if ( is_null($ninja_forms_list) ) {
		if ( class_exists('Ninja_Forms') ) {
			$forms_list = Ninja_Forms()->form()->get_forms();
			foreach ( $forms_list as $form ) {
				$ninja_forms_list[$form->get_id()] = $form->get_setting( 'title' );
			}
		}
	}

	return $ninja_forms_list;
}

add_action( 'acf/validate_save_post', 'hm_validate_save_post', 5 );
function hm_validate_save_post() {
	if ( ! isset( $_POST ) || empty( $_POST ) ) {
		return;
	}

	foreach( $_POST as $key => $value ) {
		if ( strpos( $key, 'acf' ) === 0 ) {
			if ( ! empty( $_POST[ $key ] ) ) {
				acf_validate_values( $_POST[ $key ], $key );
			}
		}
	}
}

add_filter( 'acf/fields/wysiwyg/toolbars', 'hm_remove_fullscreen_button' );
function hm_remove_fullscreen_button( $toolbars ) {
	foreach ( $toolbars as $toolbar_key => $button_rows ) {
		foreach ( $button_rows as $button_row => $buttons ) {
			$button_key = array_search( 'fullscreen', $buttons );

			if ( false !== $button_key ) {
				unset( $toolbars[ $toolbar_key ][ $button_row ][ $button_key ] );
			}
		}
	}

	return $toolbars;
}
