<?php
/**
 * Bennet Component Table
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
$table = get_field( 'table' );

$index = 0;
?>

<?php if ( !empty( $table ) ) : ?>
	<div class="content-table">
		<?php foreach ( $table as $column ) : ?>
			<div class="content-table__column">
				<?php if ( !empty( $column ) ) : ?>
					<div class="content-table__cell content-table__cell--large <?= $index % 2 === 0 ? 'content-table__cell--gray' : 'content-table__cell--blue' ?>">
						<?= esc_html( $column['name'] ) ?>
					</div>
				<?php endif; ?>

				<?php if ( !empty( $column['rows']  ) ) : ?>
					<?php foreach ( $column['rows'] as $row ) : ?>
						<div class="content-table__cell content-table__cell--bold">
							<?= esc_html( $row['name'] ) ?>
						</div>

						<div class="content-table__cell">
							<?= esc_html( $row['value'] ) ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<?php $index++ ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
