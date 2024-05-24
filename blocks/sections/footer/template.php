<?php
/**
 * Block Footer.
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
?>

<footer class="footer">
	<?= hm_get_top_gap() ?>

	<div class="footer__bg-decor" aria-hidden="true">
		<?php echo hm_svg_inline( THEME_ASSETS_URL . '/images/backgrounds/bg-decor-logo.svg' ); ?>
	</div>

	<div class="footer__main">
		<div class="container">
			<div class="footer__content">
				<?php get_template_part( 'fragments/footer/map' ); ?>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon-wrap footer__logo footer__logo--mobile-only">
					<?php echo hm_svg_inline( THEME_ASSETS_URL . '/images/svgs/logo-bennett.svg' ); ?>
				</a>

				<div class="footer__menus">
					<?php
					$footer_menu_locations = [
						'footer-menu-primary',
						'footer-menu-secondary'
					];

					foreach( $footer_menu_locations as $location ) :
						if ( ! has_nav_menu( $location ) ) {
							continue;
						}
						?>

						<div class="footer-menu">
							<div class="section-title section-title--style3 section-title--white footer-menu__title">
								<h3>
									<?php echo wp_get_nav_menu_name( $location ); ?>
								</h3>
							</div>

							<?php
							wp_nav_menu( array(
								'theme_location'  => $location,
								'container'       => 'div',
								'container_class' => 'footer-menu__main',
								'depth'           => 1,
							) );
							?>
						</div><!-- .footer-menu -->
					<?php endforeach; ?>
				</div><!-- .footer__menus -->

				<div class="footer__contacts">
					<div class="footer-contact-item footer-contact-item--desktop-only">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon-wrap footer__logo">
							<?php echo hm_svg_inline( THEME_ASSETS_URL . '/images/svgs/logo-bennett-white.svg' ); ?>
						</a>
					</div><!-- .footer-contact-item -->

					<?php
					get_template_part( 'fragments/footer/address' );

					get_template_part( 'fragments/footer/phones' );

					get_template_part( 'fragments/footer/socials' );
					?>
				</div><!-- .footer__contacts -->
			</div><!-- .footer__content -->
		</div><!-- .container -->
	</div><!-- .footer__main -->

	<div class="footer__bottom">
		<div class="container">
			<div class="footer__bottom-content">
				<?php
				get_template_part( 'fragments/footer/copyright' );

				get_template_part( 'fragments/footer/legal', null, array(
					'is_desktop' => true,
				) );

				get_template_part( 'fragments/footer/links' );

				get_template_part( 'fragments/footer/legal', null, array(
					'is_desktop' => false,
				) );
				?>
			</div>
		</div>
	</div>

	<?= hm_get_bottom_gap() ?>
</footer>

<?php
\Harbinger_Marketing\Modal_Action::render_modals();
