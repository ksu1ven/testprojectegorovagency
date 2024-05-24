<?php
/**
 * Block Hero.
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
$section_enable_kicker = get_field( 'enable_kicker' );
$section_phrase = get_field( 'hero_section_phrase' );
$section_breadcrumbs = get_field( 'hero_section_breadcrumbs' );
$section_subtitle = get_field( 'hero_section_subtitle' );
$section_title_type = get_field( 'hero_section_title_type' );
$section_title = get_field( 'hero_section_title_text' );
$section_description = get_field( 'hero_section_description' );
$section_scroll_down_button = get_field( 'hero_section_scroll_down_button' );
$title_image_id = get_field( 'hero_section_title_image' );
$section_title_classes = 'section-title--white';
$section_additional_classes = '';
$subtitle_classes = 'subtitle section-hero__subtitle';
$section_note_classes = 'subtitle section-hero__note';
$section_background = get_field( 'hero_section_background_background' );
$background_type = $section_background['type'];
$buttons = get_field( 'hero_section_buttons' );

if ( 'empty' === $background_type ) {
	$section_additional_classes = 'section-hero--without-bg';
	$section_title_classes = '';
	$subtitle_classes .= ' subtitle--dark';
	$section_note_classes .= ' subtitle--dark';
}


if ( $section_title_type === 'image' ) {
	$section_title_classes .= ' section-hero__title--image';
}
?>

<?php if( !empty( $section_title ) ) : ?>
	<section class="section section-hero <?= $section_additional_classes ?>">
		<?= hm_get_top_gap() ?>

		<!-- TODO: add class 'menu-two-lines' or 'menu-three-lines' depends on menu struscture -->
		<div class="section__bg section-hero__background menu-two-lines" aria-hidden="true">
			<?php if ( 'empty' !== $background_type ) : ?>
				<div class="background-img">
					<?php if ( 'image' === $background_type ) : ?>
						<?php
						$background_image = $section_background['image'];
						?>
						<picture>
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $background_image, 'bg-image-4k' ) ) ?>" media="(min-width: 1920px)">
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $background_image, 'bg-image-desktop' ) ) ?>" media="(min-width: 1280px)">
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $background_image, 'bg-image-tablet' ) ) ?>" media="(max-width: 1279px)">
							<source srcset="<?= esc_url( wp_get_attachment_image_url( $background_image, 'bg-image-mobile' ) ) ?>" media="(max-width: 767px)">
							<img src="<?= esc_url( wp_get_attachment_image_url( $background_image, 'bg-image-4k' ) ) ?>" alt="<?= esc_attr( hm_get_attachment_image_alt( $background_image ) ) ?>">
						</picture>

					<?php elseif ( 'video' === $background_type ) : ?>
						<?php
						$background_video_url = wp_get_attachment_url( $section_background['video'] );
						$background_video_poster = wp_get_attachment_image_url( $section_background['video_poster'], 'full-hd' );
						?>
						<?php if ( !empty( $background_video_url ) && !empty( $background_video_poster ) ) : ?>
							<video disablePictureInPicture="true" loop="loop" autoplay="true" playsinline="true" muted="true" poster="<?= esc_url( $background_video_poster ); ?>">
								<source src="<?= esc_url( $background_video_url ); ?>" type="video/mp4">
							</video>
						<?php endif; ?>

					<?php endif; ?>
				</div>

			<?php else : ?>
				<div class="container">
					<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/backgrounds/bg-decor-logo.svg' ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="section__body">
			<div class="container">
				<div class="section-hero__content">
					<div class="section-hero__top">
						<?php if ( $section_enable_kicker && !empty( $section_phrase ) ) : ?>
							<div class="<?= $section_note_classes ?>">
								<?= esc_html( $section_phrase ) ?>
							</div>
						<?php endif ?>

						<?php if ( $section_breadcrumbs ) : ?>
							<?php
							if ( function_exists( 'yoast_breadcrumb' ) ) {
								yoast_breadcrumb( '<div class="section-hero__bread-crumbs">','</div>' );
							}
							?>
						<?php endif ?>
					</div>

					<div class="section-hero__main decor-line">
						<div class="section-title section-title--style1 section-hero__title <?= $section_title_classes ?>">
							<h1 class="<?= !empty( $title_image_id ) ? 'sr-only' : '' ?>">
								<?= esc_html( $section_title ) ?>
							</h1>

							<?php if ( !empty( $title_image_id ) ) : ?>
								<div class="section-hero__image-container">
									<?= hm_get_svg_inline( wp_get_attachment_image_url( $title_image_id ) ); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( !empty( $section_subtitle ) ) : ?>
							<div class="<?= $subtitle_classes ?>">
								<?= esc_html( $section_subtitle ) ?>
							</div>
						<?php endif; ?>

						<?php if ( !empty( $section_description ) ) : ?>
							<div class="section-hero__description text-content <?php if ( 'empty' !== $background_type ) echo 'text-content--white' ?>">
								<?= apply_filters( 'the_content', $section_description ) ?>
							</div>
						<?php endif; ?>

						<?php
							get_template_part( 'fragments/common/buttons', '', [
								'class_name' => 'section-hero__buttons-container',
								'buttons' => $buttons
							] );
						?>
					</div>

					<?php
					if ( $section_scroll_down_button && $background_type !== 'empty' ) {
						get_template_part( 'fragments/common/scroll-down-button', '', [
							'class_name' => 'section-hero__scroll'
						]);
					}
					?>
				</div>
			</div>
		</div>

		<?= hm_get_bottom_gap() ?>
	</section>
<?php endif ?>
