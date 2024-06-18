<?php
/**
 * Block Footer.
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
$block] ); return; } 


$nav_list = get_field( 'nav' );
$address_top = get_field( 'address_top' );
$address_bottom = get_field( 'address_bottom' );
$map_url=get_field( 'map_url' );
$phone=get_field( 'phone' );
$phone_link=$phone['url'];
$phone_title=$phone['title'];
$photo_list=get_field( 'footer_photo_list' );
?>

<footer class="footer">
    <div class="container">
        <div class="row footer__content">
            <nav class="col col-12 col-md-6 col-xl-4 nav--extra-small footer__nav">
                <h3 class="h3 footer__h3">Navigation</h3>
                <?php if (have_rows('nav')) : ?>
                <ul class="nav__ul nav__ul--extra-small js-nav__ul--hero">
                    <?php 
					foreach ($nav_list as $nav_item) {
						$item=$nav_item['item'];
                        $link_url = $item['url'];
                        $link_title = $item['title'];
                        $url = ($link_url === '/javascript:void(0)') ? esc_attr('javascript:void(0)') : esc_url($link);	
							?>
                    <li class="nav__li nav__li--extra-small">
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
            <div class="col col-12 col-md-6 col-xl-4 footer__center-col">
                <div class="contacts footer__contacts">
                    <h3 class="h3 footer__h3">Contact</h3>
                    <div class="contacts__phone-geo">
                        <a class="contacts__link contacts__link--with-text contacts__link--geo contacts__link--dark"
                            href=" <?php echo esc_url(  $map_url )  ?>" target="_blank"><svg role="img"
                                aria-hidden="true" width="24" height="24">
                                <use xlink:href="#location-icon"></use>
                            </svg>
                            <span><?php echo esc_html(  $address_top )  ?>
                                <span></br><?php echo esc_html(  $address_bottom )  ?></span>
                            </span></a>
                        <a class="contacts__link contacts__link--with-text contacts__link--dark"
                            href="<?php echo esc_url(  $phone_link )  ?>"><svg role="img" aria-hidden="true" width="24"
                                height="24">
                                <use xlink:href="#phone-icon"></use>
                            </svg><span><?php echo esc_html(  $phone_title )  ?></span></a>
                    </div>
                    <div class="contacts__media">
                        <a class="contacts__link" href="javascript:void(0)" target="_blank">
                            <svg role="img" aria-hidden="true" width="34" height="34">
                                <use xlink:href="#inst-icon"></use>
                            </svg>
                        </a>
                        <a class="contacts__link" href="javascript:void(0)" target="_blank">
                            <svg role="img" aria-hidden="true" width="34" height="34">
                                <use xlink:href="#twitter-icon"></use>
                            </svg>
                        </a>
                        <a class="contacts__link" href="javascript:void(0)" target="_blank">
                            <svg role="img" aria-hidden="true" width="34" height="34">
                                <use xlink:href="#facebook-icon"></use>
                            </svg>
                        </a>
                        <a class="contacts__link" href="javascript:void(0)" target="_blank">
                            <svg role="img" aria-hidden="true" width="34" height="28">
                                <use xlink:href="#youtube-icon"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-md-12 col-xl-4">
                <?php if (have_rows('footer_photo_list')) : ?>
                <div class="photo-4">
                    <?php 					
                        foreach ($photo_list as $index=>$photo) {
                            $img_id = $photo['image'];
                                $img =wp_get_attachment_image_url($img_id, 'full');
                            ?>
                    <img src="<?= esc_url( $img) ?>" alt="foter-photo-<?php echo esc_html(  $index)  ?>" />
                    <?php 
                    }
					?>
                </div>
                <?php endif ?>
            </div>
        </div>
        <hr class="footer__hr" />
        <div class="row footer__copyright align-items-center">
            <div class="col col-12 col-md-6 footer__year">
                <span>© 2021 The Happy Fitness</span>
            </div>
            <div class="col col-12 col-md-6 footer__designed-by">
                <span>Designed & Marketed by</span>
                <a class="footer__designed-by-link" href="javascript:void(0)" target="_blank"><svg width="95"
                        height="28" viewBox="0 0 95 28" xmlns="http://www.w3.org/2000/svg"
                        aria-label="Harbinger Marketing" role="img" fill="currentColor">
                        <g clip-path="url(#a)">
                            <path
                                d="M63.533 16.661v-1.214c0-.107-.088-.196-.194-.196h-.335c-.247 0-.458-.214-.458-.5v-3.482c0-2.464-1.093-4.232-3.543-4.232-1.252 0-2.591.643-2.944 1.625v-1.607c0-.161-.159-.286-.3-.214-.264.143-2.873.143-3.05.214l-.053.089v1.429c0 .071.07.107.141.107 0 0 .846.018.846.625v5.464c0 .268-.212.5-.458.5h-1.534c-.247 0-.458-.214-.458-.5v-7.714c0-.161-.159-.304-.3-.232-.317.143-2.873.161-3.05.232l-.053.089v1.429c0 .071.053.107.141.107 0 0 .846 0 .846.607v5.482c0 .268-.212.5-.458.5h-.335c-.106 0-.194.089-.194.196v1.214c0 .107.088.196.194.196h8.885c.106 0 .194-.089.194-.196v-1.214c0-.107-.088-.196-.194-.196h-.335c-.247 0-.458-.214-.458-.5 0 0 .018-2.018.018-2.857 0-1.232.247-3.232 2.045-3.232 1.781 0 2.045 2 2.045 3.232 0 .429-.018 2.857-.018 2.857 0 .268-.212.5-.458.5h-.335c-.106 0-.194.089-.194.196v1.214c0 .107.088.196.194.196h4.037c.035 0 .123-.089.123-.214zM42.591 7.054c-1.657 0-2.785 1.625-2.785 1.625v-6.893c0-.161-.141-.161-.3-.143-.758.143-2.873.179-3.05.25l-.053.089v1.411c0 .071.07.107.141.107 0 0 .846 0 .846.607v10.625c0 .268-.212.5-.458.5h-.335c-.106 0-.194.089-.194.196v1.214c0 .107.088.196.194.196h2.926c.159 0 .282-.143.282-.304v-.518c.74.696 1.692.821 2.732.821 2.38 0 4.407-1.839 4.407-4.929 0-3.089-1.71-4.857-4.354-4.857zm-.864 8.196c-1.022 0-1.922-.607-1.922-1.429v-2.161c0-1.75.917-3 2.01-3 1.481 0 2.08 1.536 2.08 3.518 0 1.518-.705 3.071-2.168 3.071zM14.984 0h-4.566c-.106 0-.212.107-.212.232v1.161c0 .125.088.232.212.232h.264c.282 0 .511.25.511.554v4.875h-7.21v-4.875c0-.304.229-.554.511-.554h.264c.106 0 .212-.107.212-.232v-1.161c0-.125-.088-.232-.212-.232h-4.548c-.106 0-.212.107-.212.232v1.161c0 .125.088.214.212.214h.282c.282 0 .511.25.511.554v12.536c0 .304-.229.554-.511.554h-.282c-.106 0-.212.107-.212.232v1.179c0 .125.088.232.212.232h4.548c.106 0 .212-.107.212-.232v-1.179c0-.125-.088-.232-.212-.232h-.264c-.282 0-.511-.25-.511-.554v-6.036h7.21v6.036c0 .304-.229.554-.511.554h-.264c-.106 0-.212.107-.212.232v1.179c0 .125.088.232.212.232h4.566c.106 0 .212-.107.212-.232v-1.179c0-.125-.088-.232-.212-.232h-.282c-.282 0-.511-.25-.511-.554v-12.536c0-.304.229-.554.511-.554h.282c.106 0 .212-.107.212-.232v-1.161c0-.107-.106-.214-.212-.214zM26.46 15.25h-.529c-.229 0-.3-.178-.3-.357v-7.643c0-.179-.018-.214-.194-.214-.511 0-1.481-.071-1.921-.214-.141-.054-.3.054-.3.214v1.607c-.247-.554-1.199-1.625-2.503-1.625-2.521 0-4.707 2.339-4.707 5.446 0 3.107 1.904 4.375 4.46 4.375 1.622 0 2.75-.839 2.75-.839s.088.839.917.839h2.327c.088 0 .159-.071.159-.161v-1.304c0-.053-.07-.125-.159-.125zm-5.412 0c-1.287 0-1.974-1.482-1.974-3.071 0-1.732.899-3.518 2.08-3.518 1.252 0 2.08.839 2.08 3.286-.018 1.25-.317 3.303-2.186 3.303zM80.845 6.821c-2.821 0-5.112 2.232-5.112 5.018 0 2.786 2.098 5.036 5.112 5.036 1.622 0 3.032-.768 3.896-1.804.07-.071.053-.196 0-.268 0 0-1.357-.839-1.375-.839-.071-.053-.159-.018-.212.036-.212.303-.899 1.268-2.309 1.25-2.045 0-2.027-2.464-2.027-2.464h6.893c.123 0 .229-.089.229-.232-.018-3.929-2.926-5.732-5.095-5.732zm-2.045 4.304s0-2.464 2.027-2.464 2.045 2.464 2.045 2.464h-4.072zM50.377 5.156c.98-.549 1.372-1.729.877-2.635-.495-.906-1.691-1.195-2.67-.646-.98.549-1.372 1.729-.877 2.635.495.906 1.691 1.195 2.67.646zM34.851 7.089l-.07-.018c-.864-.161-2.345.375-3.508 1.589v-1.607c0-.161-.159-.286-.3-.214-.264.143-2.873.143-3.05.214l-.053.089v1.411c0 .071.053.107.141.107 0 0 .846 0 .846.607v5.482c0 .268-.211.5-.458.5h-.335c-.106 0-.194.089-.194.197v1.214c0 .107.088.197.194.197h4.019c.106 0 .194-.089.194-.197v-1.214c0-.107-.088-.197-.194-.197h-.335c-.247 0-.458-.214-.458-.5v-3.643c0-1.804 1.252-2.446 1.551-2.446 0 1.054.74 1.75 1.675 1.75.917 0 1.675-.75 1.675-1.696-.035-.786-.582-1.446-1.34-1.625zM72.806 7.536c.212-.161.67-.339.952.071.282.411.67.643 1.146.643.758 0 1.357-.625 1.357-1.375 0-.536-.37-1.464-1.798-1.464-1.675 0-3.173 2.143-3.279 2.107-.67-.304-1.41-.446-2.204-.446-2.82 0-5.112 2.179-5.112 4.893 0 1.714.917 3.214 2.292 4.089-.494.196-.864.75-.864 1.339s.546 1.125 1.886 1.429c4.037.893 5.359 2.643 5.359 4.393 0 2.339-1.375 3.161-3.42 3.161s-3.42-1.071-3.42-3.161c0-2.429 1.498-2.732 1.216-3.018-.282-.304-4.389-.125-4.389 3.018 0 2.929 2.926 4.786 6.593 4.786 3.42 0 6.593-1.411 6.593-4.786 0-4.232-7.087-5.232-7.95-5.482-.67-.197-.458-1.125.088-.982.353.107.723.107 1.111.107 2.821 0 5.112-2.196 5.112-4.929 0-1.304-.547-2.518-1.41-3.393-.37-.411-.07-.839.141-1zm-3.808 7.714c-1.216 0-2.045-1.125-2.045-3.25s.828-3.339 2.045-3.339c1.216 0 2.045 1.214 2.045 3.339s-.829 3.25-2.045 3.25zM93.696 7.089l-.071-.018c-.864-.161-2.345.375-3.508 1.589v-1.607c0-.161-.159-.286-.3-.214-.264.143-2.873.143-3.05.214l-.053.089v1.411c0 .071.053.107.141.107 0 0 .846 0 .846.607v5.482c0 .268-.212.5-.458.5h-.335c-.106 0-.194.089-.194.197v1.214c0 .107.088.197.194.197h4.019c.106 0 .194-.089.194-.197v-1.214c0-.107-.088-.197-.194-.197h-.335c-.247 0-.458-.214-.458-.5v-3.643c0-1.804 1.252-2.446 1.551-2.446 0 1.054.74 1.75 1.675 1.75.917 0 1.675-.75 1.675-1.696-.035-.786-.599-1.446-1.34-1.625zM31.044 21.375c0-.768-.546-1.304-1.34-1.304h-1.851v3.75h.899v-1.161h.546c.3.411.582.786.881 1.161h1.058c-.3-.393-.635-.857-.952-1.25.458-.214.758-.661.758-1.196zm-1.428.571h-.846v-1.179h.846c.476 0 .546.411.546.607-.018.393-.3.571-.546.571zM36.297 20.071h-1.181l-1.446 1.554v-1.554h-.934v3.75h.934v-.857l.494-.553 1.023 1.411h1.111l-1.516-2.071 1.516-1.679zM37.989 23.821h2.944v-.768h-2.01v-.696h1.78v-.786h-1.78v-.732h2.01v-.768h-2.944v3.75zM42.608 20.839h1.252v2.982h.934v-2.982h1.252v-.768h-3.438v.768zM48.673 20.071h-.934v3.75h.934v-3.75zM53.01 22.25l-1.798-2.179h-.864v3.75h.899v-2.143l1.763 2.143h.899v-3.75h-.899v2.179zM19.092 20.071l-1.111 1.464-1.093-1.464h-.934v3.75h.934v-2.286l1.093 1.446 1.111-1.446v2.286h.934v-3.75h-.934zM24.204 20.071h-.529l-1.974 3.75h1.005l.317-.643h1.833l.335.643h.987l-1.974-3.75zm-.793 2.321l.529-1.107.529 1.107h-1.058zM59.373 21.661h-1.886v.821h.899c-.141.286-.511.482-.864.482-.547 0-1.023-.464-1.023-1.036 0-.554.476-1.018 1.023-1.018.264 0 .547.143.758.375.141-.089.494-.304.776-.464-.37-.482-.934-.768-1.534-.768-1.058 0-1.922.839-1.922 1.875s.864 1.875 1.922 1.875c.987 0 1.78-.679 1.869-1.589v-.215l-.018-.286v-.053z" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path d="M0 0h95v28h-95z" />
                            </clipPath>
                        </defs>
                    </svg></a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



</footer>

<?php
\Harbinger_Marketing\Modal_Action::render_modals();