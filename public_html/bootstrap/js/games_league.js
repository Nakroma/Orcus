// Sidebar Filter Functions

// Trigger according Filters
$('.queue-create').click(GamesLeague_ShowMatchFilters)
$('.menu-play').click(function () {
    if ($(this).children().hasClass('cancel-text')) {
        //SocketClient_send('SQUAD_CANCEL_MATCHMAKING', []);
        GamesLeague_CancelCurrentScreen();
    } else {
        $('.queue-options').text('Find Match')
        $('.sidebar-queue-start').text('Find Match')
        GamesLeague_ShowMatchFilters()
    }
})
$('.menu-create').click(function () {
    $('.queue-options').text('Create Lobby')
    $('.sidebar-queue-start').text('Create Lobby')
    GamesLeague_ShowMatchFilters()
})



function GamesLeague_ShowMatchFilters() {
    $('.sidebar-lobby-options').removeClass('filters-hidden')
    $('.content').css('transform', 'translateX(-12%)')
    $('.content-bg').css('transform', 'translateX(3%)')
    $('.sidebar-content-dim').addClass('dim-visible')
    $('.user-menu').css('opacity', '0')
}

function GamesLeague_HideMatchFilters() {
    $('.sidebar-lobby-options').addClass('filters-hidden')
    $('.content, .content-bg').css('transform', '')
    $('.sidebar-content-dim').removeClass('dim-visible')
    $('.user-menu').css('opacity', '1')
}



// Hide/Show Modes
$(".sidebar-lobby-mode").click(function () {
    $('.sidebar-lobby-entry').addClass('animated pulse')
    $('.queue-filters').removeClass('sidebar-entry-visible');
    $('#entries').addClass('ico-hidden')
    setTimeout(function () {
        $('#modes').removeClass('ico-hidden')
    }, 150)
})


// Hide/Show Entry
$(".sidebar-lobby-entry").click(function () {
    $('.sidebar-lobby-entry').removeClass('animated pulse')

    // Check if game modes selected
    if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {
        $('.queue-filters').addClass('sidebar-entry-visible');
        $('#modes').addClass('ico-hidden')
        setTimeout(function () {
            $('#entries').removeClass('ico-hidden')
        }, 150)
    } else {

        // Show Error if insufficient Mode selection
        $('.sidebar-entry-error').removeClass('error-hidden')
        setTimeout(function () {
            $('.sidebar-entry-error').addClass('error-hidden')
        }, 1200)

    }
})




// Filter Selection
$(".game-mode-box").click(function () {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active')
        if ($(this).parents('div').hasClass('sidebar-lobby-mode-filters') || $(this).parents('div').hasClass('game-mode-players')) {
            if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {} else {
                $('.sidebar-lobby-entry').removeClass('animated pulse')
            }

            //remove game mode from bottom
            var mode = $(this).text()
            $('.mode-child:contains(' + mode + ')').removeClass('entry-visible')
            setTimeout(function () {
                $('.mode-child:contains(' + mode + ')').remove()
            }, 120)

            //remove game mode from menu bar
            var modeOne = 'All Pick';
            var modeOneAcr = 'AP'
            var modeTwo = 'ARAM';
            var modeTwoAcr = 'ARAM';
            var modeThree = 'SWAG';
            var modeThreeAcr = 'SWAG';
            var modeFour = "Captain's Draft";
            var modeFourAcr = "CD";
            var gameModes = [modeOne, modeOneAcr, modeTwo, modeTwoAcr, modeThree, modeThreeAcr, modeFour, modeFourAcr];
            var modeAmount = gameModes.length;

            for (i = 0; i < modeAmount; i += 2) {
                if ($(this).text() == gameModes[i]) {
                    $('.filter-mode[id=' + gameModes[i + 1] + ']').remove();
                } else {};
            };

        } else {
            if ($('.game-entry-invest').children('div').hasClass('active') || $('.sidebar-lobby-entry-filters').children('div').hasClass('active')) {} else {
                $('.sidebar-queue-start').addClass('queue-not-ready')
                $('.sidebar-queue-start').removeClass('animated pulse queue-ready')
            }
            var entry = $(this).text()
            $('.entry-child:contains(' + entry + ')').removeClass('entry-visible')
            setTimeout(function () {
                $('.entry-child:contains(' + entry + ')').remove()
            }, 125)
        }
    } else {
        $(this).addClass('active')
        if ($(this).parents('div').hasClass('sidebar-lobby-mode-filters') || $(this).parents('div').hasClass('game-mode-players')) {
            if ($('.game-mode-players').children('div').hasClass('active') && $('.sidebar-lobby-mode-filters').children('div').hasClass('active')) {
                if ($('.sidebar-lobby-entry').hasClass('animated pulse')) {} else {
                    $('.sidebar-lobby-entry').addClass('animated pulse')
                }
            } else {}

            //add game mode to bottom
            $('.mode-selected').append($("<div></div>").addClass('mode-child  number').html($(this).text()))
            setTimeout(function () {
                $('.mode-child:last').addClass('entry-visible')
            }, 10);

            //add game modes to menu bar
            var modeOne = 'All Pick';
            var modeOneAcr = 'AP';
            var modeTwo = 'ARAM';
            var modeTwoAcr = 'ARAM';
            var modeThree = 'SWAG';
            var modeThreeAcr = 'SWAG';
            var modeFour = "Captain's Draft";
            var modeFourAcr = "CD";
            var gameModes = [modeOne, modeOneAcr, modeTwo, modeTwoAcr, modeThree, modeThreeAcr, modeFour, modeFourAcr];
            var modeAmount = gameModes.length;

            for (i = 0; i < modeAmount; i += 2) {
                if ($(this).text() == gameModes[i]) {
                    $('.filter-game-modes').append($("<div></div>").addClass("filter-mode").attr('id', gameModes[i + 1]).html(gameModes[i + 1]));
                } else {};
            };
        } else {
            if ($('.game-entry-invest').children('div').hasClass('active') || $('.sidebar-lobby-entry-filters').children('div').hasClass('active')) {
                $('.sidebar-queue-start').removeClass('queue-not-ready')
                $('.sidebar-queue-start').addClass('animated pulse queue-ready')
            } else {}
            $('.entry-value').append($("<div></div>").addClass('entry-child  number').html($(this).text()))
            $('.entry-child:last').append($("<img src='bootstrap/img/currency_dark.svg'>").addClass('entry-ico'))
            setTimeout(function () {
                $('.entry-child:last').addClass('entry-visible')
            }, 10)
        }
    }
    var gameEntry = [];
    $('.sidebar-lobby-entry-wrapper').find('.active').each(function () {
        gameEntry.push($(this).text())
        gameEntry.sort(function (a, b) {
            return a - b
        })
        var n = gameEntry.length
        if (n > 1) {
            $('.filter-entry-value').text(gameEntry[0] + '-' + gameEntry[n - 1] + '$')
        } else {
            $('.filter-entry-value').text(gameEntry[0] + '$')
        }
    })
})















