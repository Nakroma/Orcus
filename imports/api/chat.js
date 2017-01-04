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

        insertChatMessage(user, message, room, id);
    },

    // New private message
    'chat.private_message'(receiver) {
        const userId = this.userId;

        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get messaged user by name
        const messagedUser = Meteor.users.findOne({
            username: receiver
        });

        // User not found error
        if (!messagedUser) {
            throw new Meteor.Error('not-found-invited-user');
        }

        // Pseudo message
        insertChatMessage(user, 'PSEUDO_GROUP_START_MESSAGE', 3, messagedUser._id);
    }

});

function insertChatMessage(user, message, room, id) {
    if (Meteor.isServer) {
        // Create new object for insertion
        const chatObj = {
            text: message,
            author: {
                _id: user._id,
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
}