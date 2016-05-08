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
        $('#support').addClass('role-taken other-taken');
        $('#support').siblings('.role-name').find('.queue-est').text('AX.Aeon.피자')
        setTimeout(function () {
            $('#support').siblings('.locked-in-helper').find('.locked-in-status').addClass('locked-in-visible');
            $('#support').addClass('role-ready');
        }, 1200);
    }, 5200);
}



function GamesLobby_selectRole() {
    var username = $('.squad-self-name').text();
    if ($(this).hasClass('other-taken')) {} else {
        queueTimes.push($(this).siblings('.role-name').children('.queue-est').text());
        if (queueTimes.length > 2) {
            queueTimes.shift()
        };
        $('.self-taken').children('.role-name').children('.queue-est').text(queueTimes[0]);

        $('.self-taken').children('.role').removeClass('role-taken');
        $('.self-taken').find('.locked-in-status').removeClass('locked-in-visible');
        $('.self-taken').find('.role').removeClass('role-ready');
        $('.self-taken').removeClass('self-taken');
        $(this).addClass('role-taken');
        $(this).parent().addClass('self-taken');
        $(this).find('.role-taken-img').attr('src', userImgSrc);
        $(this).siblings('.role-name').children('.queue-est').text(username);
        console.log(username);
    }
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




$('.role').click(GamesLobby_selectRole);

$('.lock-in-role').click(function () {
    $('.self-taken').find('.locked-in-status').addClass('locked-in-visible');
    $('.self-taken').find('.role').addClass('role-ready');
})

$(document).on({
    mouseenter: function () {
        GamesLobby_userStatsUpdate();
    },
    mouseleave: function () {
        GamesLobby_userStatsReset();
    }
}, '.team-slot-taken');
