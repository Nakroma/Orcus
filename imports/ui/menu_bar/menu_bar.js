import './menu_bar.html';


/* Events */
Template.partMenuBar.events({
    // Show play menu
    'click .menu-play'(event) {
        if ($(this).children().hasClass('cancel-text')) {
            //SocketClient_send('SQUAD_CANCEL_MATCHMAKING', []);
        } else {
            $('.queue-options').text('Find Match');
            $('.sidebar-queue-start').text('Find Match');
            showMatchFilters();
        }
    }
});


/* Custom functions */

function showMatchFilters() {   // Displays match filters on PLAY
    $('.sidebar-lobby-options').removeClass('filters-hidden');
    $('.content').css('transform', 'translateX(-12%)');
    $('.content-bg').css('transform', 'translateX(3%)');
    $('.sidebar-content-dim').addClass('dim-visible');
    $('.user-menu').css('opacity', '0');
}
export function hideMatchFilters() {   // Hides match filters
    $('.sidebar-lobby-options').addClass('filters-hidden');
    $('.content, .content-bg').css('transform', '');
    $('.sidebar-content-dim').removeClass('dim-visible');
    $('.user-menu').css('opacity', '1');
}