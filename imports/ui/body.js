import { Template } from 'meteor/templating';
import { hideMatchFilters } from './menu_bar/menu_bar.js';

import './menu_bar/menu_bar.js';
import './squad/squad.js';
import './notifications/notifications.js';
import './chat/chat.js';
import './main_content/main_content.js';
import './body.html';

Template.body.events({
    'click .sidebar-content-dim'(event) {
        const target = $(event.target);

        // Hide chat
        if (target.hasClass('dim-visible')) {
            target.removeClass('dim-visible');
            $('.chat').removeClass('chat-visible');
        }

        // Hide sidebar
        if ($('.sidebar-lobby-options').hasClass('filters-hidden')) {
            //
        } else {
            hideMatchFilters();
        }
    }
});
