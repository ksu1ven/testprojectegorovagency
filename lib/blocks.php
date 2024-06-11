<?php

namespace Harbinger_Marketing;

/**
 * Load Blocks
 */
add_action( 'init', __NAMESPACE__ . '\load_blocks', 5 );
function load_blocks() {
	$theme  = wp_get_theme();
	$blocks = get_blocks();

	foreach( $blocks as $block ) {
		if ( file_exists( get_template_directory() . '/blocks/sections/' . $block . '/block.json' ) ) {
			register_block_type( get_template_directory() . '/blocks/sections/' . $block . '/block.json' );

			if ( file_exists( get_template_directory() . '/blocks/sections/' . $block . '/init.php' ) ) {
				include_once get_template_directory() . '/blocks/sections/' . $block . '/init.php';
			}
		}
	}
}

/**
 * Load ACF field groups for blocks
 */
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_block_group' );
function load_acf_field_block_group( $paths ) {
	$blocks = get_blocks();

	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/blocks/sections' . $block;
	}

	return $paths;
}


/**
 * Get Blocks
 */
function get_blocks() {
	$theme  = wp_get_theme();

	$blocks = scandir( get_template_directory() . '/blocks/sections/' );
	$blocks = array_values( array_diff( $blocks, array( '..', '.' ) ) );

	return $blocks;
}
