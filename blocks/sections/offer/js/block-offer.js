/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const navs = document.querySelector(".js-offer-nav");
	const navTabs = document.querySelector(".js-offer__nav-tabs-wrapper");

	navs.addEventListener("wheel", (e) => {
		e.preventDefault();
		navTabs.scrollLeft += e.deltaY;
	});
};

initScript(".js-section-offer", "offer", init);
