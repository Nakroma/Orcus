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
        // Login error
        if (!this.userId) {
            throw new Meteor.Error('not-authorized');
        }

        squadCreate(this.userId);
    },

    // Creates a new squad invitation
    'squad.invite'(invite) {
        const userId = this.userId;

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
        if (squad.owner._id != userId) {
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
    },

    'squad.start_matchmaking'() {
        // Login error
        if (!this.userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(this.userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != this.userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Update status to 1
        Squads.update(user.squadId, { $set: {
            status: 1
        }});
    }

});


if (Meteor.isServer) {
    // Listen for login and create new squad
    UserStatus.events.on('connectionLogin', function(fields) {
        const user = Meteor.users.findOne(fields.userId);
        if (!user.hasOwnProperty('squadId')) {
            squadCreate(fields.userId);
        } else {
            // See if hes offline, if yes set him online
            console.log('someones logging in');
            const squad = Squads.findOne({_id: user.squadId});
            if (squad.owner._id == fields.userId) {
                // Is owner
                Squads.update({_id: user.squadId}, {$set: {
                    'owner.offline': false
                }});
            } else {
                // Is member
                Squads.update({_id: user.squadId, 'members._id': fields.userId}, {$set: {
                    'members.$.offline': false
                }});
            }
        }
    });

    // Relogging
    UserStatus.events.on('connectionLogout', function(fields) {
        // Set him to offline
        const user = Meteor.users.findOne(fields.userId);
        if (!user.status.online) {  // See if all connections are timed out
            console.log('someones logging out');
            const squad = Squads.findOne({_id: user.squadId});
            if (squad.owner._id == fields.userId) {
                // Is owner
                Squads.update({_id: user.squadId}, {$set: {
                    'owner.offline': true,
                    'owner.lastLogin': fields.logoutTime
                }});
            } else {
                // Is member
                Squads.update({_id: user.squadId, 'members._id': fields.userId}, {$set: {
                    'members.$.offline': true,
                    'members.$.lastLogin': fields.logoutTime
                }});
            }
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
    Meteor.publish('squadInvitations', function squadInvitePublication() {
        return SquadInvitations.find();
    });
}
