<?php
/**
 * Bennet Component Button.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var $post_id (int|string) The post ID this block is saved to.
 */

/**
 * Block preview image
 */
if ( isset( $block['data']['block_preview_images'] ) ) {
	hm_get_template_part_with_params( 'fragments/block-preview-image', ['block' => $block] );
	return;
}

/**
 * Block Variables
 */
$buttons = get_field( 'buttons' );

if ( !empty( $buttons['buttons_generator'] ) )
	get_template_part( 'fragments/common/buttons', '', [
		'class_name' => 'buttons-wrap',
		'buttons' => $buttons]
	);
else
	esc_html__( 'Select Your Buttons', THEME_TEXTDOMAIN );
