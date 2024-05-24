<?php
/**
 * @var $args;
 */

$tab_name = !empty( $args['tab_name'] ) ? $args['tab_name'] : '';
$pages = !empty( $args['pages'] ) ? $args['pages'] : '';
?>

<?php if ( !empty( $pages ) ) : ?>
	<div class="section-media-resources__tab community-outreach-tab" data-hm-tab="<?= md5( $tab_name ) ?>">
		<div class="community-outreach-tab__wrapper">
			<?php foreach ( $pages as $page ) : ?>
				<?= get_template_part( 'fragments/media-resources/community-outreach-tab/community-outreach-card', '', ['page' => $page] )?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
