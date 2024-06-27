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
?>


<section class="advantages">
    <div class="container">
        <div class="advantages__content">
            <?php if (have_rows('advantages_list')) : ?>
            <div class="advantages__flex">
                <?php 
                    foreach ($advantages_list as $index=>$advantage) {
                        $img_id = $advantage['image'];
                        $text =$advantage['text'];
                                
                            ?>
                <div class="advantages__item">
                    <?= hm_get_svg_inline( wp_get_attachment_url( $img_id ) ); ?>
                    <h3 class="h3 advantages__h3">
                        <?php echo esc_html(  $text )  ?>
                    </h3>
                </div>
                <?php 
                    }
                ?>
            </div>
            <?php else : ?>
            <div class="p p--small">No Advantages :(</div>
            <?php endif ?>
            <a href="javascript:void(0)" class="link link--white advantages__link">Learn More</a>
        </div>
    </div>
</section>