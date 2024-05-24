<?php
/**
 * Block Header.
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

<header class="header">
	<div class="container">
		<div class="header__line header__line--top header-top">
			<div class="header-top__left">
				<?php get_template_part( 'fragments/header/logo' ); ?>
			</div>

			<div class="header-top__right">
				<div class="header-top__navigation">
					<?php
						get_template_part( 'fragments/header/nav', false, array(
							'location'        => 'header-menu',
							'container_class' => 'navigation-top',
						) );
					?>
				</div>

				<?= get_template_part( 'fragments/header/phone' ); ?>

				<div class="header-top__search">
					<?= get_template_part( 'fragments/header/search' ); ?>
				</div>
			</div>
		</div>

		<div class="header__line header__line--bottom header-bottom">
			<div class="header-bottom__button header-bottom__button--menu">
				<button class="header-btn js-open-fullscreen-menu">
					<span class="header-btn__icon">
						<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-burger-menu.svg' ) ) ?>
					</span>

					<span class="header-btn__text js-header-btn__text">
						<?= esc_html__( 'Menu', THEME_TEXTDOMAIN ) ?>
					</span>
				</button>
			</div>

			<div class="header-bottom__navigation">
				<?php
					get_template_part( 'fragments/header/nav', false, array(
						'location'        => 'main-menu',
						'container_class' => 'navigation-bottom',
					) );
				?>
			</div>

			<div class="header-bottom__button header-bottom__button--request">
				<a href="#" class="header-btn js-bt-modal-quote" data-toggle="modal">
					<?= esc_html__( 'Request A Quote', THEME_TEXTDOMAIN ) ?>
				</a>
			</div>
		</div>
	</div>

	<div class="fullscreen-menu js-fullscreen-menu">
		<div class="fullscreen-menu__scroll">
			<div class="fullscreen-menu__scroll-offset">
				<div class="fullscreen-menu__scroll-inner">
					<div class="container">
						<div class="fullscreen-menu__wrapper">
							<div class="fullscreen-menu__lines">
								<div class="line"></div>

								<div class="line"></div>

								<div class="line"></div>

								<div class="line"></div>
							</div>

							<?php
								get_template_part( 'fragments/header/nav', false, array(
									'location'        => 'header-menu',
									'container_class' => 'fullscreen-menu__top',
								) );
							?>

							<?php
								get_template_part( 'fragments/header/nav', false, array(
									'location'        => 'main-menu',
									'container_class' => 'fullscreen-menu__center js-fullscreen-menu__center',
								) );
							?>

							<div class="fullscreen-menu__bottom">
								<?= get_template_part( 'fragments/header/address' ); ?>

								<?= get_template_part( 'fragments/header/phones' ); ?>

								<?= get_template_part( 'fragments/header/socials' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
