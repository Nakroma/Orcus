var username = $('.squad-self-name').text();
var queueTimes = []

setTimeout(function () {
    $('#support').addClass('role-taken other-taken');
    $('#support').siblings('.role-name').find('.queue-est').text('AX.Aeon.피자')
}, 8200);

function GamesLobby_selectRole() {
    if ($(this).hasClass('other-taken')) {} else {
        queueTimes.push($(this).siblings('.role-name').children('.queue-est').text());
        if (queueTimes.length > 2) {
            queueTimes.shift()
        };
        $('.self-taken').children('.role-name').children('.queue-est').text(queueTimes[0]);

        $('.self-taken').children('.role').removeClass('role-taken');
        $('.self-taken').removeClass('self-taken');
        $(this).addClass('role-taken');
        $(this).parent().addClass('self-taken');
        $(this).find('.role-taken-img').attr('src');
        $(this).siblings('.role-name').children('.queue-est').text(username);
    }
};

$('.role').click(GamesLobby_selectRole);
