<?php

/**
 * Register block script
 */

add_action( 'init', function() {
	$template_dir = get_template_directory_uri();

	wp_register_script(
		'block-hero',
		$template_dir . hm_assets_bundle( 'js/blocks/block-hero.js' ),
		array( 'jquery', 'acf' )
	);
});
