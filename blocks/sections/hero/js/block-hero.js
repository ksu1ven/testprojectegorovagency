/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const heroHeight = document.querySelector(".js-section-hero").offsetHeight;
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

	const video = document.querySelector(".js-hero__backround-video");
	const videoButton = document.querySelector(".js-play-video-button span");

	videoButton.addEventListener("click", () => {
		if (videoButton.textContent === "Play Video") {
			video.play();
			videoButton.textContent = "Stop Video";
		} else if (videoButton.textContent === "Stop Video") {
			video.pause();
			videoButton.textContent = "Play Video";
		}
	});
};

initScript(".js-section-hero", "hero", init);
