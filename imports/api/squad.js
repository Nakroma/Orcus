import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';

// Create squad collection
export const Squads = new Mongo.Collection('squads');
Squads.attachSchema(Schemas.Squads);

// Create squad invite collection
export const SquadInvitations = new Mongo.Collection('squadInvitations');
SquadInvitations.attachSchema(Schemas.SquadInvitations);


// Methods
Meteor.methods({

    // Creates new empty squad
    'squad.create'() {
        squadCreate(this.userId);
    },

    // Creates a new squad invitation
    'squad.invite'(invite) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner.id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Get invited user by name
        const invitedUser = Meteor.users.findOne({
            username: invite
        });

        // User not found error
        if (!invitedUser) {
            throw new Meteor.Error('not-found-invited-user');
        }

        // Create new object for insertion
        const squadInviteObj = {
            invite: {
                _id: invitedUser._id,
                username: invitedUser.username,
                avatar: invitedUser.profile.avatar
            },
            squadId: squad._id,
            createdAt: new Date()
        };

        // Check object against schema
        check(squadInviteObj, Schemas.SquadInvitations);

        // Insert squad invitation
        SquadInvitations.insert(squadInviteObj);
    }

});


if (Meteor.isServer) {
    // Listen for login and create new squad
    UserStatus.events.on('connectionLogin', function(fields) {
        if (!Meteor.users.findOne(fields.userId).hasOwnProperty('squadId')) {
            squadCreate(fields.userId);
        }
    });

    // Outsourced method for easier user
    function squadCreate(userId) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Create new object for insertion
        const squadObj = {
            owner: {
                _id: userId,
                username: user.username,
                avatar: user.profile.avatar
            },
            createdAt: new Date()
        };

        // Check object against schema
        check(squadObj, Schemas.Squads);

        // Insert squad
        const squadId = Squads.insert(squadObj);

        // Change users squad id
        Meteor.users.update(userId, {
            $set: {
                squadId: squadId
            }
        });
    }

    // Publishing
    Meteor.publish('squads', function squadPublication() {
        return Squads.find();
    });
}
