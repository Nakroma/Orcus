var queueTimes = []

var userAvaSrc = 'bootstrap/img/ava_sample_4.png';

var winsSelf = $('#wins').text();
var skillSelf = $('#skill').text();
var lostSelf = $('#lost').text();




/* role selection */


function GamesLobby_selectRole(username, userImgSrc, role, type) {

    role = $(role).parent();
    if (type === 'own') {

        if ($(role).hasClass('other-taken')) {} else {
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
            $(role).find('.role-p-sub').addClass('role-taken self-taken');
            $(role).addClass('role-preview');
            $(role).find('.role-taken-img').attr('src', userImgSrc);
            $(role).find('.queue-est').text(username).addClass('queue-est-taken');
            $(role).find('.queue-est-text').text('role taken by');
            $('.lock-in-role').addClass('lock-in-ready');
            $('.roles-drag-note').addClass('invis');
        }
    } else {
        $(role).find('.role-p-sub').addClass('role-taken other-taken');
        //$(role).addClass('role-preview');
        $(role).find('.role-taken-img').attr('src', userImgSrc);
        $(role).find('.queue-est').text(username).addClass('queue-est-taken');
        $(role).find('.queue-est-text').text('role taken by');
    }
}

function GamesLobby_removeRole(username) {
    // Find role by username
    $('.role-taken .queue-est').filter(function () {
        return $(this).text() === username;
    }).text(queueTimes[0]).removeClass('queue-est-taken').parent().removeClass('role-taken').removeClass('other-taken');
}

$(document.body).on('click', '.role-p-s', function () {
    if (!$('.self-taken').hasClass('locked-in')) {
        var role = '#' + $(this).find('.role-p-sub').attr('id');
        //SocketClient_send('SQUAD_SELECT_ROLE', [role]);
        GamesLobby_selectRole('TotalBiscuit', 'bootstrap/img/ava_sample_4.png', role, 'own')
    }
});








/* role lock in & load lobby */
$(document.body).on('click', '.lock-in-role', function () {
    // Lock in role
    if (!$('.self-taken').hasClass('locked-in')) {
        //SocketClient_send('SQUAD_LOCK_ROLE', []);
    }
    GamesLobby_LockInRole();
    GamesLobby_StartQueue()
});



function GamesLobby_LockInRole(role) {
    $(role).addClass('locked-in role-ready');
    $(role).find('.queue-est').addClass('queue-est-locked');
    $(role).find('.lock-in-ready').removeClass('lock-in-ready');
}



function GamesLobby_StartQueue(slots) {
    // Adjust slots
    var queue_slot = $('.lobby-queue-players .lobby-queue-ava');
    var single = queue_slot.first();
    if (queue_slot.length != slots && slots > 0) {
        if (queue_slot.length < slots) {
            for (var i = queue_slot.length; i < slots; i++) {
                queue_slot.parent().append("<div class='lobby-queue-ava lobby-queue-ava-free'><img src='' class='lobby-queue-img invis'></div>");
            }
        } else if (queue_slot.length > slots) {
            for (var i = queue_slot.length; i > slots; i--) {
                console.log("lamo");
                $('.lobby-queue-players .lobby-queue-ava:last-child').remove();
            }
        }

    }

    // Gradient
    $('.lock-in-role').addClass('locked-in-done')
    $('#role-text').removeClass('lobby-title-visible')
    $('#queue-text, .lobby-queue-players').addClass('lobby-title-visible')

    // Add leader img
    var img = $('.squad-ava-self .squad-ava-img-self').attr('src');
    $('.lobby-queue-ava-free:first-of-type').removeClass('lobby-queue-ava-free').find('.lobby-queue-img').attr('src', img).removeClass('invis');

    // Add team img
    $('.squad-ava-wrapper .squad-slot-taken .squad-ava-img').each(function() {
        img = $(this).attr('src');
        $('.lobby-queue-ava-free').first().removeClass('lobby-queue-ava-free').find('.lobby-queue-img').attr('src', img).removeClass('invis');
    });

    // Add Random img for simulation
    /*
    var time = 1000;
    $('.lobby-queue-ava-free').each(function () {
        setTimeout(function () {
            $('.lobby-queue-ava-free').removeClass('lobby-queue-ava-free').find('.lobby-queue-img').attr('src', 'bootstrap/img/ava_default.png').removeClass('invis');

            // Display user's role
            GamesLobby_selectRole('Benis', 'bootstrap/img/ava_default.png', '#jungle', 'other')
            GamesLobby_selectRole('Benis', 'bootstrap/img/ava_default.png', '#carry', 'other')
            GamesLobby_selectRole('Benis', 'bootstrap/img/ava_default.png', '#top', 'other')
            GamesLobby_selectRole('Benis', 'bootstrap/img/ava_default.png', '#mid', 'other')
        }, 1000);

    })

    // Call Lobby When done
    GamesLobby_StartLobby();
    */
}



function GamesLobby_StartLobby() {
    $(lobbyData["Lobby-5"]).insertAfter($('.lobby-wr'));
    setTimeout(function () {
        $('#queue-text, .lobby-queue-players').removeClass('lobby-title-visible')
        $('#lobby-text').addClass('lobby-title-visible')
        $('.pick-a-role').addClass('par-hidden')
        setTimeout(function () {
            $('.lobby-content').css('opacity', '1');
        }, 1);
    }, 2000);
}



function GamesLobby_SwapChat() {
    $('.chat-group-active').removeClass('chat-group-active');
    $('#squad-chat').addClass('chat-group-active');
}









/* Lane Selection */

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

$(document.body).on('click', '.top-lane, .bot-lane, .mid-lane', GamesLobby_SelectLane);

function GamesLobby_SelectLane() {
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
}

$(".sidebar-queue-start, .sidebar-list-link-game").click(function () {
    // Initiate role selection
    //SocketClient_send('SQUAD_START_MATCHMAKING', [['AP', 5, 50]]);

    // Get into role selection
    //GamesLobby_StartRoleSelection.call($(this));
});

function GamesLobby_StartRoleSelection() {
    var sidebar = $(".sidebar-queue-start, .sidebar-list-link-game");
    if (sidebar.hasClass('queue-ready') || sidebar.hasClass('sidebar-list-link-game')) {
        GamesLeague_queueStartTransforms();
        GamesLeague_HideMatchFilters();
        GamesLeague_queueLoadLobby();
        $(lobbyData["Lobby Role"]).insertAfter($('.lobby-wr'));
        setTimeout(function () {
            GamesLobby_Roles();
        }, 500);
        clearInterval(galleryLoop);
        GamesLobby_SwapChat();
    } else {};
}
