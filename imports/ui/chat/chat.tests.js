/**
 * Created by Nakroma on 14.03.2017.
 * Unit test for the chat component.
 */

/* eslint-env mocha */

import { Factory } from 'meteor/dburles:factory';
import { chai } from 'meteor/practicalmeteor:chai';
import { Meteor } from 'meteor/meteor';
import { Chat } from '../../api/chat.js';

import { withRenderedTemplate } from '../test-helpers.js';
import './chat.js';

describe('Chat', function() {
    beforeEach(function () {
        Template.registerHelper('_', key => key);
    });
    afterEach(function () {
        Template.deregisterHelper('_');
    });

    it('renders correctly with simple data', function() {
        const user = Factory.build('user', {
            username: 'Test username',
            profile: {
                avatar: '/img/avatars/_default.png'
            },
        });
        const chat = Factory.build('chat', {
            text: 'Some random test string',
            author: {
                _id: user._id,
                username: user.username,
                avatar: user.profile.avatar,
            },
            room: 0,
        });
        const data = {
            chat: Chat._transform(chat),
            onEditingChange: () => 0,
        };

        withRenderedTemplate('Chat', data, el => {
            chai.assert.equal($(el).find('.sidebar-chat-username').text(), chat.author.username);
            chai.assert.equal($(el).find('.sidebar-chat-message').text(), chat.text);
            chai.assert.equal($(el).find('.chat-ava-img').attr('src'), chat.author.avatar);
        });
    });
});

