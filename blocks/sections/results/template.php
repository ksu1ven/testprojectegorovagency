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
$block] ); return; } /** * Block Variables */ $results =
get_field('results_list'); ?>

<section class="results js-section-results">
    <div class="container results__container">
        <?php if (have_rows('results_list')) : ?>
        <div class="results-swiper__left">
            <div class="text-swiper js-text-swiper">
                <div class="swiper-wrapper text-swiper__wrapper">
                    <?php 
                    foreach ($results as $result) {
                        $title = $result['title'];
                        $description = $result['description'];
                        ?>
                    <div class="swiper-slide">
                        <h2 class="h2"><?php echo esc_html($title); ?></h2>
                        <div class="p p--big results__p">
                            <?php echo esc_html($description); ?>
                        </div>
                    </div>
                    <?php 
                    }       
                    ?>
                </div>
            </div>
            <div class="results-swiper__controls">
                <div class="swiper-button-prev controls__prev js-swiper-button-prev">
                    <svg class="swiper-button-prev__svg" role="img" aria-hidden="true" width="25" height="25">
                        <use xlink:href="#arrow-icon"></use>
                    </svg>
                </div>
                <div class="swiper-pagination controls__rounds js-swiper-pagination"></div>
                <div class="swiper-button-next controls__next js-swiper-button-next">
                    <svg class="swiper-button-prev__svg" role="img" aria-hidden="true" width="25" height="25">
                        <use xlink:href="#arrow-icon"></use>
                    </svg>
                </div>
            </div>
        </div>
        <div class="swiper results-swiper js-results-swiper">
            <div class="swiper-wrapper results__swiper-wrapper">
                <?php 
                    foreach ($results as $index=>$result) { 
                        $before_id = $result['image_before'];
                        $after_id = $result['image_after']; 
                        $before = wp_get_attachment_image_url($before_id, 'full'); 
                        $after = wp_get_attachment_image_url($after_id, 'full'); 
                ?>
                <div class="swiper-slide">
                    <div class="results__slide">
                        <div class="results__img-container">
                            <div class="twentytwenty-container">
                                <img class="twentytwenty__img" src="<?= esc_url($before) ?>"
                                    alt="Girl <?php echo esc_html($index) ?> before" />
                                <img class="twentytwenty__img" src="<?= esc_url($after) ?>"
                                    alt="Girl <?php echo esc_html($index) ?> after" />
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    }       
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>