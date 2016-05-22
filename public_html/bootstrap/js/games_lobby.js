var userImgSrc = 'bootstrap/img/ava_sample_4.png'
var queueTimes = []

var winsSelf = $('#wins').text();
var skillSelf = $('#skill').text();
var lostSelf = $('#lost').text();


window.odometerOptions = {
    duration: 1300,
    selector: '.stats-number'
};

function GamesLobby_simulateOther() {
    setTimeout(function () {
        $('#support').addClass('other-taken');
        $('#support').parent().addClass('role-taken');
        $('#support').find('.queue-est-text').text('role taken by')
        $('#support').find('.queue-est').text('AX.Aeon.피자')
        $('#support').parent().find('.queue-est').addClass('queue-est-taken');
        setTimeout(function () {
            $('#support').parent().addClass('locked-in');
            $('#support').addClass('role-ready');
            $('#support').parent().find('.queue-est-taken').addClass('queue-est-locked');
        }, 2200);
    }, 4200);
}


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


/* select role */
$(document.body).on('click', '.role-container', function () {
    var username = $('.squad-self-name').text();
    if ($(this).children().hasClass('other-taken')) {} else {
        queueTimes.push($(this).find('.queue-est').text());
        if (queueTimes.length > 2) {
            queueTimes.shift()
        };
        $('.self-taken').find('.queue-est-text').text('avg queue time');
        $('.self-taken').find('.queue-est').text(queueTimes[0]);
        $('.self-taken').removeClass('role-taken');
        $('.self-taken').removeClass('locked-in');
        $('.self-taken').removeClass('role-ready');
        $('.self-taken').removeClass('self-taken');
        $('.queue-est').removeClass('queue-est-taken')
        $('.queue-est').removeClass('queue-est-locked')
        $(this).addClass('role-taken');
        $(this).addClass('self-taken');
        $(this).find('.role-taken-img').attr('src', userImgSrc);
        $(this).find('.queue-est').text(username).addClass('queue-est-taken');
        $(this).find('.queue-est-text').text('role taken by');
        $('.lock-in-role').addClass('lock-in-ready');
    }
});

/* role lock in */
$(document.body).on('click', '.lock-in-role', function () {
    $('.self-taken').addClass('locked-in');
    $('.self-taken').addClass('role-ready');
    $('.queue-est-taken').addClass('queue-est-locked');
    $('.lock-in-ready').removeClass('lock-in-ready');
})

function GamesLobby_SwapChat() {
    $('.chat-group-active').removeClass('chat-group-active');
    $('#squad-chat').addClass('chat-group-active');
    $(".chat-scroll").load("feeds.php #")
    $('.chat-lobby-notification').text('You are now connected to the Lobby!')
}



$(document).on({
    mouseenter: function () {
        GamesLobby_userStatsUpdate();
    },
    mouseleave: function () {
        GamesLobby_userStatsReset();
    }
}, '.team-slot-taken');


/* Lobby display Functions */
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
            console.log('penis')

        }, 1);
    } else {
        setTimeout(function () { //will trigger twice on mouseup w/o timeout

            $('.lane-self-taken').removeClass('lane-self-taken lane-ava-visible')
            $(dis).find('.lane-self-preview').addClass('lane-ava-visible lane-self-taken').removeClass('lane-ava-preview');
            $('.lobby-lane').addClass('lobby-lane-taken');
            console.log('benis')

        }, 1);
    }
})
