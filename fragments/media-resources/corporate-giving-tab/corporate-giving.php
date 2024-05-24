<?php
/**
 * @var $args;
 */

$tab_name = !empty( $args['tab_name'] ) ? $args['tab_name'] : '';
$cards = !empty( $args['cards'] ) ? $args['cards'] : '';
?>

<?php if ( !empty( $cards ) ) : ?>
	<div class="section-media-resources__tab corporate-giving-tab" data-hm-tab="<?= md5( $tab_name ) ?>">
		<div class="corporate-giving-tab__wrapper">
			<?php foreach ( $cards as $card ) : ?>
				<?= get_template_part( 'fragments/media-resources/corporate-giving-tab/corporate-giving-card', '', ['card' => $card] )?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
