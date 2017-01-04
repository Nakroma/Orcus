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
    'chat.insert'(message, room) {
        check(message, String);
        check(room, Number);

        // Login error
        if (!this.userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(this.userId);

        // Room checking
        let id = '22222222222222222';
        switch (room) {
            case 1:
                id = user.squadId;
                break;

            default:
                break;
        }

        // Create new object for insertion
        const chatObj = {
            text: message,
            author: {
                _id: this.userId,
                username: user.username,
                avatar: user.profile.avatar
            },
            room: room,
            receiveId: id,
            createdAt: new Date()
        };

        // Check object against schema
        check(chatObj, Schemas.Chat);

        // Insert message
        Chat.insert(chatObj);
    }

});
