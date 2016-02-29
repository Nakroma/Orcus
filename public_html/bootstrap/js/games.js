/* Side Menu Open */
$(".sidebar-menu-ico").click(function () {
    if ($('.sidebar-menu-ico').is('#menu-visible')) {
        $('.menu-open').css('right', '');
        $('.gd-sidebar').css('margin-left', '');
        $('.content').css('margin-left', '');
        $('.game-bg').css('left', '');
        $('.sidebar-content-dim').css('opacity', '').css('pointer-events', 'none');
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg');
        $('.sidebar-menu-ico').removeAttr('id');
        setTimeout(function () {
            $('.game-bg').css('transition-delay', '0.15s');
        }, 10);
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
            $('.game-bg').css('transition-delay', '0s').css('left', '-14.15%');
            $('.sidebar-menu-ico').attr('src', 'bootstrap/img/login-close.svg');
            $('.sidebar-content-dim').css('opacity', '1').css('pointer-events', 'all');
        };
    };
});

$(".sidebar-content-dim").click(function () {
    $('.menu-open').css('right', '');
    $('.gd-sidebar').css('margin-left', '');
    $('.content').css('margin-left', '');
    $('.game-bg').css('left', '').css('transition-delay', '0.15s');
    $('.sidebar-content-dim').css('opacity', '').css('pointer-events', 'none');
    $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg');
    $('.sidebar-menu-ico').removeAttr('id');
    setTimeout(function () {
        $('.game-bg').css('transition-delay', '0.15s');
    }, 10);
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
