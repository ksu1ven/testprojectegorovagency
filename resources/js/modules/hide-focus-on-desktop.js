function hideFocusOnDesktop() {
    $('a, button, input[type="checkbox"], input[type="radio"]').on('mouseup, mouseleave', function() {
        $(this).blur();
    });

    $('.modal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const modal = $(this);

        modal.on('hidden.bs.modal', function () {
            setTimeout(function () {
                button.blur();
            }, 50);
        })
    });
}

export default hideFocusOnDesktop;