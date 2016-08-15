import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';
import { SquadInvitations } from './squad.js';
import { Squads } from './squad.js';

// Methods
Meteor.methods({

    'notification.accept'(notId) {
        check(notId, String);

        // Get notification
        const not = SquadInvitations.findOne(notId);

        // Check if notification is actually for the user requesting it
        if ((this.userId != not.invite._id) || (!this.userId)) {
            throw new Meteor.Error('not-authorized');
        }

        // Update squad id of user
        Meteor.users.update(this.userId, {$set: {
            squadId: not.squadId
        }});

        // Delete old squad space

        // Remove notification
        SquadInvitations.remove(notId);
    }

});