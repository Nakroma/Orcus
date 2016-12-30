import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';

import { Schemas } from './_schemas.js';

// Create lobby collection
export const Lobbies = new Mongo.Collection('lobbies');
Lobbies.attachSchema(Schemas.Lobbies);

// Publish
if (Meteor.isServer) {
    Meteor.publish('lobbies', function lobbyPublication() {
        return Lobbies.find();
    });
}