var queueTimes = []

var winsSelf = $('#wins').text();
var skillSelf = $('#skill').text();
var lostSelf = $('#lost').text();


window.odometerOptions = {
    duration: 1300,
    selector: '.stats-number'
};


function GamesLobby_userStatsUpdate() {
    var wins = '53';
    var skill = '890';
    var lost = '2';

    $('#wins').text(wins);
    $('#skill').text(skill);
    setTimeout(function () { //won't animate on chrome w/o timeout
        $('#lost').text(lost);
    }, 1);
};

function GamesLobby_userStatsReset() {
    $('#wins').text(winsSelf);
    $('#skill').text(skillSelf);
    $('#lost').text(lostSelf);
};


/* role selection */


function GamesLobby_selectRole(username, userImgSrc, role, type) {
    console.log(type)
    if (type === 'own') {
        if (role.hasClass('other-taken')) {} else {
            queueTimes.push($(role).find('.queue-est').text());
            if (queueTimes.length > 2) {
                queueTimes.shift()
            }
            $('.self-taken').find('.queue-est-text').text('avg queue time');
            $('.self-taken').find('.queue-est').text(queueTimes[0]);
            $('.self-taken').removeClass('locked-in role-ready role-taken');
            $('.role-default').removeClass('role-default role-preview')
            $('.self-taken').parent().removeClass('role-preview')
            $('.self-taken').removeClass('self-taken');
            $('.queue-est').removeClass('queue-est-taken queue-est-locked')
            $(role).find('.role-p-sub').addClass('role-taken');
            $(role).find('.role-p-sub').addClass('self-taken');
            $(role).addClass('role-preview');
            $(role).find('.role-taken-img').attr('src', userImgSrc);
            $(role).find('.queue-est').text(username).addClass('queue-est-taken');
            $(role).find('.queue-est-text').text('role taken by');
            $('.lock-in-role').addClass('lock-in-ready');
            $('.roles-drag-note').addClass('invis');
        }
    } else {
        $(role).find('.role-p-sub').addClass('role-taken');
        $(role).find('.role-p-sub').addClass('other-taken');
        $(role).addClass('role-preview');
        $(role).find('.role-taken-img').attr('src', userImgSrc);
        $(role).find('.queue-est').text(username).addClass('queue-est-taken');
        $(role).find('.queue-est-text').text('role taken by');
    }
}

$(document.body).on('click', '.role-p-s', function () {
    var username = $('.squad-self-name').text();
    var userImgSrc = 'bootstrap/img/ava_sample_4.png'
    var role = $(this)
    GamesLobby_selectRole(username, userImgSrc, role, 'own');
})






/* role lock in & load lobby */
$(document.body).on('click', '.lock-in-role', function () {
    var player_amount = []
    var roles_amount = []

    $(this).children('.squad-slot-taken').each(function () {
        player_amount.push('taken');
    });
    $(this).children('.role').each(function () {
        roles_amount.push('taken');
    });

    $('.self-taken').addClass('locked-in');
    $('.self-taken').addClass('role-ready');
    $('.queue-est-taken').addClass('queue-est-locked');
    $('.lock-in-ready').removeClass('lock-in-ready');
    $(lobbyData["Lobby-5"]).insertAfter($('.lobby-wr'));
    setTimeout(function () {
        if (player_amount.length == roles_amount.length) {
            $('.pick-a-role').addClass('par-hidden')
            setTimeout(function () {
                $('.lobby-content').css('opacity', '1');
            }, 1);
        }
    }, 1000);
})

function GamesLobby_SwapChat() {
    $('.chat-group-active').removeClass('chat-group-active');
    $('#squad-chat').addClass('chat-group-active');
}



$(document).on({
    mouseenter: function () {
        GamesLobby_userStatsUpdate();
    },
    mouseleave: function () {
        GamesLobby_userStatsReset();
    }
}, '.team-slot-taken');








/*
Lane Selection
*/

$(document).on({
    mouseenter: function () {
        $('.lane-text, .lane-inactive-shade').css('opacity', '0', 'pointer-events', 'none');
    },
    mouseleave: function () {
        if ($(this).hasClass('lobby-lane-taken')) {} else {
            $('.lane-text, .lane-inactive-shade').css('opacity', '1');
        }
    }
}, '.lobby-lane');


$(document).on({
    mouseenter: function () {
        if ($(this).find('.lane-self-taken')) {
            if ($(this).hasClass('top-lane')) {

                /* start top lane function */
                var topStatus = [];
                $(this).children('.lane-ava-visible').each(function () {
                    topStatus.push('taken');
                });
                var topCount = topStatus.length;
                if (topCount > 0) {
                    if (topCount > 1) {
                        if (topCount > 2) { //lane full
                        } else {
                            $('.top-3').addClass('lane-ava-preview lane-self-preview');
                        }
                    } else {
                        $('.top-2').addClass('lane-ava-preview lane-self-preview');
                    }
                } else {
                    $('.top-1').addClass('lane-ava-preview lane-self-preview');
                }


            } else {
                if ($(this).hasClass('mid-lane')) {

                    /* start mid lane function */
                    var topStatus = [];
                    $(this).children('.lane-ava-visible').each(function () {
                        topStatus.push('taken');
                    });
                    var topCount = topStatus.length;
                    if (topCount > 0) {
                        if (topCount > 1) { //lane full
                        } else {
                            $('.mid-2').addClass('lane-ava-preview lane-self-preview');
                        }
                    } else {
                        $('.mid-1').addClass('lane-ava-preview lane-self-preview');
                    }


                } else {
                    if ($(this).hasClass('bot-lane')) {

                        /* start bot lane function */
                        var topStatus = [];
                        $(this).children('.lane-ava-visible').each(function () {
                            topStatus.push('taken');
                        });
                        var topCount = topStatus.length;
                        if (topCount > 0) {
                            if (topCount > 1) {
                                if (topCount > 2) { //lane full
                                } else {
                                    $('.bot-3').addClass('lane-ava-preview lane-self-preview');
                                }
                            } else {
                                $('.bot-2').addClass('lane-ava-preview lane-self-preview');
                            }
                        } else {
                            $('.bot-1').addClass('lane-ava-preview lane-self-preview');
                        }
                    }
                }
            }
        }

    },
    mouseleave: function () {
        if ($(this).hasClass('lobby-lane-taken')) {} else {
            $('.lane-self-preview').removeClass('lane-ava-preview');
            $('.lane-self-preview').removeClass('lane-self-preview');
        }
    }
}, '.top-lane, .mid-lane, .bot-lane');

$(document.body).on('click', '.top-lane, .bot-lane, .mid-lane', function () {
    var dis = $(this) //i hate javascript
    if ($(dis).children().hasClass('lane-self-taken')) {
        setTimeout(function () { //will trigger twice on mouseup w/o timeout

            $('.lane-self-taken').removeClass('lane-self-taken lane-ava-visible')
            $('.lobby-lane').removeClass('lobby-lane-taken');

        }, 1);
    } else {
        setTimeout(function () { //will trigger twice on mouseup w/o timeout

            $('.lane-self-taken').removeClass('lane-self-taken lane-ava-visible')
            $(dis).find('.lane-self-preview').addClass('lane-ava-visible lane-self-taken').removeClass('lane-ava-preview');
            $('.lobby-lane').addClass('lobby-lane-taken');

        }, 1);
    }
})
