<?php
/**
 * @var $args;
 */

extract( $args );

if ( !isset( $page ) || !is_object( $page ) )
	return;

$img_id = get_post_thumbnail_id( $page->ID );
?>

<div class="community-outreach-tab__card" tabindex="0">
	<?php if ( !empty( $img_id ) ) : ?>
		<div class="community-outreach-tab__card-bg">
			<div class="background-img">
				<picture>
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'full-hd' ) ) ?>" media="(max-width: 1280px)">
					<source srcset="<?= esc_url( wp_get_attachment_image_url( $img_id, 'thumbs-desktop' ) ) ?>" media="(max-width: 767px)">
					<img src="<?= esc_url( wp_get_attachment_image_url( $img_id, 'full-hd' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $img_id ) ) ?>">
				</picture>
			</div>
		</div>
	<?php endif; ?>

	<div class="community-outreach-tab__card-content decor-line">
		<div class="community-outreach-tab__card-body">
			<div class="community-outreach-tab__card-title section-title section-title--style6 section-title--white">
				<h3>
					<?= esc_html( $page->post_title ) ?>
				</h3>
			</div>
		</div>

		<div class="community-outreach-tab__card-body community-outreach-tab__card-body--hidden">
			<?php if ( !empty( $page->post_excerpt ) ) : ?>
				<div class="community-outreach-tab__card-description text-content text-content--white">
					<?= esc_html( $page->post_excerpt ) ?>
				</div>
			<?php endif; ?>

			<div class="community-outreach-tab__card-button-wrapper">
				<a href="<?= esc_url( get_permalink( $page ) ) ?>" class="button button--fill community-outreach-tab__card-button" aria-label="<?= esc_attr( sprintf( __( 'Got %s', THEME_TEXTDOMAIN ), $page->post_title ) ) ?>">
					<?= esc_html__('Wellness at bennett', THEME_TEXTDOMAIN) ?>
				</a>
			</div>
		</div>
	</div>
</div>
