<?php
/**
 * @var $args;
 */

global $wp_query;

$tab_name = !empty( $args['tab_name'] ) ? $args['tab_name'] : '';
$category = !empty( $args['category'] ) ? $args['category'] : '';

$wp_query = new WP_Query( [
	'post_type' => 'post',
	'post_status' => array( 'publish' ),
	'posts_per_page' => 5,
	'paged' => 1,
	'tax_query' => [
		[
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $category->slug
		]
	],
] );
?>

<?php if ( have_posts() ) : ?>
	<div class="section-media-resources__tab posts-tab" data-hm-tab="<?= md5( $tab_name ) ?>">
		<div class="posts-tab__cards-container">
			<?php
				$index = 0;

				while ( have_posts() ) {
					the_post();
					$classes = $index === 0 ? 'post__card--full' : '';

					get_template_part( 'fragments/media-resources/posts-tab/post-card', '', ['post_id' => get_the_ID(), 'classes' => $classes] );

					$index++;
				}
			?>
		</div>

		<?php if ( $wp_query->found_posts > 5 ) : ?>
			<div class="section-media-resources__show-more-button-container">
				<button
					class="button button--bordered section-media-resources__show-more-button js-load-more"
					data-hm-tab-type="<?= esc_attr( 'post' ) ?>"
					data-hm-category="<?= esc_attr( $category->slug ) ?>"
					data-hm-max-page="<?= esc_attr( ceil( $wp_query->found_posts / 5 ) ) ?>"
				>
					<?= esc_html__( 'Show more', THEME_TEXTDOMAIN ) ?>
				</button>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
