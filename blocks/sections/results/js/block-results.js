/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import Swiper, { Pagination, Navigation } from "swiper";
import $ from "jquery";
import "../../../../resources/js/modules/jquery.event.move.js";
import "../../../../resources/js/modules/jquery.twentytwenty.js";

const init = function () {
	$(function () {
		$(".twentytwenty-container").twentytwenty();
	});

	let swiperText = new Swiper(".js-text-swiper", {
		modules: [Pagination, Navigation],
		slidesPerView: 1,
		initialSlide: 1,
		pagination: {
			el: ".js-swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".js-swiper-button-next",
			prevEl: ".js-swiper-button-prev",
		},
	});

	new Swiper(".js-results-swiper", {
		modules: [Pagination, Navigation],
		allowTouchMove: false,
		slidesPerView: 1,
		initialSlide: 1,
		pagination: {
			el: ".js-swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".js-swiper-button-next",
			prevEl: ".js-swiper-button-prev",
		},
		thumbs: {
			swiper: swiperText,
		},
	});
};

initScript(".js-section-results", "results", init);
