/* Mobile Check */
if (/Android|webOS|iPhone|iPad|Chrome|iPod|BlackBerry/i.test(navigator.userAgent)) {} else {
    $('head').append('<script src="js/parallax.js"></script>');
}

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