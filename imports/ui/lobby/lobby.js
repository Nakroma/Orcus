import { Lobbies } from '../../api/lobby.js';
import { Meteor } from 'meteor/meteor';

import './lobby.html';

/* Created */
Template.partChat.onRendered(function () {
    Meteor.subscribe('lobbies');
});