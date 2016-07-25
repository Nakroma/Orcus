import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';


// Create chat collection
export const Chat = new Mongo.Collection('chat');
Chat.attachSchema(Schemas.Chat);

// Publish
if (Meteor.isServer) {
    Meteor.publish('chat', function chatPublication() {
        return Chat.find({
            'createdAt': {
                $gte: new Date()
            }
        });
    });
}

// Methods
Meteor.methods({

    // Creates new chat message
    'chat.insert'(message) {
        check(message, String);

        // Login error
        if (!this.userId) {
            throw new Meteor.Error('not-authorized');
        }

        const user = Meteor.users.findOne(this.userId);
        
        // Insert message
        Chat.insert({
            text: message,
            author: {
                _id: this.userId,
                username: user.username,
                avatar: user.profile.avatar
            },
            createdAt: new Date()
        });
    }

});
