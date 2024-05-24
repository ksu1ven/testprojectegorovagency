<?php
/**
 * Scroll Down Button.
 *
 * @param string $class_name
 *
 * @var $args
*/

extract( $args );

$class_name = $class_name ?? '';
?>

<div class="scroll-down <?= $class_name ?>">
	<button class="button button--scroll-down js-scroll-to-next-section">
		<span class="icon icon-wrap button--scroll-down-icon">
			<?= hm_get_svg_inline( get_template_directory() . '/dist/images/icons/icon-long-arrow.svg' ); ?>
		</span>
	</button>

	<div class="scroll-down__text js-scroll-to-next-section">
		<?= esc_html__('SCROLL DOWN', THEME_TEXTDOMAIN) ?>
	</div>
</div>
