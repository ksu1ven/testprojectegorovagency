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

$title = get_field( 'offer_title' );
$subtitle = get_field( 'offer_subtitle' );
$description = get_field( 'offer_description' );
$tabs = get_field( 'tabs_list' );
?>

<section class="offer js-section-offer">
    <div class="container">
        <div class="row offer__row no-gutters">
            <div class="col col-12 col-xl-6 offer__left-col">
                <div class="offer__left-content">
                    <?php if ( !empty( $subtitle )) : ?>
                    <h5 class="offer__h5"><?= esc_html( $subtitle) ?></h5>
                    <?php endif ?>

                    <?php if ( !empty( $title )) : ?>
                    <h2 class="h2 offer__h2"><?= esc_html( $title) ?></h2>
                    <?php endif ?>

                    <?php if ( !empty( $description )) : ?>
                    <div class="p p--small">
                        <?= esc_html( $description) ?>
                    </div>

                    <?php endif ?>


                </div>
            </div>
            <div class="col col-12 col-xl-6 offer__right-col">
                <div class="offer__right-content">
                    <nav class="offer__nav js-offer-nav">
                        <div class="offer__nav-tabs-wrapper js-offer__nav-tabs-wrapper">
                            <div class="nav nav-tabs offer__nav-tabs" id="nav-tab" role="tablist">

                                <?php if (have_rows('tabs_list')) : ?>



                                <?php
							foreach ($tabs as $index=>$tab) {
								$tab_item = $tab['tab_item'];

								?>
                                <a class="nav-item nav-link <?php if ($index == '0'){ ?>active<?php   } ?> offer__nav-link"
                                    id="nav-<?php echo esc_html($tab_item); ?>-tab" data-toggle="tab"
                                    href="#nav-<?php echo esc_html($tab_item); ?>" role="tab"
                                    aria-controls="nav-<?php echo esc_html($tab_item); ?>"
                                    aria-selected="true"><?php echo esc_html($tab_item); ?></a>
                                <?php
					}
					?>
                            </div>
                        </div>
                    </nav>



                    <div class="tab-content offer__tab-content" id="nav-tabContent">
                        <?php
							foreach ($tabs as $index=>$tab) {
								$tab_item = $tab['tab_item'];
								?>


                        <div class="tab-pane fade show <?php if ($index == '0'){ ?>active<?php   } ?> offer__tab-pane"
                            id="nav-<?php echo esc_html($tab_item); ?>" role="tabpanel"
                            aria-labelledby="nav-<?php echo esc_html($tab_item); ?>-tab">
                            <div class="tab-info">

                                <?php
							$tab_blocks = $tab['tab_blocks'];
							foreach ($tab_blocks as $index=>$block) {
								$link= $block['link'];
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $url = ($link_url === '/javascript:void(0)') ? esc_attr('javascript:void(0)') : esc_url($link);
							?>
                                <a class="tab-info__block" href="<?=  $url  ?>">
                                    <svg class="tab__svg" role="img" aria-hidden="true" width="7" height="10">
                                        <use xlink:href="#tab-icon"></use>
                                    </svg>
                                    <span class="tab-info__name"><?php echo esc_html($link_title); ?></span>
                                </a>
                                <?php
						}
						?>

                            </div>
                        </div>


                        <?php
					}
					?>
                    </div>

                    <?php else : ?>
                    <div class="p p--small">No tabs :(</div>
                    <?php endif ?>
                </div>
            </div>
        </div>
</section>