<?php
/**
 * Block Hero.
 *
 * @var array $block The block settings and attributes.
 * @var string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @var $post_id (int|string) The post ID this block is saved to.
 * 
 * 
 */

/**
 * Block preview image
 */
if ( isset( $block['data']['block_preview_images'] ) ) {
	hm_get_template_part_with_params( 'fragments/block-preview-image', ['block' =>
$block] ); return; } 

/** * Block Variables */ 
$title = get_field( 'hero_title' );
$description = get_field( 'hero_description' );
$background = get_field( 'hero_section_background_background' );
$background_type = $background['type'];
$hero_nav = get_field( 'hero_section_nav' );
$nav_list = get_field( 'nav' );


?>





<section class="hero js-section-hero">
    <?php if ( 'empty' !== $background_type ) : ?>
    <?php if ( 'video'=== $background_type ) : ?>
    <?php
				$background_video_url = wp_get_attachment_url( $background['video'] );
				$background_video_poster = wp_get_attachment_image_url( $background['video_poster'], 'full-hd' );
			?>
    <video class="background-video hero__backround-video js-hero__backround-video"
        src="<?= esc_url( $background_video_url ); ?>" poster="<?= esc_url( $background_video_poster ); ?>"
        muted></video>
    <?php elseif ( 'image' === $background_type ) : ?>
    <?php
        $background_image_url = wp_get_attachment_url( $background['image'] );
				
			?>
    <img class="background-img" src="<?= esc_url( $background_image_url ); ?>" alt="Background image">
    <?php endif; ?>
    <?php endif; ?>
    <div class="hero__backround-video-preview"></div>

    <div class="container">
        <div class="row">
            <div class='col'>
                <?php if ( $hero_nav  ) : ?>
                <nav class="nav nav--small">
                    <?php if (have_rows('nav')) : ?>
                    <ul class="nav__ul nav__ul--extra-small js-nav__ul--hero">
                        <?php 
					foreach ($nav_list as $index=>$nav_item) {
						$item=$nav_item['item'];             
                        $link_url = $item['url'];
                        $link_title = $item['title'];
                        $url = ($link_url === '/javascript:void(0)') ? esc_attr('javascript:void(0)') : esc_url($link);
								
							?>
                        <li
                            class="nav__li js-nav__li nav__li--small <?php if ($index == '0'){ ?>nav__li--active<?php   } ?>">
                            <a href="<?=  $url  ?>"><?php echo esc_html(  $link_title)  ?></a>
                        </li>
                        <?php 
						}
						?>
                    </ul>
                    <?php else : ?>
                    <div class="p p--small">No navigation :(</div>
                    <?php endif ?>
                </nav>
                <?php endif ?>
            </div>
            <div class="col col-12 col-lg-6 hero__content">
                <?php if ( !empty( $title )) : ?>
                <h1 class="h1">
                    <span class="h1__name"><?= esc_html( $title ) ?></span>
                    <?php if ( !empty( $description )) : ?>
                    <span class="h1__description"><?= esc_html( $description ) ?></span>
                    <?php endif ?>
                    <span class="h1__description"><?= esc_html( $description ) ?></span>
                </h1>
                <?php endif ?>


                <div class="hero__buttons">
                    <button class="button button--colored" type="button" data-toggle="modal"
                        data-target="#book-consultation">
                        Book Consultation
                    </button>
                    <button class="button button--transparent js-play-video-button" type="button" data-toggle="modal"
                        data-origin="youtube" data-youtube-id="ebEv8C1yffo" aria-label="Open video modal">
                        <svg fill="currentColor" aria-hidden="true" role="img" width="18" height="20"
                            viewBox="0 0 18 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.338 7.692l-11.813-7.281c-.855-.526-1.888-.548-2.764-.059-.876.489-1.399 1.381-1.399 2.384v14.497c0 1.517 1.223 2.759 2.725 2.767h.012c.47 0 .959-.147 1.416-.426.368-.224.484-.704.26-1.072-.224-.368-.704-.484-1.072-.26-.214.13-.423.198-.608.198-.567-.003-1.174-.489-1.174-1.207v-14.497c0-.431.224-.813.6-1.023.376-.21.819-.201 1.185.025l11.813 7.281c.355.219.558.583.557 1-.001.417-.206.781-.563.998l-8.541 5.229c-.367.225-.483.705-.258 1.072.225.367.705.483 1.072.258l8.54-5.229c.818-.499 1.307-1.368 1.309-2.326.002-.958-.484-1.829-1.299-2.331z" />
                        </svg>
                        <span>Play Video</span>
                    </button>
                </div>
            </div>
        </div>
    </div>



</section>