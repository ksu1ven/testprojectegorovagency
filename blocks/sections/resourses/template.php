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

$title = get_field( 'resourses_title'); 
$description = get_field( 'resourses_description' );
$blog_list = get_field('resourses_blog_list' ); 
$background_id = get_field('resourses_background' ); 
$background=wp_get_attachment_image_url($background_id, 'full');
?>

<section class="resourses js-section-resourses">
    <div class='container'>
        <div class='row'>
            <div class="col col-12 col-xl-6 no-gutters">
                <picture class="resourses__left-bg">
                    <img src="<?= esc_url( $background) ?>" alt="Resourses background old lady">
                </picture>


            </div>
            <div class="col col-12 col-xl-6 no-gutters resourses__right-col">
                <?php if ( !empty( $title )) : ?>
                <h2 class="h2 resourses__h2"> <?= esc_html( $title) ?></h2>
                <?php endif ?>
                <?php if ( !empty( $description )) : ?>
                <div class="p p--big resourses__p"><?= esc_html( $description) ?></div>
                <?php endif ?>
                <?php if ( have_rows('resourses_blog_list')) : ?>
                <div class="blog-content">
                    <div class="card-header blog__grid" id="headingTwo">
                        <?php 
                                $sliced_blog = array_slice($blog_list,0, 4);
                                    foreach ($sliced_blog as $index=>$blog) {
                                            $img_id = $blog['image'];
                                            $img =wp_get_attachment_image_url($img_id, 'full');
                                            $title = $blog['title'];
                                            $date = $blog['date'];
                                            $link = $blog['link'];
                                            $url = ($link === '/javascript:void(0)') ? esc_attr('javascript:void(0)') : esc_url($link);
                                    
                                ?>
                        <a href="<?=  $url  ?>" class="blog-item">
                            <img class="blog-item__img" src="<?= esc_url( $img) ?>"
                                alt="blog-photo-<?php echo esc_html(  $index)  ?>">
                            <div class="blog-item__content">
                                <?php if ( !empty( $date )) : ?>
                                <div class="blog-item__p"><?= esc_html( $date) ?></div>
                                <?php endif ?>
                                <?php if ( !empty( $title )) : ?>
                                <h5 class="blog-item__h5"> <?= esc_html( $title) ?></h5>
                                <div class="blog-item__tooltip"> <?= esc_html( $title) ?></div>
                                <?php endif ?>
                            </div>
                        </a>
                        <?php 
                            }
                        ?>
                    </div>
                    <?php 
                        $sliced_blog = array_slice($blog_list, 4);                       
                        if ( isset( $sliced_blog )) : ?>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
                        <div class="card-body blog__grid ">
                            <?php 
                                foreach ($sliced_blog as $index=>$blog) {
                                    $img_id = $blog['image'];
                                    $img =wp_get_attachment_image_url($img_id, 'full');
                                    $title = $blog['title'];
                                    $date = $blog['date'];
                                    $link = $blog['link'];
                                    $url = ($link === '/javascript:void(0)') ? esc_attr('javascript:void(0)') : esc_url($link);
                                    
                                ?>
                            <a href="<?=  $url  ?>" class="blog-item">
                                <img class="blog-item__img" src="<?= esc_url( $img) ?>"
                                    alt="blog-photo-<?php echo esc_html(  $index)  ?>">
                                <div class="blog-item__content">
                                    <?php if ( !empty( $date )) : ?>
                                    <div class="blog-item__p"><?= esc_html( $date) ?></div>
                                    <?php endif ?>
                                    <?php if ( !empty( $title )) : ?>
                                    <h5 class="blog-item__h5" data-tooltip="<?= esc_html( $title) ?>">
                                        <?= esc_html( $title) ?>
                                    </h5>
                                    <div class="blog-item__tooltip"> <?= esc_html( $title) ?></div>
                                    <?php endif ?>
                                </div>
                            </a>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                    <button class="button button--transparent blog__button collapsed js-blog__button"
                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">View All Resources</button>
                    <?php endif ?>
                </div>
                <?php else : ?>
                <div class="p p--small">No resourses :(</div>
                <?php endif ?>
            </div>
        </div>
    </div>

</section>