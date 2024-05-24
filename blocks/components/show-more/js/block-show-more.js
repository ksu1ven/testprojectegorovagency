/**
 * Internal Dependencies
 */
import showMore from '../../../../resources/js/modules/show-more'

(function ($) {
	const initializeBlockFront = function () {
		$( '.js-show-more' ).each( function() {
			const $showMore = $( this )
			const $content = $showMore.find( '.js-show-more-hidden' )
			const $button = $showMore.find( '.js-show-more-button' )

			$content.addClass( 'hidden' )
			$button.text('Show More')

			showMore( $showMore );
		} )
	};

	const initializeBlockAdmin = function() {}

	window.acf.addAction("ready", function () {
		const siteEditor = window.acf.isGutenberg();

		if (!siteEditor) {
			initializeBlockFront();
		} else {
			setTimeout( initializeBlockAdmin, 20000 );
		}
	});
})(jQuery);
