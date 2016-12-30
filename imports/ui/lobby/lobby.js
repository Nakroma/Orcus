import { Lobbies } from '../../api/lobby.js';
import { Squads } from '../../api/squad.js';
import { Meteor } from 'meteor/meteor';

import './lobby.html';

/* Created */
Template.partLobby.onCreated(function () {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
    Meteor.subscribe('lobbies');
});

/* Helper */
Template.partLobby.helpers({
    // Returns squad data
    squad1() {
        return getSquad1();
    },
    squad2() {
        return getSquad2();
    }
});
Template.partLobbyTeamMember.helpers({
    // Checks if the id is the owner
    isOwner(id) {
        const lobby = getLobby();
        return (id == getSquad1().owner._id) || (id == getSquad2().owner._id);
    }
});

// Common functions for easier use
function getLobby() {
    const squad = Squads.findOne({
        _id: Meteor.user().squadId
    });
    return Lobbies.findOne({
        _id: squad.lobbyId
    }) ;
}
function getSquad1() {
    return Squads.findOne({
        _id: getLobby().squad1
    });
}
function getSquad2() {
    return Squads.findOne({
        _id: getLobby().squad2
    });
}