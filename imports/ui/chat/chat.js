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
    getRoom() {
        return Template.instance().state.get('room');
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