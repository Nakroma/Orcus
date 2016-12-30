import { Lobbies } from '../../api/lobby.js';
import { Meteor } from 'meteor/meteor';

import './lobby.html';

/* Created */
Template.partLobby.onCreated(function () {
    Meteor.subscribe('lobbies');
});