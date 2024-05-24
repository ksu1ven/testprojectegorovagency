const userAgent = window.navigator.userAgent;

/**
 * Check whether the browser is Internet Explorer.
 *
 * @return {boolean}
 */
export const isIe = () => {
	return userAgent.indexOf("Trident/") > 0;
};

/**
 * Check whether the browser is Edge.
 *
 * @return {boolean}
 */
export const isEdge = () => {
	return userAgent.indexOf("Edge/") > 0;
};

/**
 * Check is Mobile.
 *
 * @returns {boolean|boolean}
 */
export const isMobile = () => {
	return (
		["iPad Simulator", "iPhone Simulator", "iPod Simulator", "iPad", "iPhone", "iPod",].includes(navigator.platform) ||
		(navigator.userAgent.includes("Mac") && "ontouchend" in document) ||
		navigator.userAgent.indexOf("android") > -1
	);
};

export default {
	isIe,
	isEdge,
	isMobile
}