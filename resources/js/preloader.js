window.addEventListener("load", function () {
	setTimeout(() => {
		window.dispatchEvent(new Event("touchend"));
		window.dispatchEvent(new Event("click"));
	}, 2500);
});
