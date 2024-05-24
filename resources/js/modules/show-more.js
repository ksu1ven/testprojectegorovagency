// As parametr accepts selector of parent block,
// selector hidden part (default = '.hidden'),
// selector for button (default '.js-show-more-button')
export default function showMore ($parentElem, hiddenContentSelector = '.js-show-more-hidden', showMoreButtonSelector = '.js-show-more-button') {
	const $hiddenContent = $parentElem.find(hiddenContentSelector),
		$showMoreButton = $parentElem.find(showMoreButtonSelector);

	if(!$parentElem.length || !$hiddenContent.length || !$showMoreButton.length)
		return

	$showMoreButton.off('click').on('click', function() {
		if($showMoreButton.hasClass('opened'))  {
			$hiddenContent.slideUp('300', function () {
				$showMoreButton.text('Show More')
			})
			$showMoreButton.removeClass('opened')
		} else {
			$hiddenContent.slideDown('300', function() {
				$showMoreButton.text('Hide')
			})
			$showMoreButton.addClass('opened')
		}
	})
}
