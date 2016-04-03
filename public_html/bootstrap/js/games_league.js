if (/Android|webOS|iPhone|iPad|Chrome|iPod|BlackBerry/i.test(navigator.userAgent)) {} else {
    $('head').append('<script src="bootstrap/js/parallax_games.js"></script>');
}

/* Hide Sidebar */
$(".sidebar-hide").click(function () {
    if ($('.sidebar-hide').is('#sidebar-visible')) {
        $('.sidebar-hide').removeAttr('id').attr('id', "sidebar-hidden");
        $('body').addClass('sidebar-hidden');
        if ($('#chat-option-2').is('.lobby-active')) {
            $('.lobby').css('width', '100%');
        } else {
            $('.lobby').css('width', '100%').css('margin-left', '-100%');
        };
    } else {
        $('.sidebar-hide').removeAttr('id').attr('id', "sidebar-visible");
        $('body').removeClass('sidebar-hidden');
    }
});


/* Toggle Chat Group */
$('#chat-option-2').click(function () {
    if ($(this).hasClass('chat-inactive') && $(this).hasClass('lobby-active')) {
        $(this).text('Lobby Chat').removeClass('chat-inactive').addClass('chat-active-l');
        $('.squad-chat-title').text('Squad Chat');
    } else {
        if ($(this).hasClass('chat-active-l') && $(this).hasClass('lobby-active')) {
            $(this).text('Squad Chat');
            $('.squad-chat-title').text('Lobby Chat');
            $(this).removeClass('chat-active-l').addClass('chat-inactive');
        } else {
            if ($(this).hasClass('chat-inactive')) {
                $(this).text('Squad Chat');
                $('.squad-chat-title').text('All Chat');
                $(this).removeClass('chat-inactive');
                $(this).addClass('chat-active');
            } else {
                $(this).text('All Chat');
                $('.squad-chat-title').text('Squad Chat');
                $(this).removeClass('chat-active');
                $(this).addClass('chat-inactive');
            }
        };
    };
});

/* Squad Queue */
$(".queue-pub-squads").click(function () {
    $('.queue-bg').css('width', '1200px').css('height', '1200px');
    $('.queue-pub-squads').css('display', 'none');
    $('.show-pub-squads').css('display', 'none');
    setTimeout(function () {
        $('.queue-status').css('opacity', '1');
        $('.queue-loading').css('opacity', '1');
    }, 300);
    $('.queue-status').text('Finding Squad...');
    $('.queue-loading-container').css('display', 'block');
    $('.queue-quit').css('display', 'block');
});

$(".queue-quit").click(queueQuit);
// Quit function
function queueQuit() {
    $('.queue-status').css('opacity', '0');
    $('.queue-loading').css('opacity', '0');
    $('.queue-bg').css('margin-left', '600px').css('margin-top', '-1000px');
    setTimeout(function () {
        $('.queue-bg').css('display', 'none');
        $('.queue-bg').css('width', '200px').css('height', '200px');
        $('.queue-bg').css('margin-left', '-290px').css('margin-top', '-200px');
        $('.queue-status').text('');
        $('.queue-quit').css('display', 'none');
        $('.queue-loading-container').css('display', 'none');
        setTimeout(function () {
            $('.queue-bg').css('display', 'block');
        }, 400);
    }, 600);
    setTimeout(function () {
        $('.queue-pub-squads').css('display', 'inline-block');
        $('.show-pub-squads').css('display', 'inline-block');
    }, 600);
}

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
            $('.content').css('margin-left', '4.15%');
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
    } else {
        HideMatchFilters();
    };
});

/* Activate Lobby */
$("#activate-lobby").click(function () {
    $('.lobby').css('margin-left', '0px');
    $('.sidebar-lobby-note').css('display', 'inline-block');
    $('.squad-chat-post').css('display', 'none');
    $('#chat-option-2').text('Squad Chat').addClass('lobby-active');
    $('.squad-chat-title').text('Lobby Chat');
    setTimeout(function () {
        $('.lobby-content').css('opacity', '1');
    }, 450);
    setTimeout(function () {
        $('.sidebar-lobby-note').css('opacity', '1');
    }, 1200);
});


