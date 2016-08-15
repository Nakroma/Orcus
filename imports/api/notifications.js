import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';
import { SquadInvitations } from './squad.js';
import { Squads } from './squad.js';

// Methods
Meteor.methods({

    'notification.accept'(notId) {
        /**
         * Error checking
         */

        check(notId, String);

        // Get notification
        const not = SquadInvitations.findOne(notId);
        const u = Meteor.users.findOne(this.userId);

        // Check if notification is actually for the user requesting it
        if ((this.userId != not.invite._id) || (!this.userId)) {
            throw new Meteor.Error('not-authorized');
        }

        // Get new squad
        const squad = Squads.findOne(not.squadId);

        // Check if squad exists
        if (!squad) {
            throw new Meteor.Error('squad-does-not-exist', "The squad you're trying to join doesn't exist anymore.");
        }

        // Check if squad is full
        var squadFull = true;
        for (var i = 0; i < 4; i++) {
            if (squad.members[i].empty) {
                squadFull = false;
                break;
            }
        }
        if (squadFull) {
            throw new Meteor.Error('squad-full', "The squad you're trying to join is already full.");
        }


        /**
         * Updating old Squad
         */

        // Get old squad
        const osq = Squads.findOne(u.squadId);

        if (osq) {
            if (osq.owner._id != this.userId) {
                // If member, update squad
                Squads.update({_id: u.squadId, 'members._id': this.userId}, {$set: {
                    'members.$.empty': true,
                    'members.$._id': '22222222222222222',
                    'members.$.username': '_',
                    'members.$.avatar': '_'
                }});
            } else {
                // TODO: Insert squad disband notification
                // If owner

                // See if members are left
                var membersLeft = false;
                var mPos;
                for (var i = 0; i < 4; i++) {
                    if (!osq.members[i].empty) {
                        membersLeft = true;
                        mPos = i;
                        break;
                    }
                }

                if (membersLeft) {
                    // If yes, make the next guy owner
                    const nextMember = osq.members[mPos];
                    Squads.update({_id: u.squadId, 'members.empty': false}, {$set: {
                        'members.$.empty': true,
                        'members.$._id': '22222222222222222',
                        'members.$.username': '_',
                        'members.$.avatar': '_'
                    }});
                    Squads.update({_id: u.squadId}, {$set: {
                        'owner._id': nextMember._id,
                        'owner.username': nextMember.username,
                        'owner.avatar': nextMember.avatar
                    }});
                } else {
                    // If not, delete squad
                    Squads.remove(u.squadId);
                }
            }
        }


        /**
         * Updating new Squad and cleaning up
         */

        // Update squad id of user
        Meteor.users.update(this.userId, {$set: {
            squadId: not.squadId
        }});

        // Put user in new squad
        Squads.update({_id: not.squadId, 'members.empty': true}, {$set: {
            'members.$.empty': false,
            'members.$._id': this.userId,
            'members.$.username': u.username,
            'members.$.avatar': u.profile.avatar
        }});

        // Remove notification
        SquadInvitations.remove(notId);
    }

});