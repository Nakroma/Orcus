import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';

// Create squad collection
export const Squads = new Mongo.Collection('squads');
Squads.attachSchema(Schemas.Squads);


// Methods
Meteor.methods({

    // Creates new empty squad
    'squad.create'() {
        squadCreate(this.userId);
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
