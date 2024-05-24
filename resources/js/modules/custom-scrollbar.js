import "jquery.scrollbar";

function setCustomScrollbar($node) {
	$node.scrollbar({
		ignoreMobile: true,
		ignoreOverlay: true,
		passive: true,
	});
}

function customScrollbar(node) {
	if (!node) return;

	const $node = $(node);

	if ($node.hasClass('scrollbar-outer')) {
		setCustomScrollbar($node);
	}

	setCustomScrollbar($node.find('.scrollbar-outer'));
}

export default customScrollbar;