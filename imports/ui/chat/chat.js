import { Chat } from '../../api/chat.js';
import { Meteor } from 'meteor/meteor';
import { ReactiveDict } from 'meteor/reactive-dict';

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

/* Helper */
Template.partChat.helpers({
    // Returns all messages
    messages() {
        const roomNumber = Template.instance().state.get('room');
        let recId = '22222222222222222';
        if (roomNumber == 1)
            recId = Meteor.user().squadId;

        return Chat.find({
            room: roomNumber,
            receiveId: recId
        });
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
            room: 3,
            $or: [
                { 'author._id': user._id },
                { receiveId: user._id }
            ]
        }, { 'author': 1, receiveId: 1 });

        let privateArray = [];
        relevantPrivates.forEach(function(obj) { // Insert all names in an array
            if (obj.author._id != user._id) {
                const receiver = Meteor.users.findOne({_id: obj.receiveId});
                let pushObj = {};

                pushObj.id = obj.author._id;
                pushObj.username = obj.author.username;
                pushObj.desc = 'Main Menu';
                if (!isDuplicate(privateArray, pushObj.id))
                    privateArray.push(pushObj);

                pushObj.id = receiver._id;
                pushObj.username = receiver.username;
                pushObj.desc = 'Main Menu';
                if (!isDuplicate(privateArray, pushObj.id))
                    privateArray.push(pushObj);
            }
        });
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
        let roomNumber = 3;
        const id = event.currentTarget.id;

        if (id == 'all-chat')
            roomNumber = 0;
        if (id == 'squad-chat')
            roomNumber = 1;

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
    Meteor.call('chat.insert', target.val(), instance.state.get('room'));

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

function switchChatMenu() {
    const groups = $('.chat-groups');

    if (groups.hasClass('chat-groups-hidden')) {
        groups.removeClass('chat-groups-hidden');
    } else {
        groups.addClass('chat-groups-hidden');
        $('.pm-friend-input').focus();
    }
}