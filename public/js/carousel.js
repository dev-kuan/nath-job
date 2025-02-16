function updateFlickityOptions() {
    var cellAlignValue = window.innerWidth > 768 ? 'left' : 'center';

    var $carousel = $('.main-carousel');
    var flkty = $carousel.data('flickity');

    if (flkty) {
        flkty.options.cellAlign = cellAlignValue;
        flkty.destroy();
        $carousel.flickity({
            cellAlign: cellAlignValue,
            contain: true,
            prevNextButtons: false,
            pageDots: false,
            friction: 0.15,
            autoPlay: 2500,
            pauseAutoPlayOnHover: true,
        });
    } else {
        $carousel.flickity({
            cellAlign: cellAlignValue,
            contain: true,
            prevNextButtons: false,
            pageDots: false,
            friction: 0.15,
            autoPlay: 2500,
            pauseAutoPlayOnHover: true,
        });
    }
}

$(document).ready(function () {
    updateFlickityOptions();
    $(window).resize(function () {
        updateFlickityOptions();
    });
});
