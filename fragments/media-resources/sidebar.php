<?php
$sidebar_title = get_field( 'sidebar_title' );

$tags = get_terms( [
	'taxonomy' => 'post_tag',
	'hide_empty' => true,
] );
?>

<?php if ( !empty( $tags ) ) : ?>
	<div class="section-media-resources__sidebar">
		<?php
			get_template_part( 'fragments/common/search-input-for-sections', '', [
				'id' => 'section-media-resources-search-input',
				'class_for_js' => 'js-section-media-resources-search',
				'additional_classes' => 'section-media-resources__search'
			] )
		?>

		<div class="section-media-resources__sidebar-filter sidebar-filter">
			<?php if ( !empty( $sidebar_title ) ) : ?>
				<div class="card-title sidebar-filter__title">
					<?= esc_html( $sidebar_title ); ?>
				</div>
			<?php endif; ?>

			<div class="sidebar-filter__list-container">
				<ul  class="sidebar-filter__list">
					<?php foreach ( $tags as $tag ) : ?>
						<li class="sidebar-filter__list-item" data-hm-tag="<?= esc_attr( $tag->slug ) ?>">
							<button type="button">
								<?= esc_html( $tag->name ) ?>
							</button>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			
			<div class="sidebar-filter__mobile-list-container sidebar-mobile-filter">
				<select class="sidebar-mobile-filter__select">
					<?php foreach ( $tags as $tag ) : ?>
						<option value="<?= esc_attr( $tag->slug ) ?>">
							<?= esc_html( $tag->name ) ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="section-media-resources__button-reset-container">
			<button class="button button--bordered button--with-icon section-media-resources__button-reset js-media-resource-reset">
				<span class="button__text">
					<?= esc_html__( 'Reset All', THEME_TEXTDOMAIN ) ?>
				</span>

				<span class="icon icon-wrap">
					<?= hm_get_svg_inline( get_theme_file_uri( '/dist/images/icons/icon-close.svg' ) ) ?>
				</span>
			</button>
		</div>
	</div>
<?php endif; ?>
