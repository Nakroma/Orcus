import { SquadInvitations } from '../../api/squad.js';
import { Meteor } from 'meteor/meteor';

import './notifications.html';

/* Created */
Template.partNotifications.onCreated(function notificationsOnCreated() {
    Meteor.subscribe('userData');
    Meteor.subscribe('squadInvitations');
});

/* Helpers */
Template.partNotifications.helpers({
    // Returns last three invitations
    invites() {
        return SquadInvitations.find({'invite._id': Meteor.user()._id}, {
            sort: {
                createdAt: 1
            },
            limit: 3
        });
    }
});

/* Events */
Template.partNotificationsInvite.events({

    // Call squad invite
    'click .bot-mid-notification-item'() {
        Meteor.call('notification.accept', this._id, function(err, result) {
            // TODO: Add proper error displaying
            alert(err.reason);
        });
    }

});