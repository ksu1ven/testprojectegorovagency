/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const buttonLoadMore = document.querySelector(".js-blog__button");

	if (buttonLoadMore)
		buttonLoadMore.addEventListener("click", () => {
			if (buttonLoadMore.textContent.includes("View All Resources")) {
				buttonLoadMore.textContent = "View Less Resourses";
			} else {
				buttonLoadMore.textContent = "View All Resources";
			}
		});
};

initScript(".js-section-resourses", "resourses", init);
