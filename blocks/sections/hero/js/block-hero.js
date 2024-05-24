/**
 * Internal Dependencies
 */
import { initScript } from '../../../../resources/js/utils/init-script'


const init = function() {
	const $section = $( this )
	const $scrollButton = $section.find( '.js-scroll-to-next-section' )
	const $pageWrapper = $( '.wp-site-blocks' )
	const $header = $( '.header' )

	// Scroll Down Event
	const scrollAction = event => {
		const headerHeight = $header.innerHeight()
		const sectionHeight = $section.innerHeight()
		const scrollTop = headerHeight + sectionHeight

		$pageWrapper.animate( { scrollTop }, 1000 )
	}

	$scrollButton.on( 'click', scrollAction )
}


initScript( '.section-hero', 'hero', init )
