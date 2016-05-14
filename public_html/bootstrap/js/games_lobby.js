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
        setTimeout(function () {
            $('#support').parent().addClass('locked-in');
            $('#support').addClass('role-ready');
        }, 2200);
    }, 4200);
}



function GamesLobby_selectRole() {
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
        $(this).addClass('role-taken');
        $(this).addClass('self-taken');
        $(this).find('.role-taken-img').attr('src', userImgSrc);
        $(this).find('.queue-est').text(username);
        $(this).find('.queue-est-text').text('role taken by');
        $('.lock-in-role').addClass('lock-in-ready');
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




$('.role-container').click(GamesLobby_selectRole);

$('.lock-in-role').click(function () {
    $('.self-taken').addClass('locked-in');
    $('.self-taken').addClass('role-ready');
})

$(document).on({
    mouseenter: function () {
        GamesLobby_userStatsUpdate();
    },
    mouseleave: function () {
        GamesLobby_userStatsReset();
    }
}, '.team-slot-taken');