/* Set Entries Hidden by default */
$('.sidebar-lobby-entry-filters').css('margin-top', '-250px');
$('.sidebar-lobby-entry-wrapper').css('opacity', '0');
$('#entries').addClass('ico-hidden');


/* Show Mode/Entry */
$(".sidebar-lobby-mode").click(function () {
    if ($('#entries').hasClass("ico-hidden")) {
        if ($('#modes').hasClass("ico-hidden")) {
            $('.sidebar-lobby-mode-filters').css('margin-top', '');
            $('.sidebar-lobby-mode-wrapper').css('opacity', '');
            $('#modes').removeClass('ico-hidden');
        } else {
            $('.sidebar-lobby-mode-filters').css('margin-top', '-200px');
            $('.sidebar-lobby-mode-wrapper').css('opacity', '0');
            $('#modes').addClass('ico-hidden');
        };
    } else {
        $('.sidebar-lobby-entry').addClass('animated pulse');
        $('.sidebar-lobby-entry-filters').css('margin-top', '-200px');
        $('.sidebar-lobby-entry-wrapper').css('opacity', '0');
        $('#entries').addClass('ico-hidden');
        setTimeout(function () {
            $('.sidebar-lobby-mode-filters').css('margin-top', '');
            $('.sidebar-lobby-mode-wrapper').css('opacity', '');
            $('#modes').removeClass('ico-hidden');
        }, 150);
    };
});

$(".sidebar-lobby-entry").click(function () {
    $('.sidebar-lobby-entry').removeClass('animated pulse')
    if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {
        if ($('#modes').hasClass("ico-hidden")) {
            if ($('#entries').hasClass("ico-hidden")) {
                $('.sidebar-lobby-entry-filters').css('margin-top', '');
                $('.sidebar-lobby-entry-wrapper').css('opacity', '');
                $('#entries').removeClass('ico-hidden');
            } else {
                $('.sidebar-lobby-entry').addClass('animated pulse');
                $('.sidebar-lobby-entry-filters').css('margin-top', '-200px');
                $('.sidebar-lobby-entry-wrapper').css('opacity', '0');
                $('#entries').addClass('ico-hidden');
            };
        } else {
            $('.sidebar-lobby-mode-filters').css('margin-top', '-200px');
            $('.sidebar-lobby-mode-wrapper').css('opacity', '0');
            $('#modes').addClass('ico-hidden');
            setTimeout(function () {
                $('.sidebar-lobby-entry-filters').css('margin-top', '');
                $('.sidebar-lobby-entry-wrapper').css('opacity', '');
                $('#entries').removeClass('ico-hidden');
            }, 150);
        };
    } else {
        $('.sidebar-entry-error').removeClass('error-hidden');
        setTimeout(function () {
            $('.sidebar-entry-error').addClass('error-hidden');
        }, 1200);
    };
});

/* Select Filters */

