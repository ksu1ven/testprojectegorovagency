import YouTubePlayer from "youtube-player";
const $btModalYoutubeVideo = $('.js-bt-modal-youtube-video');
const $modalYoutubeVideo = $('#modal-youtube-video');
const $player = $modalYoutubeVideo.find('.js-modal-video-player');

function modalYoutubeVideoLogic() {
    if (!$btModalYoutubeVideo.length) return;

    const player = YouTubePlayer($player[0]);

    $btModalYoutubeVideo.click(function () {
        const $target = $(this);
        const videoId = $target.data('video-id');

        player.loadVideoById(videoId);

        $modalYoutubeVideo.modal('show');

        player.playVideo();
    });

    $modalYoutubeVideo.on('hide.bs.modal', function () {
        player.stopVideo();
    });
}

export default modalYoutubeVideoLogic;