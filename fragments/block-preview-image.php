<?php
/**
 * Preview Image for Block
 *
 * @var $params
 */

$data = $params['block']['data'];
?>

<div class="block-preview-image-wrap" style="margin: -35px 0 0; display: flex; align-items: center; justify-content: center;">
    <img src="<?= esc_url( get_theme_file_uri( '/dist/images/previews/' . $data['block_preview_images'] ) ) ?>" style="width: 100%; height: auto; display: block; margin: auto;" alt="">
</div>
