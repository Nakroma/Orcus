/* Mobile Check */
if (/Android|webOS|iPhone|iPad|Chrome|iPod|BlackBerry/i.test(navigator.userAgent)) {
} else{
    $('head').append('<script src="bootstrap/js/parallax.js"></script>');
}

/* Skill Circle */
$(function () {
    $(".circle").knob({
        'readOnly': true,
        'min': 1,
        'max': 980,
        'width': 43,
        'height': 43,
        'thickness': 0.17,
        'bgColor': 'black',
        'fgColor': '#218ef1',
        'font': 'Arial',
        'draw': function () {
            $(this.i).css('font-size', '14px');
        }
    });
});

/* Fade on Scroll
 tiles = $("#fade-02, #fade-03").fadeTo(0, 0);

 $(window).scroll(function (d, h) {
 tiles.each(function (i) {
 a = $(this).offset().top + $(this).height();
 b = $(window).scrollTop() + $(window).height();
 if (0.81 * a < b) $(this).fadeTo(600, 1);
 });
 });*/


/* Navbar */
$(document).ready(function () {
    var scroll_start = 0;
    var startchange = $('.navbar');
    var offset = startchange.offset();
    $(document).scroll(function () {
        scroll_start = $(this).scrollTop();
        if (scroll_start > offset.top) {
            $('.navbar').css('background-color', 'rgba(10,12,15,1)');
            $('.navbar').css('box-shadow', '0px 3px 15px rgba(0,0,0,0.3)');
            $('.navbar').css('min-height', '70px');
            $('.navbar-header').css('margin-top', '19px');
            $('.orcus-logo-menu').css('max-height', '28px');
            $('.orcus-font-menu').css('max-height', '18px');
            $('.orcus-font-menu-anchor').css('padding-right', '90px');
            $('.navbar-nav').css('margin-top', '-2px');
            $('.navbar-right').css('margin-top', '1px');
        } else {
            $('.navbar').css('background-color', 'transparent');
            $('.navbar').css('box-shadow', '100px 10px 5px transparent');
            $('.navbar-header').css('margin-top', '45px');
            $('.orcus-logo-menu').css('max-height', '42px');
            $('.orcus-font-menu').css('max-height', '23px');
            $('.orcus-font-menu-anchor').css('padding-right', '50px');
            $('.navbar-nav').css('margin-top', '32px');
            $('.navbar-right').css('margin-top', '35px');
        }
    });
});

setTimeout(function(){
    odometer.innerHTML = 456;
}, 1000);