/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import YouTubePlayer from "youtube-player";

const init = function () {
	const modalVideo = document.querySelector(".js-modal-video");
	const modalVideoContent = document.querySelector(".js-modal-video__content");
	const selfHostedPlayer = document.querySelector("#self-hosted-player");
	const youtubePlayer = document.querySelector("#youtube-player");
	let player = YouTubePlayer("youtube-player");

	if (modalVideo && modalVideoContent && selfHostedPlayer && youtubePlayer) {
		document
			.querySelectorAll(".js-testimonials__video")
			.forEach((videoPreview) => {
				videoPreview.addEventListener("click", () => {
					if (videoPreview.dataset.origin === "self-hosted") {
						youtubePlayer.style.display = "none";
						selfHostedPlayer.style.display = "block";
						selfHostedPlayer.src = videoPreview.dataset.href;
						selfHostedPlayer.play();
					} else if (videoPreview.dataset.origin === "youtube") {
						selfHostedPlayer.style.display = "none";
						youtubePlayer.style.display = "block";
						player.loadVideoById(videoPreview.dataset.youtubeId);
						player.playVideo();
					}
				});
			});

		function checkModalClose(mutationsList) {
			for (let mutation of mutationsList) {
				if (
					mutation.type === "attributes" &&
					mutation.attributeName === "class"
				) {
					if (
						!modalVideo.classList.contains("show") &&
						modalVideoContent.children[0]
					) {
						selfHostedPlayer.pause();
						player.stopVideo();
					}
				}
			}
		}
		const observer = new MutationObserver(checkModalClose);
		observer.observe(modalVideo, {
			attributes: true,
		});
	}
};

initScript(".js-section-testimonials", "testimonials", init);