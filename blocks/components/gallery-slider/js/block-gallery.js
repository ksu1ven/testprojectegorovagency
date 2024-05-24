/**
 * External dependencies
 */
import Swiper, { Navigation, Pagination } from 'swiper'

/**
 * Internal Dependencies
 */
import { initScript } from '../../../../resources/js/utils/init-script'

const init = function(section) {
	const $block = $( section )
	const $slider = $block.find( '.js-content-slider' )
	const $sliderNav = $block.find( '.block-gallery__nav' )
	const $buttonPrev = $sliderNav.find( '.slider-arrow.slider-arrow--prev' )
	const $buttonNext = $sliderNav.find( '.slider-arrow.slider-arrow--next' )
	const $sliderPagination = $sliderNav.find( '.block-gallery__pagination' )

	if ( $slider.find( '.swiper-slide' ).length <= 1 )
		return

	let swiper = new Swiper( $slider[0], {
		modules: [Navigation, Pagination],
		observer: true,
		slidesPerView: 1,
		slidesPerGroup: 1,
		loop: true,
		navigation: {
			nextEl: $buttonNext[0],
			prevEl: $buttonPrev[0],
		},
		pagination: {
			el: $sliderPagination[0],
			type: "fraction",
			formatFractionCurrent: function( currentNum ) {
				return currentNum < 10 ? `0${ currentNum }` : currentNum
			},
			formatFractionTotal: function( totalNum ) {
				return totalNum < 10 ? `0${ totalNum }` : totalNum
			},
			renderFraction: function( currentClass, totalClass ) {
				return `<span class="${ currentClass }"></span>/<span class="${ totalClass }"></span>`
			}
		},
	} )
}

initScript( '.block-gallery', 'bennet-component/gallery-slider', init )
