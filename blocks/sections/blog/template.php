<?php
/**
 * Block Hero.
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
	hm_get_template_part_with_params( 'fragments/block-preview-image', ['block' =>
$block] ); return; } /** * Block Variables */ 
$advantages_list=get_field( 'advantages_list' );


function split_content($content) {
    $parts = explode('[split]', $content);
    if (count($parts) > 1) {
        return $parts;
    }
    return [$content];
}
?>


<section class="blog">
    <div class="container blog__content client-text-field">

        <?php
    $content = apply_filters('the_content', get_the_content()); 
    $parts = split_content($content);

    echo the_date('F j, Y', $parts[0]); 

    if (isset($parts[1])) {
        echo $parts[1];
    }

    if ( has_post_thumbnail() ) {
        the_post_thumbnail('full', array('class' => 'featured-image'));
    }

    if (isset($parts[2])) {
        echo $parts[2];
    }
    ?>
    </div>
</section>