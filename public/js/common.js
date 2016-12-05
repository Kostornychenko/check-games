$(document).ready(function() {

    //init slider
    $('.slider').owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
    });

    var progressBars = $('.progressbar');

    progressBars.each(function (el, item) {
        var that = $(item),
            val = that.data('value');

        progressbar(val, item);
    });

});

function progressbar(val, parent) {

    var curVal = val;

    var bar = new ProgressBar.Circle(parent, {
        color: '#eb5635',
        strokeWidth: 4,
        strokeColor: '#b7bacd',
        trailWidth: 1,
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        step: function(state, circle) {
            circle.setText(curVal);
        }
    });
    bar.text.style.fontFamily = '"Lato", Helvetica, sans-serif';
    bar.text.style.fontSize = '16px';
    bar.text.style.color = '#b7bacd';

    bar.animate(curVal/10);  // Number from 0.0 to 1.0
}