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
$form_title = get_field( 'book_form_title' );
$form_description = get_field( 'book_form_description' );
$form = get_field( 'book_form' );

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

    <div class="modal fade" id="book-consultation" tabindex="-1" role="dialog" aria-labelledby="Book consultation"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog--with-form" role="document">
            <div class="modal-content">
                <button type="button" class="close popup__close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><svg role="img" aria-hidden="true" width="24" height="24">
                            <use xlink:href="#menu-icon-cross"></use>
                        </svg></span>
                </button>
                <?php if ( !empty( $form_title )) : ?>
                <h2 class="h2 modal__h2"><?= esc_html( $form_title) ?></h2>
                <?php endif ?>
                <?php if ( !empty( $form_description )) : ?>
                <div class="p modal__p">
                    <?= esc_html( $form_description) ?>
                </div>
                <?php endif ?>
                <?php if ( (have_rows('book_form'))) : ?>
                <form class="form" action="#" name="consultation">
                    <div class="form__inputs">
                        <?php 
                     foreach ($form as $index=>$form_item) {
						    $label=$form_item['label'];
                            $type=$form_item['type'];
                            $id=$form_item['id'];
					?>
                        <div class="form__div" data-placeholder="<?php echo esc_html(  $label )  ?>">
                            <label class="visually-hidden" for="<?php echo esc_html(  $id )  ?>">
                                <?php echo esc_html(  $label )  ?>
                            </label>
                            <input class="form__input" type="<?php echo esc_html(  $type )  ?>"
                                placeholder="<?php echo esc_html(  $label )  ?>" name="<?php echo esc_html(  $id )  ?>"
                                id="<?php echo esc_html(  $id )  ?>" />
                        </div>
                        <?php 
						}
						?>
                    </div>
                    <button type="submit" class="button button--colored form__button">
                        Submit
                    </button>
                </form>
                <?php endif ?>
            </div>
        </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" hidden>
        <symbol id="woman-icon" viewBox="0 0 120 120" fill="currentColor">
            <path
                d="M106.1 120h-96.1c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h.7c.1-2.2.4-4.3.9-6.5v-.1c1.4-6.8 4.2-13.1 8.2-18.8v-47.8c0-22.2 18-40.2 40.2-40.2 22.2 0 40.2 18 40.2 40.2v47.8c4 5.6 6.8 12 8.2 18.7v.1c.4 2.1.7 4.3.9 6.5h.7c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.5 3.3-3.3 3.3l-3.9.1zm.1-2h3.9c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-2.6v-1c-.1-2.4-.4-4.9-.9-7.2-1.4-6.6-4.1-12.8-8.1-18.3l-.2-.3v-48.4c-.1-21.1-17.2-38.2-38.3-38.2-21.1 0-38.2 17.1-38.2 38.2v48.5l-.2.3c-4 5.5-6.7 11.6-8.1 18.2v.1c-.5 2.4-.8 4.8-.9 7.2v1h-2.6c-.7 0-1.3.6-1.3 1.3 0 .7.5 1.2 1.3 1.2h96.2zm-15.2-2.6h-62v-31l.3-.3c2.5-2.3 5.2-4.3 8.1-6.1l.7-.4.5.6c1.7 1.8 3.6 3.5 5.7 4.8l.5.3v10.3c0 8.3 6.8 15.1 15.1 15.1s15.1-6.8 15.1-15.1v-10.3l.5-.3c2.1-1.3 4-3 5.7-4.8l.5-.6.7.4c2.9 1.7 5.7 3.7 8.1 6.1l.3.3v31h.2zm-60-2h58v-28.1c-2.1-1.9-4.3-3.6-6.8-5.1-1.5 1.6-3.2 3-5.1 4.2v9.3c0 9.5-7.7 17.1-17.1 17.1-9.4 0-17.1-7.7-17.1-17.1v-9.3c-1.8-1.2-3.5-2.6-5.1-4.2-2.4 1.5-4.7 3.2-6.8 5.1v28.1zm73.8 2h-11.2v-6.6h10.5l.1.8c.3 1.6.4 3.1.5 4.7l.1 1.1zm-9.2-2h7.1l-.3-2.6h-6.8v2.6zm-69.2 2h-11.2l.1-1.1c.1-1.6.3-3.2.5-4.7l.1-.8h10.5v6.6zm-9.1-2h7.1v-2.6h-6.8c-.1.9-.2 1.8-.3 2.6zm86.3-7.2h-10v-19.2l2.2 2.8.2.3.1.1c3.3 4.5 5.7 9.4 7.2 14.8l.3 1.2zm-8-2h5.3c-1.2-4-3-7.7-5.3-11.2v11.2zm-69.2 2h-10l.3-1.3c1.5-5.3 3.9-10.3 7.2-14.8l.1-.1.2-.3.1-.1 2.1-2.7v19.3zm-7.3-2h5.3v-11.2c-2.3 3.5-4.1 7.2-5.3 11.2zm42.2 2v-3.6c0-.7-.6-1.3-1.3-1.3-.7 0-1.3.6-1.3 1.3v3.6l-1.2-.2c-5.8-1.2-10-6.3-10-12.3v-8.9l1.4.6c3.3 1.4 6.8 2.1 10.4 2.2h1.4c3.6-.1 7.1-.8 10.4-2.2l1.4-.6v8.9c0 5.9-4.2 11.1-10 12.3l-1.2.2zm-11.8-18.4v5.9c0 4.6 3 8.6 7.2 10v-1c0-1.8 1.5-3.3 3.3-3.3 1.8 0 3.3 1.5 3.3 3.3v1c4.2-1.4 7.2-5.4 7.2-10v-5.9c-3.1 1.1-6.4 1.7-9.8 1.8h-1.5c-3.3-.1-6.6-.7-9.7-1.8zm46.1-2.5l-1.7-1.7c-2.8-2.9-6-5.4-9.5-7.5l-.9-.5.6-.9c3.2-4.8 4.9-10.3 4.9-16.1v-16.8l.6-.3c.4-.2.7-.6.8-1 .1-.7-.4-1.4-1.1-1.5l-1.4-.2v-1l-.1 1-3.1-.4-.9-.1v-.9c-.1-3.3-.3-6.3-.8-9.5-.1-.7-.8-1.2-1.5-1.1-.7.1-1.2.8-1.1 1.5.4 2.9.7 5.5.7 8.5v1.1l-1.1.1-3.1-.3-.9-.1v-.9c-.2-4.6-.7-9-1.5-13.1-.1-.7-.8-1.2-1.5-1-.7.1-1.2.8-1 1.5.8 3.8 1.2 7.9 1.4 12.2v1.1l-1.1-.1c-4.1-.2-8.3-.3-12.3-.3-5.9 0-12 .3-18 .8l-1.2.1.1-1.2c.2-1.9.5-3.7.9-5.8.1-.7-.3-1.4-1-1.5-.3-.1-.7 0-1 .2-.3.2-.5.5-.6.8-.5 2.5-.8 4.7-1 7l-.1.8-.8.1-5.1.6-.2-1 .1 1-2.2.3c-.3.1-.6.2-.9.5-.2.3-.3.6-.2 1 .1.6.6 1.1 1.2 1.1h1v16.8c0 5.7 1.7 11.3 4.9 16.1l.6.9-.9.5c-3.5 2.1-6.6 4.6-9.5 7.5l-1.7 1.7v-45.1c0-19.6 16-35.6 35.6-35.6s35.6 16 35.6 35.6v45.1zm-9.3-10.3c2.6 1.6 5 3.5 7.3 5.6v-40.4c0-18.5-15.1-33.6-33.6-33.6s-33.6 15.1-33.6 33.6v40.3c2.2-2.1 4.7-3.9 7.3-5.6-3.1-4.8-4.7-10.5-4.7-16.3v-15c-1.1-.4-2-1.4-2.2-2.6-.1-.9.1-1.7.6-2.5.5-.7 1.3-1.2 2.2-1.3l2.2-.3h.2c1.4-.2 2.9-.4 4.3-.5.2-2.1.5-4.1 1-6.4.2-.9.7-1.6 1.4-2.1s1.6-.7 2.5-.5c.9.2 1.6.7 2.1 1.4s.7 1.6.5 2.5c-.3 1.6-.6 3-.7 4.4 5.6-.5 11.3-.7 16.9-.7 3.7 0 7.5.1 11.3.3-.2-3.8-.7-7.4-1.3-10.8-.4-1.8.8-3.5 2.6-3.9 1.8-.3 3.5.8 3.9 2.6.8 4 1.3 8.2 1.5 12.6l1.2.1c-.1-2.5-.3-4.7-.7-7.2-.3-1.8 1-3.5 2.8-3.8.9-.1 1.7.1 2.5.6.7.5 1.2 1.3 1.3 2.2.5 3 .7 5.8.8 8.8l2.3.3 1.5.2c1.8.3 3.1 1.9 2.8 3.7-.1.9-.6 1.7-1.3 2.2v15.6c-.2 5.9-1.8 11.6-4.9 16.5zm-26.3 10h-1.8c-4-.3-7.9-1.5-11.4-3.5 0 0-.1 0-.1-.1l-.1-.1c-2.6-1.6-5-3.6-6.9-5.9l-.1-.1-.2-.3-.1-.1c-3.7-4.7-5.7-10.3-5.7-16.3v-17.3l.9-.1c8.4-1.1 17-1.6 25.5-1.6s17 .5 25.5 1.6l.9.1v17.3c0 6-2 11.6-5.7 16.3l-.1.1c-.1.1-.2.2-.2.3l-.1.1c-2 2.4-4.3 4.4-6.9 5.9l-.1.1s-.1 0-.1.1c-3.5 2-7.4 3.2-11.4 3.5h-1.8zm1.5-2.1l.2 1-.2-1c3.8-.3 7.4-1.4 10.6-3.2.1 0 .2-.1.2-.1 2.4-1.4 4.5-3.2 6.3-5.4.1-.2.3-.4.4-.5 3.4-4.3 5.2-9.5 5.2-15v-15.6c-16.1-2-32.6-2-48.7 0v15.5c0 5.5 1.8 10.7 5.2 15 .2.2.3.3.4.5 1.8 2.2 3.9 4 6.3 5.4.1 0 .2.1.2.1 3.2 1.9 6.8 3 10.5 3.2h2.5c.5.2.7.2.9.1zM42.2 27.7c-.4 0-.7-.1-1.1-.2-1.7-.6-2.7-2.5-2.1-4.2.6-1.8 2.5-2.7 4.2-2.1 1.7.6 2.7 2.5 2.1 4.2-.4 1.4-1.7 2.3-3.1 2.3zm.1-4.7c-.5 0-1.1.3-1.2.9-.3.8.1 1.5.8 1.7.7.2 1.4-.2 1.7-.8.3-.8-.1-1.5-.8-1.7-.3-.1-.4-.1-.5-.1z" />
        </symbol>
        <symbol id="results-icon" viewBox="0 0 120 120" fill="currentColor">
            <path
                d="M104.3 74.4c-.9 0-1.7-.4-2.3-1-.6-.6-1-1.5-1-2.3 0-.9.4-1.7 1-2.3 1.2-1.2 3.4-1.2 4.7 0 .6.6 1 1.5 1 2.3 0 .9-.4 1.7-1 2.3-.7.7-1.6 1-2.4 1zm0-4.6c-.3 0-.7.1-.9.4-.2.2-.4.6-.4.9 0 .3.1.7.4.9.5.5 1.4.5 1.8 0 .2-.2.4-.6.4-.9 0-.3-.1-.7-.4-.9-.3-.3-.6-.4-.9-.4zM95 120h-70c-6.9 0-12.5-5.6-12.5-12.5v-85.8c0-6.9 5.6-12.5 12.5-12.5h17c1.7-1.2 3.6-1.8 5.7-1.8h2c1.5-4.4 5.6-7.4 10.3-7.4 4.7 0 8.8 3 10.2 7.4h2c2.1 0 4 .6 5.7 1.8h17.1c6.9 0 12.5 5.6 12.5 12.5v37.8c0 1.8-1.5 3.3-3.3 3.3-1.8 0-3.3-1.5-3.3-3.3v-37.8c0-3.3-2.7-5.9-5.9-5.9h-13.1c.1.4.1.8.1 1.3v3.2h5.7c4.4 0 7.9 3.6 7.9 7.9v71.5c0 4.4-3.6 7.9-7.9 7.9h-55.4c-4.4 0-7.9-3.6-7.9-7.9v-71.5c0-4.4 3.6-7.9 7.9-7.9h5.7v-3.2c0-.4 0-.8.1-1.3h-13.1c-3.3 0-5.9 2.7-5.9 5.9v85.8c0 3.3 2.7 5.9 5.9 5.9h70c3.3 0 5.9-2.7 5.9-5.9v-25.7c0-1.8 1.5-3.3 3.3-3.3 1.8 0 3.3 1.5 3.3 3.3v25.7c.1 6.9-5.6 12.5-12.5 12.5zm-70-108.8c-5.8 0-10.5 4.7-10.5 10.5v85.8c0 5.8 4.7 10.5 10.5 10.5h70c5.8 0 10.5-4.7 10.5-10.5v-25.7c0-.7-.6-1.3-1.3-1.3-.7 0-1.2.5-1.2 1.3v25.7c0 4.4-3.6 7.9-7.9 7.9h-70.1c-4.4 0-7.9-3.6-7.9-7.9v-85.8c0-4.4 3.6-7.9 7.9-7.9h15.6l-.3 1.3c-.2.7-.3 1.3-.3 2v5.2h-7.7c-3.3 0-5.9 2.7-5.9 5.9v71.5c0 3.3 2.7 5.9 5.9 5.9h55.3c3.3 0 5.9-2.7 5.9-5.9v-71.5c0-3.3-2.7-5.9-5.9-5.9h-7.6v-5.2c0-.7-.1-1.4-.3-2l-.3-1.3h15.6c4.4 0 7.9 3.6 7.9 7.9v37.8c0 .7.6 1.3 1.3 1.3.7 0 1.3-.6 1.3-1.3v-37.8c0-5.8-4.7-10.5-10.5-10.5h-17.7l-.3-.2c-1.4-1.1-3-1.6-4.7-1.6h-3.5l-.2-.7c-1.1-4-4.6-6.7-8.6-6.7s-7.5 2.7-8.5 6.6l-.2.7h-3.5c-1.8.1-3.5.6-4.8 1.7l-.3.2h-17.7zm62.7 91.8h-55.4c-1.8 0-3.3-1.5-3.3-3.3v-71.5c0-1.8 1.5-3.3 3.3-3.3h55.3c1.8 0 3.3 1.5 3.3 3.3v71.5c.1 1.8-1.4 3.3-3.2 3.3zm-55.4-76.1c-.7 0-1.3.6-1.3 1.3v71.5c0 .7.6 1.3 1.3 1.3h55.3c.7 0 1.3-.6 1.3-1.3v-71.5c0-.7-.6-1.3-1.3-1.3h-55.3zm45.1-4.6h-34.8v-5.2c0-2.8 2.3-5.1 5.1-5.1h4.8c.7 0 1.3-.6 1.3-1.3.1-3.4 2.8-6.1 6.2-6.1 3.4 0 6.1 2.7 6.2 6.1 0 .7.6 1.3 1.3 1.3h4.8c2.8 0 5.1 2.3 5.1 5.1v5.2zm-32.8-2h30.8v-3.2c0-1.7-1.4-3.1-3.1-3.1h-4.8c-1.8 0-3.3-1.5-3.3-3.2 0-2.3-1.9-4.1-4.2-4.1-2.3 0-4.2 1.9-4.2 4.1 0 1.8-1.5 3.2-3.3 3.2h-4.8c-1.7 0-3.1 1.4-3.1 3.1v3.2zM60 39.8c-.9 0-1.7-.4-2.3-1-.6-.6-1-1.5-1-2.3 0-.9.4-1.7 1-2.3 1.2-1.2 3.4-1.2 4.7 0 .6.6 1 1.5 1 2.3 0 .9-.4 1.7-1 2.3-.7.7-1.5 1-2.4 1zm0-4.6c-.3 0-.7.1-.9.4-.2.2-.4.6-.4.9 0 .3.1.7.4.9.5.5 1.4.5 1.8 0 .2-.2.4-.6.4-.9 0-.3-.1-.7-.4-.9-.2-.3-.6-.4-.9-.4zM82.1 57.3h-44.2c-1.8 0-3.3-1.5-3.3-3.3v-17.5c0-1.8 1.5-3.3 3.3-3.3h11.9c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.5 3.3-3.3 3.3h-8.6v10.9h37.6v-10.9h-8.9c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h12.2c1.8 0 3.3 1.5 3.3 3.3v17.5c0 1.8-1.4 3.3-3.3 3.3zm-44.2-22.1c-.7 0-1.3.6-1.3 1.3v17.5c0 .7.6 1.3 1.3 1.3h44.3c.7 0 1.3-.6 1.3-1.3v-17.5c0-.7-.6-1.3-1.3-1.3h-12.3c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h10.9v14.9h-41.6v-14.9h10.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-11.9zM82.1 81.3h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.4 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6zM82.1 68.4h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.4 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6zM82.1 94.2h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.4 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6zM54.5 81.3h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.5 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6zM54.5 68.4h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.5 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6zM54.5 94.2h-16.6c-1.8 0-3.3-1.5-3.3-3.3 0-1.8 1.5-3.3 3.3-3.3h16.6c1.8 0 3.3 1.5 3.3 3.3 0 1.8-1.5 3.3-3.3 3.3zm-16.6-4.6c-.7 0-1.3.6-1.3 1.3 0 .7.6 1.3 1.3 1.3h16.6c.7 0 1.3-.6 1.3-1.3 0-.7-.6-1.3-1.3-1.3h-16.6z" />
        </symbol>
        <symbol id="training-icon" viewBox="0 0 120 120" fill="currentColor">
            <path
                d="M72.6 50.7c-.9 0-1.7-.3-2.3-1-.6-.6-1-1.5-1-2.3 0-.9.3-1.7 1-2.3 1.3-1.3 3.4-1.3 4.7 0 1.3 1.3 1.3 3.4 0 4.7-.7.6-1.5.9-2.4.9zm0-4.6c-.3 0-.7.1-.9.4-.2.2-.4.6-.4.9 0 .3.1.7.4.9.2.2.6.4.9.4.3 0 .7-.1.9-.4.5-.5.5-1.3 0-1.8-.2-.2-.6-.4-.9-.4zM52.6 120c-2.7 0-5.3-1.1-7.2-3l-2.6-2.6c-2.3 2.1-5.3 3.3-8.4 3.3-3.3 0-6.5-1.3-8.9-3.7l-.9-.9-.9.9c-2.4 2.4-5.5 3.7-8.9 3.7-3.3 0-6.5-1.3-8.9-3.7-2.4-2.4-3.7-5.5-3.7-8.9 0-3.3 1.3-6.5 3.7-8.9l.9-.9-.8-.8c-2.4-2.4-3.7-5.5-3.7-8.9 0-3.1 1.2-6.1 3.3-8.4l-2.6-2.6c-1.9-1.9-3-4.5-3-7.2s1.1-5.3 3-7.2c1.9-1.9 4.5-3 7.2-3s5.3 1.1 7.2 3l12.3 12.3 42.8-42.8-12.3-12.3c-1.9-1.9-3-4.5-3-7.2s1.1-5.3 3-7.2c4-4 10.5-4 14.5 0l2.6 2.6c2.3-2.1 5.3-3.3 8.4-3.3 3.3 0 6.5 1.3 8.9 3.7l.9.9.8-.9c2.4-2.4 5.5-3.7 8.9-3.7 3.3 0 6.5 1.3 8.9 3.7 2.4 2.4 3.7 5.5 3.7 8.9 0 3.3-1.3 6.5-3.7 8.9l-.9.9.9.9c2.4 2.4 3.7 5.5 3.7 8.9 0 3.1-1.1 6.1-3.3 8.4l2.6 2.6c1.9 1.9 3 4.5 3 7.2s-1.1 5.3-3 7.2c-1.9 1.9-4.5 3-7.2 3s-5.3-1.1-7.2-3l-12.5-12.4-42.7 42.7 12.3 12.3c1.9 1.9 3 4.5 3 7.2s-1.1 5.3-3 7.2c-1.9 2.1-4.5 3.1-7.2 3.1zm-9.8-8.4l4 4c1.6 1.6 3.6 2.4 5.8 2.4 2.2 0 4.3-.9 5.8-2.4 1.6-1.6 2.4-3.6 2.4-5.8 0-2.2-.9-4.3-2.4-5.8l-13.7-13.8 45.6-45.6 13.7 13.8c1.6 1.6 3.6 2.4 5.8 2.4 2.2 0 4.3-.9 5.8-2.4 1.6-1.6 2.4-3.6 2.4-5.8 0-2.2-.9-4.3-2.4-5.8l-3.8-3.8.5-.7s.1-.1.2-.3c2.1-2.1 3.2-4.7 3.2-7.6 0-2.8-1.1-5.5-3.1-7.4l-2.3-2.3 2.3-2.3c2-2 3.1-4.6 3.1-7.4 0-2.8-1.1-5.5-3.1-7.4-2-2-4.6-3.1-7.4-3.1-2.8 0-5.5 1.1-7.4 3.1l-2.3 2.3-2.3-2.3c-2-2-4.6-3.1-7.4-3.1-2.8 0-5.5 1.1-7.4 3.1l-1 1-4-4c-3.2-3.2-8.4-3.2-11.6 0-1.7 1.4-2.6 3.4-2.6 5.6 0 2.2.9 4.3 2.4 5.8l13.7 13.7-45.5 45.7-13.8-13.8c-1.6-1.6-3.6-2.4-5.8-2.4-2.2 0-4.3.9-5.8 2.4-1.5 1.6-2.4 3.6-2.4 5.8 0 2.2.9 4.3 2.4 5.8l4 4-1 1c-2 2-3.1 4.6-3.1 7.4 0 2.8 1.1 5.5 3.1 7.4l2.3 2.3-2.3 2.3c-2 2-3.1 4.6-3.1 7.4 0 2.8 1.1 5.5 3.1 7.4 2 2 4.6 3.1 7.4 3.1 2.8 0 5.5-1.1 7.4-3.1l2.3-2.3 2.3 2.3c2 2 4.6 3.1 7.4 3.1 2.8 0 5.5-1.1 7.4-3.1l1.2-.8zm9.8 3.8c-1.5 0-2.9-.6-4-1.6l-42.3-42.4c-1.1-1.1-1.6-2.5-1.6-4s.6-2.9 1.6-4c1.1-1.1 2.5-1.6 4-1.6s2.9.6 4 1.6l42.4 42.4c1.1 1.1 1.6 2.5 1.6 4s-.6 2.9-1.6 4c-1.2 1-2.6 1.6-4.1 1.6zm-42.4-51.6c-1 0-1.9.4-2.6 1.1-.7.7-1.1 1.6-1.1 2.6s.4 1.9 1.1 2.5l42.4 42.4c.7.7 1.6 1.1 2.6 1.1s1.9-.4 2.6-1.1c.7-.7 1.1-1.6 1.1-2.6s-.4-1.9-1.1-2.6l-42.4-42.3c-.7-.7-1.6-1.1-2.6-1.1zm24.2 49.3c-2.1 0-4.1-.8-5.6-2.3l-19.6-19.6c-1.5-1.5-2.3-3.5-2.3-5.6 0-2.1.8-4.1 2.3-5.6l1-1 30.8 30.8-1 1c-1.5 1.5-3.5 2.3-5.6 2.3zm-24.2-31.2c-.9 1.1-1.3 2.4-1.3 3.7 0 1.6.6 3.1 1.7 4.2l19.6 19.6c1.1 1.1 2.6 1.7 4.2 1.7 1.4 0 2.7-.5 3.7-1.3l-27.9-27.9zm4.6 31.2c-2.1 0-4.1-.8-5.6-2.3-1.5-1.5-2.3-3.5-2.3-5.6 0-2.1.8-4.1 2.3-5.6l2.3-2.3 11.2 11.2-2.3 2.3c-1.5 1.5-3.4 2.3-5.6 2.3zm-3.2-13l-.9.9c-1.1 1.1-1.7 2.6-1.7 4.2s.6 3.1 1.7 4.2 2.6 1.7 4.2 1.7 3.1-.6 4.2-1.7l.9-.9-8.4-8.4zm31.2-11.7l-11.2-11.2 45.6-45.6 11.2 11.2-45.6 45.6zm-8.3-11.2l8.4 8.4 42.8-42.8-8.4-8.4-42.8 42.8zm75.3-19c-1.5 0-2.9-.6-4-1.6l-42.3-42.4c-1.1-1.1-1.6-2.5-1.6-4s.6-2.9 1.6-4c2.2-2.2 5.7-2.2 7.9 0l42.4 42.4c1.1 1.1 1.6 2.5 1.6 4s-.6 2.9-1.6 4c-1.1 1-2.5 1.6-4 1.6zm-42.4-51.6c-.9 0-1.8.4-2.6 1.1-.7.7-1.1 1.6-1.1 2.6s.4 1.9 1.1 2.6l42.4 42.4c.7.7 1.6 1.1 2.6 1.1s1.9-.4 2.6-1.1c.7-.7 1.1-1.6 1.1-2.6s-.4-1.9-1.1-2.5l-42.4-42.5c-.7-.7-1.6-1.1-2.6-1.1zm42.4 34.4l-30.7-30.8 1-1c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3l19.6 19.6c1.5 1.5 2.3 3.5 2.3 5.6 0 2.1-.8 4.1-2.3 5.6l-1.1 1zm-27.9-30.8l27.9 27.9c.9-1.1 1.3-2.4 1.3-3.7 0-1.6-.6-3.1-1.7-4.2l-19.6-19.6c-1.1-1.1-2.6-1.7-4.2-1.7-1.3 0-2.6.5-3.7 1.3zm26.6 12.6l-11.2-11.2 2.3-2.3c1.5-1.5 3.5-2.3 5.6-2.3 2.1 0 4.1.8 5.6 2.3 1.5 1.5 2.3 3.5 2.3 5.6 0 2.1-.8 4.1-2.3 5.6l-2.3 2.3zm-8.4-11.2l8.4 8.4.9-.9c1.1-1.1 1.7-2.6 1.7-4.2s-.6-3.1-1.7-4.2-2.6-1.7-4.2-1.7-3.1.6-4.2 1.7l-.9.9zM47.4 75.9c-.8 0-1.7-.3-2.3-1-1.3-1.3-1.3-3.4 0-4.7l18.6-18.6c1.3-1.3 3.4-1.3 4.7 0 1.3 1.3 1.3 3.4 0 4.7l-18.6 18.6c-.7.7-1.5 1-2.4 1zm17.8-22.9l-18.7 18.7c-.5.5-.5 1.3 0 1.8s1.3.5 1.8 0l18.7-18.6c.5-.5.5-1.3 0-1.8-.5-.6-1.3-.6-1.8-.1z" />
        </symbol>

        <symbol id="arrow-icon" viewBox="0 0 25 25" fill="currentColor">
            <path
                d="M.856 10.429l8.559-8.58c.381-.382.999-.383 1.381-.002s.383.999.002 1.381l-8.56 8.581c-.381.381-.381 1 .001 1.382l8.559 8.58c.381.382.38 1-.002 1.381-.191.19-.44.285-.69.285-.25 0-.501-.096-.691-.287l-8.558-8.579c-1.142-1.142-1.142-3.001-.001-4.143zM6.298 11.523h17.725c.539 0 .977.437.977.977 0 .539-.437.977-.977.977h-17.725c-.539 0-.977-.437-.977-.977s.437-.977.977-.977z" />
        </symbol>

        <symbol id="tab-icon" viewBox="0 0 7 10" fill="currentColor">
            <path d="M1.672 8.5l3.5-3.5-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
        </symbol>
        <symbol id="star-icon" viewBox="0 0 16 16" fill="currentColor">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M4.527 15.515c-.224.156-.479.234-.734.234h-.004c-.262-.001-.524-.083-.751-.248-.449-.326-.635-.88-.475-1.411l1.184-3.919c.025-.084-.004-.176-.073-.229l-3.174-2.449c-.298-.23-.472-.562-.498-.916-.012-.17.009-.346.068-.518.18-.529.656-.87 1.212-.87h3.962c.094 0 .173-.053.201-.135l1.338-3.932c.18-.529.657-.87 1.215-.87h.001c.558 0 1.035.341 1.215.87l1.338 3.932c.028.082.107.135.201.135h3.961c.556 0 1.032.342 1.213.87.056.166.079.335.069.499l-.003.047c-.033.344-.205.664-.495.888l-3.174 2.449c-.069.053-.099.145-.073.229l1.184 3.919c.161.531-.026 1.085-.475 1.411-.227.165-.489.248-.751.248h-.004c-.255 0-.51-.078-.734-.234l-3.352-2.335-.121-.038-.12.038-3.352 2.335z" />
        </symbol>
        <symbol id="video-play-icon" viewBox="0 0 40 42" fill="currentColor">
            <path
                d="M.966 2.012v37.981c0 .904.959 1.485 1.76 1.066l36.239-18.926c.86-.449.862-1.679.003-2.131l-36.239-19.055c-.801-.421-1.763.16-1.763 1.065z" />
        </symbol>
    </svg>
</section>