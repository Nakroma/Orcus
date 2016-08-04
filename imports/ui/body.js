import { Template } from 'meteor/templating';

import './squad/squad.js';
import './chat/chat.js';
import './main_content/main_content.js';
import './body.html';

Template.body.events({
    'click .sidebar-content-dim'(event) {
        const target = $(event.target);

        if (target.hasClass('dim-visible')) {
            target.removeClass('dim-visible');
            $('.chat').removeClass('chat-visible');
        }
    }
});
