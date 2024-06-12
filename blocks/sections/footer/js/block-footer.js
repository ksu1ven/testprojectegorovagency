/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import $ from "jquery";
import "../../../../resources/js/modules/jquery.event.move.js";
import "../../../../resources/js/modules/jquery.twentytwenty.js";

const init = function () {
	$(function () {
		$(".twentytwenty-container").twentytwenty();
	});

	$(window).on("resize", function () {
		$(".twentytwenty-container").twentytwenty();
	});
};

initScript(".footer", "footer", init);
