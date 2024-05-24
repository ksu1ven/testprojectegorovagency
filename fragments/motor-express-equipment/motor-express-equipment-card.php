<?php
/**
 * Card.
 *
 * @param string $title
 * @param string $description
 * @param string $image_url
 *
 * @var $args
*/

extract( $args );
?>

<div class="section-motor-express-equipment__card">
	<div class="section-motor-express-equipment__card-image">
		<?= hm_get_svg_inline( $image_url ); ?>
	</div>

	<div class="card-title section-motor-express-equipment__card-title">
		<?= esc_html( $title ) ?>
	</div>

	<div class="text-content section-motor-express-equipment__card-text">
		<?= apply_filters( 'the_content', $description )?>
	</div>

	<div class="section-motor-express-equipment__card-bg">
		<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/backgrounds/bg-decor-logo.svg' ); ?>
	</div>
</div>