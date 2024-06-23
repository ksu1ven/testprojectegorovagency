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
$title = get_field( 'learning-center_title' );
$description = get_field( 'learning-center_title' );

$video_list = get_field( 'learning-center_video_list' );



?>


<section class="learning-center">
    <div class="container">
        <?php if ( !empty( $title )) : ?>
        <h2 class="h2 learning-center__h2"><?= esc_html( $title) ?></h2>
        <?php endif ?>

        <?php if ( !empty( $title )) : ?>
        <div class="p p--big learning-center__p"><?= esc_html( $description) ?></div>
        <?php endif ?>

        <div class="learning-center__swipers js-learning-center__swipers">
            <?php if (have_rows('learning-center_video_list')) : ?>
            <div class="learning-center-left-col">
                <div class="learning-center-left-swiper js-learning-center-left-swiper">
                    <div class="swiper-wrapper learning-center-left-swiper__wrapper">
                        <?php 
                        $sliced_list=array_slice($video_list, 0, -1);
                        foreach ($sliced_list as $index=>$video) {
                            $name = $video['name'];
                            $job = $video['job'];
                            $video_origin=$video['video_origin'];
                            $img_id = $video['image_preview'];
						    $img = wp_get_attachment_image_url($img_id, 'full');
                            ?>
                        <div class="swiper-slide trainer">
                            <?php if ('self-hosted'===$video_origin) : ?>
                            <?php 
                                $self_hosted_origin=wp_get_attachment_url( $video['self_hosted_origin'] ); ;
                                 
                                ?>
                            <div class="trainer__video-wrapper js-self-hosted-video-wrapper">
                                <div class="trainer__video-wrapper-bg js-self-hosted-video-bg"
                                    style="background-image: url(<?= esc_url( $img) ?>)">
                                    <button class="play__icon js-play-icon">
                                        <svg class="testimonials__svg" role="img" aria-hidden="true" width="40"
                                            height="42">
                                            <use xlink:href="#video-play-icon"></use>
                                        </svg>
                                    </button>
                                    <div class="trainer__info">
                                        <?php if ( !empty( $name )) : ?>
                                        <div class="trainer__name"><?= esc_html( $name) ?></div>
                                        <?php endif ?>
                                        <?php if ( !empty( $job )) : ?>
                                        <div class="trainer__job"><?= esc_html( $job) ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <video id="self-hosted-player" class="background-video js-self-hosted-video"
                                    src="<?= esc_url( $self_hosted_origin) ?>" poster="<?= esc_url( $img) ?>"
                                    crossOrigin="anonymous">
                                </video>
                            </div>

                            <?php elseif ('youtube'===$video_origin) : ?>
                            <?php  
                                 $youtube_id=$video['youtube_id']
                        ?>

                            <div class="video-wrapper js-youtube-video-wrapper">
                                <div class="trainer__video-wrapper-bg js-youtube-video-bg"
                                    style="background-image: url(<?= esc_url( $img) ?>)">
                                    <button class="play__icon js-play-icon">
                                        <svg class="testimonials__svg" role="img" aria-hidden="true" width="40"
                                            height="42">
                                            <use xlink:href="#video-play-icon"></use>
                                        </svg>
                                    </button>
                                    <div class="trainer__info">
                                        <?php if ( !empty( $name )) : ?>
                                        <div class="trainer__name"><?= esc_html( $name) ?></div>
                                        <?php endif ?>
                                        <?php if ( !empty( $job )) : ?>
                                        <div class="trainer__job"><?= esc_html( $job) ?></div>
                                        <?php endif ?>
                                    </div>

                                </div>
                                <div id="learning-youtube-player-left-<?= esc_attr( $index) ?>"
                                    class="background-video js-youtube-video"
                                    data-youtube-id="<?= esc_attr(  $youtube_id) ?>"></div>
                            </div>


                            <?php endif; ?>
                        </div>
                        <?php 
                        }       
                        ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if (have_rows('learning-center_video_list')) : ?>
            <div class="learning-center-right-col">
                <div class="learning-center-right-swiper js-learning-center-right-swiper">
                    <div class="swiper-wrapper learning-center-right-swiper__wrapper">
                        <?php 
                         $sliced_list_2=array_slice($video_list, 1);
                        foreach ($sliced_list_2 as $index=>$video) {
                            $name = $video['name'];
                            $job = $video['job'];
                            $video_origin=$video['video_origin'];
                            $img_id = $video['image_preview'];
						    $img = wp_get_attachment_image_url($img_id, 'full');
                            ?>
                        <div class="swiper-slide trainer">
                            <?php if ('self-hosted'===$video_origin) : ?>
                            <?php 
                                $self_hosted_origin=wp_get_attachment_url( $video['self_hosted_origin'] ); ;
                                 
                                ?>
                            <div class="trainer__video-wrapper js-self-hosted-video-wrapper">
                                <div class="trainer__video-wrapper-bg js-self-hosted-video-bg"
                                    style="background-image: url(<?= esc_url( $img) ?>)">
                                    <button class="play__icon js-play-icon">
                                        <svg class="testimonials__svg" role="img" aria-hidden="true" width="40"
                                            height="42">
                                            <use xlink:href="#video-play-icon"></use>
                                        </svg>
                                    </button>
                                    <div class="trainer__info">
                                        <?php if ( !empty( $name )) : ?>
                                        <div class="trainer__name trainer__name--small"><?= esc_html( $name) ?></div>
                                        <?php endif ?>
                                        <?php if ( !empty( $job )) : ?>
                                        <div class="trainer__job"><?= esc_html( $job) ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <video id="self-hosted-player" class="background-video js-self-hosted-video"
                                    src="<?= esc_url( $self_hosted_origin) ?>" poster="<?= esc_url( $img) ?>"
                                    crossOrigin="anonymous">
                                </video>



                            </div>

                            <?php elseif ('youtube'===$video_origin) : ?>
                            <?php  
                                 $youtube_id=$video['youtube_id']
                                 ?>

                            <div class="video-wrapper js-youtube-video-wrapper">
                                <div class="trainer__video-wrapper-bg js-youtube-video-bg"
                                    style="background-image: url(<?= esc_url( $img) ?>)">
                                    <button class="play__icon js-play-icon">
                                        <svg class="testimonials__svg" role="img" aria-hidden="true" width="40"
                                            height="42">
                                            <use xlink:href="#video-play-icon"></use>
                                        </svg>
                                    </button>
                                    <div class="trainer__info">
                                        <?php if ( !empty( $name )) : ?>
                                        <div class="trainer__name trainer__name--small"><?= esc_html( $name) ?></div>
                                        <?php endif ?>
                                        <?php if ( !empty( $job )) : ?>
                                        <div class="trainer__job"><?= esc_html( $job) ?></div>
                                        <?php endif ?>
                                    </div>

                                </div>
                                <div id="learning-youtube-player-right-<?= esc_attr( $index) ?>"
                                    class="background-video js-youtube-video"
                                    data-youtube-id="<?= esc_attr(  $youtube_id) ?>"></div>
                            </div>


                            <?php endif; ?>
                        </div>
                        <?php 
                        }       
                        ?>
                    </div>
                </div>
                <div class="learning-center-swiper__controls">
                    <div class="swiper-button-prev controls__prev js-learning-center-swiper-button-prev">
                        <svg class="swiper-button-prev__svg" role="img" aria-hidden="true" width="25" height="25">
                            <use xlink:href="#arrow-icon"></use>
                        </svg>
                    </div>
                    <div class="swiper-pagination controls__rounds js-learning-center-swiper-pagination"></div>
                    <div class="swiper-button-next controls__next js-learning-center-swiper-button-next">
                        <svg class="swiper-button-prev__svg" role="img" aria-hidden="true" width="25" height="25">
                            <use xlink:href="#arrow-icon"></use>
                        </svg>
                    </div>
                </div>

            </div>

            <?php endif; ?>

        </div>

</section>