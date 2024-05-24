<?php
/**
 * Awards We Won Throw The Years
 *
 * @param array $group
 *
 * @var $args
 */

extract( $args );

if ( empty( $group ) )
	return;

$unique_key = wp_generate_uuid4();
$links = $group['links'] ?? [];
?>

<div class="awards-throw-the-years__collapse">
	<div
		class="awards-throw-the-years__header decor-line collapsed"
		data-bs-toggle="collapse"
		data-bs-target="#awards-<?= esc_attr( $unique_key ) ?>"
		aria-expanded="false"
		aria-controls="awards-<?= esc_attr( $unique_key ) ?>"
		aria-label="<?= esc_attr__('Open Awards', THEME_TEXTDOMAIN) ?>"
	>
		<?php if ( $group['title'] ) : ?>
			<div class="awards-throw-the-years__title card-title">
				<?= esc_html( $group['title'] ) ?>
			</div>
		<?php endif; ?>

		<div class="awards-throw-the-years__header-icon"></div>
	</div>

	<div class="awards-throw-the-years__awards collapse" id="awards-<?= esc_attr( $unique_key ) ?>">
		<?php foreach ( $links as $link ) : ?>
			<?php
				$link = $link['link'];
				$target = !empty( $link['target'] ) ? "target={$link['target']}" : '';
			?>
			<div class="awards-throw-the-years__award-item">
				<span class="icon icon-wrap awards-throw-the-years__award-icon">
					<?= hm_get_svg_inline( THEME_ASSETS_URL . '/images/icons/icon-star.svg' ); ?>
				</span>

				<a href="<?= esc_url( $link['url'] ) ?>" <?= esc_attr( $target ) ?> class="awards-throw-the-years__award-text">
					<?= !empty( $link['title'] ) ? esc_html( $link['title'] ) : esc_html__( 'Your Link Title', THEME_TEXTDOMAIN ) ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>
