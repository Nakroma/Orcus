import { Chat } from '../../api/chat.js';
import { Meteor } from 'meteor/meteor';

import './chat.html';

/* Created */
Template.partChat.onCreated(function chatOnCreated() {
    Meteor.subscribe('chat');
});

/* Helper */
Template.partChat.helpers({
    // Returns all messages
    messages() {
        return Chat.find();
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
    'keyup .chat-input-text'(event) {
        if (event.which === 13) {
            sendChatMessage();
        }
    },
    'click .send-ico'() {
        sendChatMessage();
    },

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

function sendChatMessage() {   // Handles chat messages
    const target = $('.chat-input-text');

    // Call function
    Meteor.call('chat.insert', target.val());

    // Clear input
    target.val('');
}