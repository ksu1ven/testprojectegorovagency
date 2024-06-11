/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const heroHeight = document.querySelector(".js-intro").offsetHeight;
	const header = document.querySelector(".js-header");
	window.addEventListener("scroll", () => {
		if (window.scrollY > heroHeight) {
			header.classList.add("header--fixed");
			header.classList.add("header--appear");
		} else if (header.classList.contains("header--fixed")) {
			header.classList.remove("header--appear");
			header.classList.add("header--disappear");
			setTimeout(() => {
				header.classList.remove("header--disappear");
				header.classList.remove("header--fixed");
			}, 300);
		}
	});

	const closeCarouselButton = document.querySelector(".js-carousel-close");
	const overlay = document.querySelector(".js-overlay");
	const carousel = document.querySelector(".js-carousel");
	const galery = [...document.querySelectorAll(".js-galery__item")];

	function closeCarousel() {
		carousel.blur();
		overlay.classList.remove("grow-up");
		carousel.classList.remove("grow-up");
		overlay.classList.add("grow-down");
		carousel.classList.add("grow-down");
		document.body.style.overflow = "auto";
	}

	galery.forEach((picture) => {
		picture.addEventListener("click", () => {
			carousel.focus();
			overlay.classList.remove("grow-down");
			carousel.classList.remove("grow-down");
			overlay.classList.add("grow-up");
			carousel.classList.add("grow-up");
			document.body.style.overflow = "hidden";
		});
	});

	closeCarouselButton.addEventListener("click", closeCarousel);
	overlay.addEventListener("click", closeCarousel);

	const gap = 30;
	let currentTransform = 0;
	let currentActiveButton = 1;

	const carouselPictures = document.querySelector(".js-carousel__pictures");
	let pictureWidth = parseInt(
		window
			.getComputedStyle(document.querySelector(".js-carousel__img"))
			.getPropertyValue("width")
	);
	let carouselPicturesWidth = parseInt(
		window.getComputedStyle(carouselPictures).getPropertyValue("width")
	);
	const controlsRounds = document.querySelector(".js-controls__rounds");

	const prev = document.querySelector(".js-prev");
	const next = document.querySelector(".js-next");

	function changeActiveButton(number) {
		[...controlsRounds.children].forEach((el) => {
			el.classList.remove("controls__round--active");
			el.disabled = false;
			if (+el.dataset.number === number) {
				el.classList.add("controls__round--active");
				el.disabled = true;
			}
		});
	}

	function checkForButtonsDisabled() {
		next.disabled =
			carouselPicturesWidth - Math.abs(currentTransform) >= pictureWidth &&
			currentActiveButton === 5;
		prev.disabled = currentTransform >= 0 && currentActiveButton === 1;
	}

	function nextSlide() {
		if (carouselPicturesWidth - Math.abs(currentTransform) > pictureWidth) {
			currentTransform -= pictureWidth + gap;
			if (currentActiveButton < 5) {
				currentActiveButton += 1;
				changeActiveButton(currentActiveButton);
			}
			checkForButtonsDisabled();
			carouselPictures.style.transform = `translateX(${currentTransform}px)`;
			carousel.focus();
		}
	}

	function prevSlide() {
		if (Math.abs(currentTransform) > 0) {
			currentTransform += pictureWidth + gap;
			if (currentActiveButton > 1) {
				currentActiveButton -= 1;
				changeActiveButton(currentActiveButton);
			}
			checkForButtonsDisabled();
			carouselPictures.style.transform = `translateX(${currentTransform}px)`;
			carousel.focus();
		}
	}

	next.addEventListener("click", nextSlide);

	prev.addEventListener("click", prevSlide);

	carousel.addEventListener("keydown", (e) => {
		if (e.key === "ArrowLeft" && !prev.disabled) prevSlide();
		else if (e.key === "ArrowRight" && !next.disabled) nextSlide();
	});

	controlsRounds.addEventListener("click", (e) => {
		if (e.target.classList.contains("js-controls__round")) {
			currentActiveButton = +e.target.dataset.number;
			changeActiveButton(currentActiveButton);
			currentTransform = -(currentActiveButton - 1) * (pictureWidth + gap);
			checkForButtonsDisabled();
			carouselPictures.style.transform = `translateX(${currentTransform}px)`;
		}
	});

	window.addEventListener("resize", () => {
		pictureWidth = parseInt(
			window
				.getComputedStyle(document.querySelector(".js-carousel__img"))
				.getPropertyValue("width")
		);
		carouselPicturesWidth = parseInt(
			window.getComputedStyle(carouselPictures).getPropertyValue("width")
		);
		currentTransform = -(currentActiveButton - 1) * (pictureWidth + gap);
		carouselPictures.style.transform = `translateX(${currentTransform}px)`;
		carousel.focus();
	});

	const navs = document.querySelector(".js-offer-nav");
	const navTabs = document.querySelector(".js-offer__nav-tabs-wrapper");

	navs.addEventListener("wheel", (e) => {
		e.preventDefault();
		navTabs.scrollLeft += e.deltaY;
	});
};

initScript(".section-hero", "hero", init);
