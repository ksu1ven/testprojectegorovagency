const $btModalVideo = $('.js-bt-modal-video');
const $modalVideo = $('#modal-video');
const $video = $modalVideo.find('video');

function modalVideoLogic() {
    $btModalVideo.click(function () {
        const $target = $(this);
        const posterUrl = $target.data('poster-url');
        const videoUrl = $target.data('video-url');

        $video
            .attr('src', videoUrl)
            .attr('poster', posterUrl);

        $modalVideo.modal('show');

        $video.first().trigger('play');
    });

    $modalVideo.on('hide.bs.modal', function () {
        $video.first().trigger('pause');
    });
}

export default modalVideoLogic;