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
 * Load Components
 */
add_action( 'init', __NAMESPACE__ . '\load_components', 5 );
function load_components() {
	$theme  = wp_get_theme();
	$blocks = get_components();

	foreach( $blocks as $block ) {
		if ( file_exists( get_template_directory() . '/blocks/components/' . $block . '/block.json' ) ) {
			register_block_type( get_template_directory() . '/blocks/components/' . $block . '/block.json' );

			if ( file_exists( get_template_directory() . '/blocks/components/' . $block . '/init.php' ) ) {
				include_once get_template_directory() . '/blocks/components/' . $block . '/init.php';
			}
		}
	}
}

/**
 * Load Core
 */
add_action( 'init', __NAMESPACE__ . '\load_core', 5 );
function load_core() {
	$theme  = wp_get_theme();
	$blocks = get_core();

	foreach( $blocks as $block ) {
		if ( file_exists( get_template_directory() . '/build/' . $block . '/block.json' ) ) {
			register_block_type( get_template_directory() . '/build/' . $block . '/block.json' );

			if ( file_exists( get_template_directory() . '/blocks/core/' . $block . '/init.php' ) ) {
				include_once get_template_directory() . '/blocks/core/' . $block . '/init.php';
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
 * Load ACF field groups for components
 */
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_components_group' );
function load_acf_field_components_group( $paths ) {
	$blocks = get_blocks();

	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/blocks/components/' . $block;
	}

	return $paths;
}

/**
 * Load ACF field groups for core
 */
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\load_acf_field_core_group' );
function load_acf_field_core_group( $paths ) {
	$blocks = get_core();

	foreach( $blocks as $block ) {
		$paths[] = get_template_directory() . '/blocks/core/' . $block;
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

/**
 * Get Components
 */
function get_components() {
	$theme  = wp_get_theme();

	$blocks = scandir( get_template_directory() . '/blocks/components/' );
	$blocks = array_values( array_diff( $blocks, array( '..', '.' ) ) );

	return $blocks;
}

/**
 * Get Core
 */
function get_core() {
	$theme  = wp_get_theme();

	$blocks = scandir( get_template_directory() . '/blocks/core/' );
	$blocks = array_values( array_diff( $blocks, array( '..', '.' ) ) );

	return $blocks;
}
