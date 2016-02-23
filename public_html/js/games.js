/* Side Menu Open */
$(".sidebar-menu-ico").click(function () {
    if ($('.sidebar-menu-ico').is('#menu-visible')) {
        $('.menu-open').css('right', '');
        $('.gd-sidebar').css('margin-left', '');
        $('.content').css('margin-left', '');
        $('.sidebar-content-dim').css('opacity', '').css('pointer-events', 'none');
        $('.sidebar-menu-ico').attr('src', 'img/hamburger.svg');
        $('.sidebar-menu-ico').removeAttr('id');
    } else {
        if ($('.sidebar-hide').is('#sidebar-hidden')) {
            $('.sidebar-menu-ico').attr('id', "menu-visible");
            $('.menu-open').css('right', '0px');
            $('.content').css('margin-left', '4.15%');
            $('.sidebar-menu-ico').attr('src', 'img/login-close.svg');
            $('.sidebar-content-dim').css('opacity', '1').css('pointer-events', 'all');
        } else {
            $('.sidebar-menu-ico').attr('id', "menu-visible");
            $('.menu-open').css('right', '0px');
            $('.gd-sidebar').css('margin-left', '-250px');
            $('.content').css('margin-left', '7vw');
            $('.sidebar-menu-ico').attr('src', 'img/login-close.svg');
            $('.sidebar-content-dim').css('opacity', '1').css('pointer-events', 'all');
        };
    };
});

$(".sidebar-content-dim").click(function () {
    $('.menu-open').css('right', '');
    $('.gd-sidebar').css('margin-left', '');
    $('.content').css('margin-left', '');
    $('.sidebar-content-dim').css('opacity', '').css('pointer-events', 'none');
    $('.sidebar-menu-ico').attr('src', 'img/hamburger.svg');
    $('.sidebar-menu-ico').removeAttr('id');
});