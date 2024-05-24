<?php
/**
 * @var $args;
 */

if ( !isset( $args['tabs'] ) )
	return;

$tabs = $args['tabs'];
$index = 0;
?>

<?php if ( !empty( $tabs ) ) : ?>
	<div class="tabs-navigation-line">
		<?php foreach ( $tabs as $index => $tab ) : ?>
			<div class="tabs-navigation-line__item <?= $index === 0 ? 'active' : '' ?>" data-hm-target="<?= md5( $index . $tab['name'] )?>">
				<?= esc_html( $tab['name'] ) ?>
			</div>

			<?php $index++ ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