$(".game-mode-box").click(function () {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        if ($(this).parents('div').hasClass('sidebar-lobby-mode-filters') || $(this).parents('div').hasClass('game-mode-players')) {
            if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {} else {
                $('.sidebar-lobby-entry').removeClass('animated pulse');
            };
            var mode = $(this).text();
            $('.mode-child:contains(' + mode + ')').removeClass('entry-visible');
            setTimeout(function () {
                $('.mode-child:contains(' + mode + ')').remove();
            }, 120);
        } else {
            if ($('.game-entry-invest').children('div').hasClass('active') && $('.sidebar-lobby-entry-filters').children('div').hasClass('active')) {} else {
                $('.sidebar-queue-start').addClass('queue-not-ready');
                $('.sidebar-queue-start').removeClass('animated pulse queue-ready');
            };
            var entry = $(this).text();
            $('.entry-child:contains(' + entry + ')').removeClass('entry-visible');
            setTimeout(function () {
                $('.entry-child:contains(' + entry + ')').remove();
            }, 105);
        };
    } else {
        $(this).addClass('active');
        if ($(this).parents('div').hasClass('sidebar-lobby-mode-filters') || $(this).parents('div').hasClass('game-mode-players')) {
            if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {
                if ($('.sidebar-lobby-entry').hasClass('animated pulse')) {} else {
                    $('.sidebar-lobby-entry').addClass('animated pulse')
                };
            } else {};
            $('.mode-selected').append($("<div></div>").addClass('mode-child  number').html($(this).text()));
            setTimeout(function () {
                $('.mode-child:last').addClass('entry-visible');
            }, 10);
        } else {
            if ($('.game-entry-invest').children('div').hasClass('active') || $('.sidebar-lobby-entry-filters').children('div').hasClass('active')) {
                $('.sidebar-queue-start').removeClass('queue-not-ready');
                $('.sidebar-queue-start').addClass('animated pulse queue-ready')
            } else {};
            $('.entry-value').append($("<div></div>").addClass('entry-child  number').html($(this).text()));
            $('.entry-child:last').append($("<img src='bootstrap/img/currency_dark.svg'>").addClass('entry-ico'))
            setTimeout(function () {
                $('.entry-child:last').addClass('entry-visible');
            }, 10);
        };
    };
});

function ShowMatchFilters() {
    $('.sidebar-lobby-options').removeClass('filters-hidden');
    $('.gd-sidebar').css('margin-left', '-230px');
    $('.content').css('margin-left', 'calc(28.2% - 350px)');
    $('.gd-gamebar').css('right', '200px');
    $('.sidebar-content-dim').addClass('dim-visible');
    $('.user-menu').css('opacity', '0');
};

$('.queue-create').click(ShowMatchFilters);
$('#find-match').click(function () {
    $('.sidebar-queue-start').text('Find Match');
    ShowMatchFilters();
});
$('#create-lobby').click(function () {
    $('.sidebar-queue-start').text('Create Lobby');
    ShowMatchFilters();
});

function HideMatchFilters() {
    $('.sidebar-lobby-options').addClass('filters-hidden');
    $('.gd-sidebar').css('margin-left', '');
    $('.content').css('margin-left', '');
    $('.gd-gamebar').css('right', '');
    $('.sidebar-content-dim').removeClass('dim-visible');
    $('.user-menu').css('opacity', '1');
}

$('.queue-start-cancel').click(HideMatchFilters);

function ShowQueuePlayers() {
    $('.match-queue-status').addClass('status-visible');
    setTimeout(function () {
        $('.match-queue-status-desc').addClass('animated pulse');
    }, 980);
    ShowLobby();
    setTimeout(function () {
        HideQueuePlayers();
        HideMatchFilters();
    }, 4200);
};

function HideQueuePlayers() {
    $('.match-queue-status').removeClass('status-visible');
    $('.match-queue-status-desc').removeClass('animated pulse');
};

function ShowLobby() {
    setTimeout(function () {
        $('.lobby').addClass('lobby-visible');
        $('.sidebar-lobby-note').css('display', 'inline-block');
        $('.squad-chat-post').css('display', 'none');
        $('#chat-option-2').text('Squad Chat').addClass('lobby-active');
        $('.squad-chat-title').text('Lobby Chat');
        setTimeout(function () {
            $('.lobby-content').css('opacity', '1');
        }, 650);
        setTimeout(function () {
            $('.sidebar-lobby-note').css('opacity', '1');
        }, 1200);
    }, 4200);
}

$(".sidebar-queue-start").click(function () {
    if ($(this).hasClass('queue-ready')) {
        if ($('.match-queue-status').hasClass('status-visible')) {
            HideQueuePlayers();
        } else {
            ShowQueuePlayers();
        };
    } else {};

});
