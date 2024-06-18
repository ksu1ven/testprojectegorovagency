/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import Swiper, { Pagination, Navigation } from "swiper";

const init = function () {
	const buttonReadMore = document.querySelector(".js-button-readmore");

	if (buttonReadMore)
		buttonReadMore.addEventListener("click", () => {
			const reviewsParagraph = document.querySelector(".js-reviews__p");
			if (buttonReadMore.textContent.includes("Read more")) {
				buttonReadMore.textContent = "Show less";
				document.querySelector(".js-reviews__left-col").style.paddingTop = 0;
			} else {
				buttonReadMore.textContent = "Read more";
				document
					.querySelector(".js-reviews__left-col")
					.removeAttribute("style");
			}

			reviewsParagraph.classList.toggle("reviews__p--visible");
			reviewsParagraph.classList.toggle("reviews__p--hidden");
		});

	new Swiper(".js-reviews-swiper", {
		modules: [Pagination, Navigation],
		slidesPerView: 1,
		initialSlide: 1,
		spaceBetween: 20,
		pagination: {
			el: ".js-reviews-swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".js-reviews-swiper-button-next",
			prevEl: ".js-reviews-swiper-button-prev",
		},
	});
};

initScript(".js-section-reviews", "reviews", init);
