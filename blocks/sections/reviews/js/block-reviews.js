/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import Swiper, { Pagination, Navigation } from "swiper";

const init = function () {
	const buttonReadMore = document.querySelector(".js-button-readmore");

	if (buttonReadMore)
		buttonReadMore.addEventListener("click", () => {
			if (buttonReadMore.textContent.includes("Read more")) {
				buttonReadMore.textContent = "Show less";
			} else {
				buttonReadMore.textContent = "Read more";
			}
		});

	new Swiper(".js-reviews-swiper", {
		modules: [Pagination, Navigation],
		slidesPerView: 1,
		initialSlide: 0,
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

	let reviews = document.querySelectorAll(".js-review");
	if (reviews)
		reviews.forEach((el) => {
			if (el.scrollHeight <= el.clientHeight) {
				el.classList.add("border-left");
			}
		});
};

initScript(".js-section-reviews", "reviews", init);
