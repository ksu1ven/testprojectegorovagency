/**
 * Internal Dependencies
 */
import { initScript } from "../../../../resources/js/utils/init-script";
import Swiper, { Pagination, Navigation } from "swiper";
import YouTubePlayer from "youtube-player";

const init = function () {
	new Swiper(".js-learning-center-left-swiper", {
		modules: [Pagination, Navigation],
		allowTouchMove: false,
		slidesPerView: 1,
		initialSlide: 0,
		pagination: {
			el: ".js-learning-center-swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".js-learning-center-swiper-button-next",
			prevEl: ".js-learning-center-swiper-button-prev",
		},
	});

	new Swiper(".js-learning-center-right-swiper", {
		modules: [Pagination, Navigation],
		allowTouchMove: false,
		slidesPerGroup: 1,
		initialSlide: 0,
		spaceBetween: 20,
		pagination: {
			el: ".js-learning-center-swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".js-learning-center-swiper-button-next",
			prevEl: ".js-learning-center-swiper-button-prev",
		},

		breakpoints: {
			320: {
				slidesPerView: 1,
			},

			1280: {
				slidesPerView: 2,
			},
		},
	});

	const youtubePlayers = document.querySelectorAll(
		'[id^="learning-youtube-player"]'
	);
	let players = [];

	const learningCenterSwipers = document.querySelector(
		".js-learning-center__swipers"
	);
	const controls = [
		...document.querySelectorAll(
			".js-learning-center-swiper-pagination .swiper-pagination-bullet"
		),
		document.querySelector(".js-learning-center-swiper-button-next"),
		document.querySelector(".js-learning-center-swiper-button-prev"),
	];

	const playButtonSelfHosted = document.querySelectorAll(
		".js-self-hosted-video-bg .js-play-icon"
	);

	const selfHostedVideos = document.querySelectorAll(".js-self-hosted-video");

	function selfHostedVideoPlay(videoWrapper, muted) {
		videoWrapper.querySelector(".js-self-hosted-video-bg").style.display =
			"none";

		const video = videoWrapper.querySelector(".js-self-hosted-video");
		video.muted = muted;
		video.playisinline = muted;
		video.controls = true;
		video.play();
	}

	function selfHostedVideoPause(videoWrapper) {
		const video = videoWrapper.querySelector(".js-self-hosted-video");
		if (!video.paused) video.pause();
	}

	async function youtubeVideoPlay(leftActiveYoutubeVideo) {
		let foundPlayer = players.find(
			(el) => el.playerId === leftActiveYoutubeVideo.lastElementChild.id
		);
		if (foundPlayer) {
			foundPlayer.active = true;
			leftActiveYoutubeVideo.querySelector(
				".js-youtube-video-bg"
			).style.display = "none";
			let playerState = await foundPlayer.player.getPlayerState();
			if (playerState !== undefined) {
				foundPlayer.player.mute();
				foundPlayer.player.playVideo();
			} else {
				foundPlayer.player.on("stateChange", (e) => {
					if (e.data !== undefined) {
						foundPlayer.player.mute();
						foundPlayer.player.playVideo();
					}
				});
			}
		}
	}

	async function youtubeVideoPause() {
		let foundPlayer = players.find((el) => el.active);
		if (foundPlayer) {
			let playerState = await foundPlayer.player.getPlayerState();
			if (playerState !== undefined) {
				foundPlayer.player.pauseVideo();
			} else {
				foundPlayer.player.on("stateChange", (e) => {
					if (e.data !== undefined) {
						foundPlayer.player.pauseVideo();
					}
				});
			}
		}
	}

	function playActiveVideo() {
		let leftActiveSelfHostedVideo = document.querySelector(
			".learning-center-left-swiper__wrapper .swiper-slide-active .js-self-hosted-video-wrapper"
		);
		let leftActiveYoutubeVideo = document.querySelector(
			".learning-center-left-swiper__wrapper .swiper-slide-active .js-youtube-video-wrapper"
		);

		if (leftActiveSelfHostedVideo) {
			selfHostedVideoPlay(leftActiveSelfHostedVideo, true);
			return;
		} else if (leftActiveYoutubeVideo) {
			youtubeVideoPlay(leftActiveYoutubeVideo);
		}
	}

	function pauseActiveVideo() {
		let leftActiveSelfHostedVideo = document.querySelector(
			".learning-center-left-swiper__wrapper .swiper-slide-active .js-self-hosted-video-wrapper"
		);
		let leftActiveYoutubeVideo = document.querySelector(
			".learning-center-left-swiper__wrapper .swiper-slide-active .js-youtube-video-wrapper"
		);

		if (leftActiveSelfHostedVideo) {
			selfHostedVideoPause(leftActiveSelfHostedVideo);
			return;
		} else if (leftActiveYoutubeVideo) {
			youtubeVideoPause();
		}
	}

	function pauseAllVideos() {
		selfHostedVideos.forEach((video) => {
			if (!video.paused) video.pause();
		});
		players.forEach((item) => {
			if (item.active) {
				item.player.pauseVideo();
			}
		});
	}

	if (youtubePlayers) {
		youtubePlayers.forEach(async (video) => {
			const id = video.id;
			let playButtonYoutube =
				video.parentElement.querySelector(".js-play-icon");
			let player = YouTubePlayer(id);
			player.cueVideoById(video.dataset.youtubeId);
			players.push({
				playerId: id,
				player,
				active: false,
			});
			let playerState = await player.getPlayerState();
			if (playerState === undefined) {
				let counter = 0;
				player.on("stateChange", (e) => {
					if (e.data === -1 && counter === 0) {
						playButtonYoutube.addEventListener("click", () => {
							pauseActiveVideo();
							playButtonYoutube.parentElement.style.display = "none";
							players.find((item) => item.playerId === id).active = true;
							player.playVideo();
						});
						counter++;
					}
					if (e.data === 2) {
						playButtonYoutube.parentElement.style.display = "flex";
						players.find((item) => item.playerId === id).active = false;
					}
				});
			}
		});
	}

	function handleIntersection(entries) {
		entries.forEach((entry) => {
			if (entry.isIntersecting) {
				playActiveVideo();
			} else {
				pauseActiveVideo();
			}
		});
	}

	const observer = new IntersectionObserver(handleIntersection, {
		root: null,
		rootMargin: "0px",
		threshold: 0.8,
	});

	observer.observe(learningCenterSwipers);

	playButtonSelfHosted.forEach((button) => {
		button.addEventListener("click", () => {
			pauseActiveVideo();
			selfHostedVideoPlay(button.parentElement.parentElement, false);
		});
	});

	selfHostedVideos.forEach((video) =>
		video.addEventListener("pause", () => {
			video.parentElement.querySelector(
				".js-self-hosted-video-bg"
			).style.display = "flex";
		})
	);

	controls.forEach((el) =>
		el.addEventListener("click", () => {
			pauseAllVideos();
			setTimeout(() => playActiveVideo());
		})
	);
};

initScript(".learning-center", "learning-center", init);
