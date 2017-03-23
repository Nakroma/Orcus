import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';

import { Schemas } from './_schemas.js';
import { Squads } from './squad.js';

// Create lobby collection
export const Lobbies = new Mongo.Collection('lobbies');
Lobbies.attachSchema(Schemas.Lobbies);

// Publish
if (Meteor.isServer) {
    Meteor.publish('lobbies', function () {
        return Lobbies.find();
    });
}

// Methods
Meteor.methods({

    // Inverts ready status
    'lobby.ready'() {
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
        let roleObj = squad.roleSelection;

        // Find user role
        for (let i = 0; i < roleObj.length; i++) {
            if (roleObj[i].user._id == this.userId) {
                roleObj[i].ready = !roleObj[i].ready;
                break;
            }
        }

        // Update lobby
        Squads.update({_id: user.squadId}, {
            $set: { roleSelection: roleObj }
        });
    }

});