/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";

const init = function () {
	const errorFields = [...document.querySelectorAll(".nf-after-form-content")];
	const successFields = [...document.querySelectorAll(".nf-response-msg")];
	const submitResult = document.querySelector(".js-send-form-result__h2");
	const submitMessage = document.querySelector(".js-send-form-result__p");
	const errorIcon = document.querySelector("#error-icon");
	const successIcons = [
		...document.querySelectorAll(".js-send-form-result__svg"),
	];

	document.addEventListener(
		"nfFormReady",
		function (event) {
			console.log("Форма готова:", event.detail);
		},
		false
	);

	document.addEventListener(
		"nfBeforeFormSubmit",
		function (event) {
			console.log("Перед отправкой формы:", event.detail);
		},
		false
	);

	document.addEventListener(
		"nfFormSubmit",
		function (event) {
			console.log("Форма отправляется:", event.detail);
		},
		false
	);

	document.addEventListener(
		"nfFormSubmitResponse",
		function (event) {
			if (event.detail.result === "success") {
				console.log("Форма успешно отправлена!", event.detail);
			} else {
				console.log("Ошибка при отправке формы:", event.detail);
			}
		},
		false
	);

	document.addEventListener(
		"nfFormSubmitError",
		function (event) {
			console.log("Ошибка отправки формы:", event.detail);
		},
		false
	);

	function checkResultMessage(mutationsList) {
		for (let mutation of mutationsList) {
			if (mutation.target.tagName === "NF-ERRORS") {
				let realTarget = mutation.target.querySelector(".nf-error-msg");
				if (realTarget) submitMessage.textContent = realTarget.textContent;

				if (
					realTarget &&
					submitMessage.textContent.toLowerCase().includes("error")
				) {
					submitResult.textContent = "Error";
					submitResult.classList.add("send-form-result__h2--error");
					mutation.target.style.display = "none";
					mutation.target.textContent = "";
					successIcons.forEach((icon) => (icon.style.display = "none"));
					errorIcon.style.display = "block";
					// const submitButton = document.querySelector(
					// 	".js-subscription__submit"
					// );
					// submitButton.textContent = "Submit";
					if (submitMessage.textContent) {
						if ($("#book-consultation").is(":visible"))
							$("#book-consultation").modal("hide");
						$("#send-form-result").modal("show");
					}
				}
			} else if (mutation.target.classList.contains("nf-response-msg")) {
				submitResult.textContent = "Success";
				submitResult.classList.remove("send-form-result__h2--error");
				submitMessage.textContent = mutation.target.textContent;
				successIcons.forEach((icon) => icon.removeAttribute("style"));
				errorIcon.style.display = "none";

				if (submitMessage.textContent) {
					if ($("#book-consultation").is(":visible"))
						$("#book-consultation").modal("hide");

					$("#send-form-result").modal("show");
				}
			}
		}
	}
	const observer = new MutationObserver(checkResultMessage);

	successFields.forEach((successField) => {
		observer.observe(successField, {
			childList: true,
			subtree: true,
		});
	});

	errorFields.forEach((errorField) => {
		observer.observe(errorField, {
			childList: true,
			subtree: true,
		});
	});
};

initScript(".footer", "footer", init);
