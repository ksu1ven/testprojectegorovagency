import Swiper, { Pagination, Navigation } from "swiper";

export default function safetyPriorityPopupInit () {
	const $modalsSafetyPriority = $('.modal-safety-priority');
	
	$modalsSafetyPriority.each(function () {
		const $modal = $(this);
		const $sliderContainers = $modal.find('.modal-safety-priority__slider-container');
		
		$sliderContainers.each(function () {
			const $container = $(this);
			const $slider = $container.find('.js-safety-priority-slider');
			const $sliderNav = $container.find('.safety-priority-slider__nav');
			const $buttonPrev = $sliderNav.find('.safety-priority-slider__arrow.slider-arrow--prev');
			const $buttonNext = $sliderNav.find('.safety-priority-slider__arrow.slider-arrow--next');
			const $pagination = $sliderNav.find('.safety-priority-slider__pagination');

			let swiper = new Swiper($slider[0], {
				modules: [Navigation, Pagination],
				slidesPerView: 1,
				navigation: {
					nextEl: $buttonNext[0],
					prevEl: $buttonPrev[0],
				},
				pagination: {
					el: $pagination[0],
					type: 'custom',
					renderCustom: function (swiper, current, total) {
						let currentFormating = current > 9 ? current : '0' + current;
						let totalFormating = total > 9 ? total : '0' + total;
						return '<span class="swiper-pagination-current">'+ currentFormating + '</span>/<span class="swiper-pagination-total">' + totalFormating + '</span>';
					},
				},
			})
		})

	})
}

