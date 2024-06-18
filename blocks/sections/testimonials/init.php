<?php

/**
 * Register block script
 */

add_action( 'init', function() {
	$template_dir = get_template_directory_uri();

	wp_register_script(
		'block-testimonials',
		$template_dir . hm_assets_bundle( 'js/blocks/block-testimonials.js' ),
		array( 'jquery', 'acf' )
	);
});
