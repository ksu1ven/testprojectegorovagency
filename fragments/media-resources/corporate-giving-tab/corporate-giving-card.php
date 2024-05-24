<?php
/**
 * @var $args;
 */

extract( $args );

if ( !isset( $card ) )
	return;
?>

<div class="corporate-giving-tab__card">
	<?php if ( !empty( $card['image'] ) ) : ?>
		<div class="corporate-giving-tab__card-image">
			<div class="background-img">
				<picture>
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $card['image'], 'bg-image-4k' ) ) ?>" media="(min-width: 1280px)">
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $card['image'], 'bg-image-desktop' ) ) ?>" media="(max-width: 1279px)">
					<img src="<?= esc_url( wp_get_attachment_image_url( $card['image'] ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
				</picture>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( !empty( $card['title'] ) ) : ?>
		<div class="card-title corporate-giving-tab__card-title decor-line">
			<h3>
				<?= esc_html( $card['title'] ); ?>
			</h3>
		</div>
	<?php endif; ?>

	<?php if ( !empty( $card['description'] ) ) : ?>
		<div class="corporate-giving-tab__card-description text-content">
			<?= apply_filters( 'the_content', $card['description'] ); ?>
		</div>
	<?php endif; ?>
</div>
