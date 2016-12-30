import { Template } from 'meteor/templating';
import { Squads } from '../api/squad.js';
import { hideMatchFilters } from './menu_bar/menu_bar.js';

import './menu_bar/menu_bar.js';
import './menu_bar/match_filters.js';
import './squad/squad.js';
import './lobby/lobby.js';
import './notifications/notifications.js';
import './chat/chat.js';
import './main_content/main_content.js';
import './role_selection/role_selection.js';
import './role_selection/role_lock.js';
import './role_selection/role_queue.js';
import './body.html';

/* Created */
Template.body.onCreated(function() {
    Meteor.subscribe('squads');
    Meteor.subscribe('userData');
});

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

// Global helper
UI.registerHelper('inMatchmaking', function() {
    const squad = Squads.findOne({
        _id: Meteor.user().squadId
    });
    return squad.status > 0;
});

// Global helper
UI.registerHelper('inSquadQueue', function() {
    const squad = Squads.findOne({
        _id: Meteor.user().squadId
    });
    return squad.status > 1;
});