// Queue Activation Functions

function GamesLeague_queueStartTransforms() {
    $('.play-text').addClass('cancel-text').text('Cancel');
    $('.play-ico').addClass('cancel-ico');
    $('.menu-create-normal, .play-bloom').css('visibility', 'hidden');
    $('.menu-create-filters, .filter-entry').removeClass('invis');
    $('#squad-chat > .chat-group-td > .chat-group-desc').text('Queueing')
    $(".chat-scroll").load("feeds.php #")
    $('.chat-lobby-notification').text('You are now connected to the Lobby!')
    setTimeout(function () {
        $('.lobby-top-bar, .lobby-bot-bar').addClass('lobby-title-visible')
    }, 450)
}

function GamesLeague_queueCancelTransforms() {
    $('.play-text').removeClass('cancel-text').text('Play');
    $('.play-ico').removeClass('cancel-ico');
    $('.menu-create-normal, .play-bloom').css('visibility', 'visible');
    $('.menu-create-filters, .filter-entry').addClass('invis');
    $('.chat-lobby-notification').text('');
    $('.chat-group-active').removeClass('chat-group-active')
    $('#all-chat').addClass('chat-group-active');
    $('#squad-chat > .chat-group-td > .chat-group-desc').text('Main Menu')
    $('.lobby-top-bar, .lobby-bot-bar').removeClass('lobby-title-visible')
}

function GamesLeague_queueLoadLobby() {
    setTimeout(function () {
        $('.news-notifications').removeClass('news-visible');
        setTimeout(function () {
            $('.lobby').addClass('lobby-visible');
        }, 0)
    }, 450)
}

function GamesLeague_queueLoadMain() {
    $('.lobby').removeClass('lobby-visible');
    setTimeout(function () {
        $('.news-notifications').addClass('news-visible');
    }, 150)

}

function GamesLeague_CancelCurrentScreen() {
    GamesLeague_queueCancelTransforms();
    GamesLeague_queueLoadMain();
    setTimeout(function () {
        $('.main-content').find('.lobby-wr').siblings().remove();
    }, 400);
}











// Side Menu Functions
$(".side-menu, .side-menu-open").click(function () {
    if ($('.sidebar-menu-ico').is('#menu-visible')) {
        $('.content-bg, .user-menu, .content, .menu-ope').css('transform', '')
        $('.menu-open').css('transform', '')
        $('.sidebar-content-dim').removeClass('dim-visible')
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg')
        $('.sidebar-menu-ico').removeAttr('id')
    } else {
        $('.sidebar-menu-ico').attr('id', "menu-visible")
        $('.menu-open').css('transform', 'translateX(-350px)')
        $('.content').css('transform', 'translateX(-12%)')
        $('.user-menu').css('transform', 'translateX(-12%)')
        $('.content-bg').css('transform', 'translateX(4%)')
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/login-close.svg')
        $('.sidebar-content-dim').addClass('dim-visible')
    }
})

$(".sidebar-content-dim").click(function () {
    if ($('.sidebar-lobby-options').hasClass('filters-hidden')) {
        $('.content, .content-bg, .menu-open').css('transform', '')
        $('.sidebar-content-dim').removeClass('dim-visible')
        $('.sidebar-menu-ico').attr('src', 'bootstrap/img/hamburger.svg')
        $('.sidebar-menu-ico').removeAttr('id')
        $('.chat').removeClass('chat-visible');
    } else {
        GamesLeague_HideMatchFilters()
    }
})













/* Squad Invite Functions */

$('.squad-invite-block-box').click(function () {
    if ($(this).hasClass('block-box-selected')) {
        $(this).removeClass('block-box-selected')
    } else {
        $(this).addClass('block-box-selected')
    }
})

$(document).on({
    mouseenter: function () {
        GamesChat_showSquadMemberDetails()
    },
    mouseleave: function () {
        GamesChat_hideSquadMemberDetails()
    }
}, '.squad-slot-taken')



$('.squad-invite-accept-decline').on('click', '.squad-invite-decline', function () {
    $('.squad-invite-wr').addClass('squad-invite-hidden')
});
$('.squad-invite-accept-decline').on('click', '.squad-invite-accept', function () {
    $('.squad-invite-wr').addClass('squad-invite-hidden');
    // Accepts invite
    //SocketClient_send('SQUAD_JOIN_USER', squadCurrentInvite);
});
