import { Chat } from '../../api/chat.js';
import { Meteor } from 'meteor/meteor';
import { ReactiveDict } from 'meteor/reactive-dict';
import { Session } from 'meteor/session';

import './chat.html';

/* Created */
Template.partChat.onCreated(function chatOnCreated() {
    Meteor.subscribe('chat');
    Meteor.subscribe('userData');
    Meteor.subscribe('users');

    // Saves current room
    this.state = new ReactiveDict();
    this.state.set('room', 0);
});

/* Rendered */
Template.partChatGroup.onRendered(function () {
    Session.set('chatRoomPrivateId', '');
});

/* Helper */
Template.partChat.helpers({
    // Returns all messages
    messages() {
        const roomNumber = Template.instance().state.get('room');
        let recId = '22222222222222222';

        if (roomNumber == 1)
            recId = Meteor.user().squadId;

        if (roomNumber != 2) {
            return Chat.find({
                room: roomNumber,
                receiveId: recId
            });
        } else {
            recId = Session.get('chatRoomPrivateId');
            let uId = Meteor.user()._id;

            // Returns all private messages between user and recId
            return Chat.find({
                room: roomNumber,
                $or: [
                    { $and: [
                        { receiveId: recId },
                        { 'author._id': uId }
                    ]},
                    { $and: [
                        { receiveId: uId },
                        { 'author._id': recId }
                    ]}
                ]
            });
        }
    },

    // Returns all online users
    onlineUsers() {
        return Meteor.users.find({
            "status.online": true
        }).count();
    },

    // Returns current room
    getRoom() {
        return Template.instance().state.get('room');
    },

    // Returns all private chat groups
    privateChatGroups() {
        const user = Meteor.user();
        const relevantPrivates = Chat.find({ // Gets all private messages which concern the user
            room: { $in: [2, 3]},
            $or: [
                { 'author._id': user._id },
                { receiveId: user._id }
            ]
        }, { 'author': 1, receiveId: 1, room: 1 });

        let privateArray = [];
        relevantPrivates.forEach(function(obj) { // Insert private recipients into an array
            const receiver = Meteor.users.findOne({_id: obj.receiveId});
            let pushObj = {};

            if (obj.author._id != user._id && obj.room != 3) {
                pushObj.id = obj.author._id;
                pushObj.username = obj.author.username;
                pushObj.desc = 'Main Menu';
                if (!isDuplicate(privateArray, pushObj.id))
                    privateArray.push(pushObj);
            }

            if (receiver._id != user._id) {
                pushObj.id = receiver._id;
                pushObj.username = receiver.username;
                pushObj.desc = 'Main Menu';
                if (!isDuplicate(privateArray, pushObj.id))
                    privateArray.push(pushObj);
            }
        });

        return privateArray;
    }
});
Template.partChatGroup.helpers({
    // Gets current private id
    getCurrentPrivateId() {
        return Session.get('chatRoomPrivateId');
    }
});


/* Events */
Template.partChat.events({
    // Show full chat
    'click .chat-input'(event) {
        const target = $('.chat');

        if (!target.hasClass('chat-visible')) {
            target.addClass('chat-visible');
            $('.sidebar-content-dim').addClass('dim-visible')
        }
    },

    // Send chat message
    'keyup .chat-input-text'(event, instance) {
        if (event.which === 13) {
            sendChatMessage(instance);
        }
    },
    'click .send-ico'(event, instance) {
        sendChatMessage(instance);
    },

    // Switch chat room
    'click .chat-group'(event, instance) {
        let roomNumber = 2;
        const id = event.currentTarget.id;
        Session.set('chatRoomPrivateId', '');

        if (id == 'all-chat')
            roomNumber = 0;
        if (id == 'squad-chat')
            roomNumber = 1;
        else
            Session.set('chatRoomPrivateId', this.id);

        instance.state.set('room', roomNumber);
    },

    // Scroll through chat rooms
    'wheel .chat-hrz-wr'(event) {
        event.preventDefault();
        const ev = event.originalEvent;
        const delta = Math.max(-1, Math.min(1, (ev.deltaY || -ev.detail)));
        event.currentTarget.scrollLeft -= (-delta * 60);
        console.log(event.currentTarget.scrollLeft);
    },
    'click .chat-arrow-left'() {
        document.getElementById('chat-hrz').scrollLeft -= 60;
    },
    'click .chat-arrow-right'() {
        document.getElementById('chat-hrz').scrollLeft += 60;
    },

    // New private chat
    'click .chat-menu-ico-wrapper'() {
        switchChatMenu();
    },
    'click .leave-squad'() {
        chatPrivateUser();
    },
    'keyup .pm-friend-input'(event) {
        if (event.which === 13) {
            chatPrivateUser();
        } else {
            const errMsg = $('#chat-group-error');

            if (!errMsg.hasClass('error-hidden')) {
                errMsg.addClass('error-hidden');
            }
        }
    }

});

/* Rendered */
Template.partChat.onRendered(function() {
    const scrollElement = $('.chat-scroll');

    scrollElement.animate({
        scrollTop: scrollElement.prop('scrollHeight')
    }, 0);
});

/* Display and scroll messages */
Template.partChatMessage.onRendered(function() {
    setTimeout(function() {
        $(this).css('opacity', '1');
    }, 1);

    const scrollElement = $('.chat-scroll');

    scrollElement.animate({
        scrollTop: scrollElement.prop('scrollHeight')
    }, 400);
});


/* Custom functions */

function sendChatMessage(instance) {   // Handles chat messages
    const target = $('.chat-input-text');

    // Call function
    Meteor.call('chat.insert', target.val(), instance.state.get('room'), Session.get('chatRoomPrivateId'));

    // Clear input
    target.val('');
}

function isDuplicate(array, id) { // Checks if object with a certain id already exists in array
    for (let i = 0; i < array.length; i++) {
        if (array[i].id == id)
            return true;
    }
    return false;
}

function switchChatMenu() { // Toggles chat group hide/show
    const groups = $('.chat-groups');

    if (groups.hasClass('chat-groups-hidden')) {
        groups.removeClass('chat-groups-hidden');
    } else {
        groups.addClass('chat-groups-hidden');
        $('.pm-friend-input').focus();
    }
}

function chatPrivateUser() {
    const target = $('.pm-friend-input');
    const errMsg = $('#chat-group-error');

    // Call function
    Meteor.call('chat.private_message', target.val(), function(error, result) {
        if (!error) {
            switchChatMenu();
            target.val('');
        } else {
            errMsg.removeClass('error-hidden');
        }
    });
}