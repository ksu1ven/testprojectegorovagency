export default function horizontalScroll (parentElement) {
	if (!$.fn.hScroll) {
		// horizontal scroll
		$.fn.hScroll = function (amount) {
			const $target = $(this);
			amount = amount || 120;

			function horizontalScroll (event) {
				event.preventDefault();

				const originalEvent = event.originalEvent;
				const direction = originalEvent.detail ? originalEvent.detail * -amount : originalEvent.wheelDelta;
				let position = $target.scrollLeft();

				position += direction > 0 ? -amount : amount;

				$target.scrollLeft(position);
			}

			$target.off("DOMMouseScroll mousewheel");

			if($target[0].scrollWidth > $target[0].clientWidth) {
				$target.on("DOMMouseScroll mousewheel", horizontalScroll);
			}
		};
	}

	if (parentElement) {
		$(parentElement).find('.js-horizontal-scroll').each(function () {
			$(this).hScroll(60);
		});
	}
}