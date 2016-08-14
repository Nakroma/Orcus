import { Squads } from '../../api/squad.js';

import './squad.html';

/* Created */
Template.partSquad.onCreated(function squadOnCreated() {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
});

/* Helper */
Template.partSquad.helpers({
    // Returns user data
    squad() {
        return Squads.findOne({
            _id: Meteor.user().squadId
        });
    }
});

/* Events */
Template.partSquad.events({
    // Show invite menu on click
    'click .squad-ava, click .squad-menu-ico-wr'(event) {
        const target = $('.squad');
        const menu = $('.squad-ava-self-inf');

        if (target.hasClass('squad-hidden')) {
            target.removeClass('squad-hidden');
            menu.css('opacity', 1);
        } else {
            target.addClass('squad-hidden');
            $('.squad-inv-input').focus();
            menu.css('opacity', '0');
        }
    },

    // Invite user to squad
    'click .leave-squad'(event) {
        inviteUser();
    },
    'keyup .squad-inv-input'(event) {
        if (event.which === 13) {
            inviteUser();
        }
    }
});


/* Custom functions */

function inviteUser() { // Handles squad invitations
    const target = $('.squad-inv-input');

    // Call function
    Meteor.call('squad.invite', target.val());

    // TODO: Debug this shit
    target.val('');
}