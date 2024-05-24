<?php
/**
 * Recognition
 *
 * @param string $tab_name
 *
 * @var $args
 */

$tab_name = !empty( $args['tab_name'] ) ? $args['tab_name'] : '';
$group_articles = get_field( 'awards_group_articles', 'option' );

if ( empty( $group_articles ) )
	return;
?>


<div class="section-media-resources__tab corporate-giving-tab" data-hm-tab="<?= md5( $tab_name ) ?>">
	<div class="awards-throw-the-years__collapses-container">
		<?php foreach ( $group_articles as $key => &$group ) : ?>
			<?php $group['key'] = $key; ?>

			<?= get_template_part( 'fragments/awards-throw-the-years-collapses/awards-throw-the-years-collapses', '', ['group' => $group] ) ?>
		<?php endforeach; ?>
	</div>
</div>
