const resizeDependent = () => {
	let vh = window.innerHeight * 0.01;
	let vw;
	
	if($('.wp-site-blocks').length) {
		vw = document.querySelector('.wp-site-blocks').clientWidth * 0.01;
	} else {
		vw = document.documentElement.clientWidth * 0.01;
	}
	document.documentElement.style.setProperty("--vh", `${vh}px`);
	document.documentElement.style.setProperty("--vw", `${vw}px`);
};

function updateStyleVariables() {
    $(window).resize(function () {
        resizeDependent();
    });

    resizeDependent();
}

export default updateStyleVariables;