/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const preloader = document.querySelector(".preloader");

	window.addEventListener("load", () => {
		preloader.classList.add("grow-down");
	});

	if (document.readyState == "complete") {
		preloader.classList.add("grow-down");
	}

	const header = document.querySelector(".js-header");
	const burgerInput = document.querySelector(".js-burger-menu__input");
	const burgerLabel = document.querySelector(".js-burger-menu__label");
	const openBurgerIcon = document.querySelector(".js-menu-icon-open");
	const closeBurgerIcon = document.querySelector(".js-menu-icon-closed");
	if (
		header &&
		burgerInput &&
		burgerLabel &&
		openBurgerIcon &&
		closeBurgerIcon
	) {
		burgerInput.addEventListener("change", () => {
			if (burgerInput.checked) {
				burgerLabel.textContent = "Close";
				openBurgerIcon.classList.add("collapse");
				closeBurgerIcon.classList.remove("collapse");
				header.classList.add("header--colored");
				document.body.classList.add("no-scroll");
			} else {
				burgerLabel.textContent = "Menu";
				openBurgerIcon.classList.remove("collapse");
				closeBurgerIcon.classList.add("collapse");
				header.classList.remove("header--colored");

				document.body.classList.remove("no-scroll");
			}
		});
	}

	function removeActiveColor(navUl, parentClass) {
		const activeLink = document.querySelector(
			`${parentClass} .nav__li--active`
		);
		navUl.addEventListener("mouseover", () => {
			activeLink.style.color = "rgb(255, 255, 255, 0.5)";
		});
		navUl.addEventListener("mouseout", () => {
			activeLink.removeAttribute("style");
		});
	}
	const navUlHeader = document.querySelector(".js-nav__ul--header");
	const navUlHero = document.querySelector(".js-nav__ul--hero");

	if (navUlHero || navUlHeader) {
		removeActiveColor(navUlHeader, ".js-nav__ul--header");
		removeActiveColor(navUlHero, ".js-nav__ul--hero");
	}
};

initScript(".header", "header", init);
