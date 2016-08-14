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