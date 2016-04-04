/* Side Menu Open */
$(".sidebar-menu-ico").click(function () {
    if ($('.sidebar-menu-ico').is('#menu-visible')) {
        $('.menu-open').css('right', '');
        $('.gd-sidebar').css('margin-left', '');
        $('.content').css('margin-left', '');
        $('.sidebar-content-dim').removeClass('dim-visible');
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg');
        $('.sidebar-menu-ico').removeAttr('id');
    } else {
        if ($('.sidebar-hide').is('#sidebar-hidden')) {
            $('.sidebar-menu-ico').attr('id', "menu-visible");
            $('.menu-open').css('right', '100px');
            $('.content').css('margin-left', '2.15%');
            $('.sidebar-menu-ico').attr('src', 'bootstrap/img/login-close.svg');
            $('.sidebar-content-dim').addClass('dim-visible');
        } else {
            $('.sidebar-menu-ico').attr('id', "menu-visible");
            $('.menu-open').css('right', '100px');
            $('.gd-sidebar').css('margin-left', '-230px');
            $('.content').css('margin-left', 'calc(28.2% - 350px)');
            $('.sidebar-menu-ico').attr('src', 'bootstrap/img/login-close.svg');
            $('.sidebar-content-dim').addClass('dim-visible');
        };
    };
});

$(".sidebar-content-dim").click(function () {
    if ($('.sidebar-lobby-options').hasClass('filters-hidden')) {
        $('.menu-open').css('right', '');
        $('.gd-sidebar').css('margin-left', '');
        $('.content').css('margin-left', '');
        $('.sidebar-content-dim').removeClass('dim-visible');
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg');
        $('.sidebar-menu-ico').removeAttr('id');
    } else {};
});

/* Background Swap */
$('.dota').hover(function () {
    setTimeout(function () {
        $('.main-bg').attr('src', 'bootstrap/img/dota_bg.png');
    }, 700);
});
$('.csgo').hover(function () {
    setTimeout(function () {
        $('.main-bg').attr('src', 'bootstrap/img/csgo_game_full_bg.png');
    }, 700);
});
$('.lol').hover(function () {
    setTimeout(function () {
        $('.main-bg').attr('src', 'bootstrap/img/league_game_full_bg.png');
    }, 700);
});
$('.hearthstone').hover(function () {
    setTimeout(function () {
        $('.main-bg').attr('src', 'bootstrap/img/hearthstone_game_full_bg.png');
    }, 700);
});
