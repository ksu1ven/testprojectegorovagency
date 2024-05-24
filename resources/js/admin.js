var app = app || {};
var $ = jQuery;

app.main = {
	adminSettingsBlockResizer: function () {
		if ($("html").hasClass("opened-sidebar")) {
			let elementWrap = $(".interface-interface-skeleton__sidebar")[0];
			let element;
			if (!elementWrap) return;

			//create box in bottom-left
			let resizer = document.createElement("button");
			resizer.className = "sidebar-resizer";
			//Append Child to Element
			elementWrap.appendChild(resizer);
			//box function onmousemove
			resizer.addEventListener("mousedown", initResizeEl, false);

			setTimeout(function () {
				element = $(elementWrap).find(
					".interface-complementary-area"
				)[0];

				$(element)
					.find(
						'.interface-complementary-area-header .components-button[aria-label="Close settings"]'
					)
					.on("click", function (e) {
						$("html").removeClass("opened-sidebar");
						$(
							".post-type-page .interface-interface-skeleton__sidebar"
						)
							.find(".sidebar-resizer")
							.remove();
					});
			}, 300);

			//Window function mousemove & mouseup
			function initResizeEl(e) {
				if (e.button === 0) {
					$("body").addClass("is-resizing");
					window.addEventListener("mousemove", resizeEl, false);
					window.addEventListener("mouseup", stopResizeEl, false);
				}
			}
			//on mouseup remove windows functions mousemove & mouseup
			function stopResizeEl(e) {
				$(resizer).blur();
				$("body").removeClass("is-resizing");
				window.removeEventListener("mousemove", resizeEl, false);
				window.removeEventListener("mouseup", stopResizeEl, false);
			}
			//resize the element
			function resizeEl(e) {
				element.style.width =
					document.documentElement.clientWidth - e.pageX + "px";
			}
		}
	},
};

app.init = function () {
	if ($("body").hasClass("wp-admin")) {
		setTimeout(function () {
			const adminOptionButton = $(
				".interface-pinned-items .components-button"
			);

			const config = {
				attributes: true,
				attributeOldValue: true,
				attributeFilter: ["class"],
			};

			const reziserObserverCallback = (mutationList, observer) => {
				if (adminOptionButton.hasClass("is-pressed")) {
					$("html").addClass("opened-sidebar");
					app.main.adminSettingsBlockResizer();
				} else {
					$("html").removeClass("opened-sidebar");
					$(".post-type-page .interface-interface-skeleton__sidebar")
						.find(".sidebar-resizer")
						.remove();
				}
			};

			if (adminOptionButton.length) {
				reziserObserverCallback();
				const observer = new MutationObserver(reziserObserverCallback);
				observer.observe(adminOptionButton[0], config);
			}
		}, 15000);
	}
};

$(function () {
	app.init();
});
