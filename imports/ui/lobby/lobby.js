import { Lobbies } from '../../api/lobby.js';
import { Squads } from '../../api/squad.js';
import { Meteor } from 'meteor/meteor';
import { Session } from 'meteor/session';

import './lobby.html';

/* Created */
Template.partLobby.onCreated(function () {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
    Meteor.subscribe('lobbies');

    Session.set('lobbySelectedPlayerHovered', false);
});

/* Helper */
Template.partLobby.helpers({
    // Returns squad data
    squad1() {
        return getSquad1();
    },
    squad2() {
        return getSquad2();
    },
    squad1ready() {
        return getReadies(getSquad1());
    },
    squad2ready() {
        return getReadies(getSquad2());
    }
});
Template.partLobbySelectedPlayer.helpers({
    // Returns the currently selected player
    current() {
        if (!Session.get('lobbySelectedPlayerHovered')) {
            const squad = Squads.findOne({
                _id: Meteor.user().squadId
            });
            let obj = Meteor.user();
            obj.avatar = obj.profile.avatar;
            for (let i = 0; i < squad.roleSelection.length; i++) {
                if (squad.roleSelection[i].user._id == Meteor.user()._id) {
                    obj.ready = squad.roleSelection[i].ready;
                    break;
                }
            }
            return obj;
        } else {
            return Session.get('lobbySelectedPlayer');
        }
    }
});
Template.partLobbyTeamMember.helpers({
    // Checks if the id is the owner
    isOwner(id) {
        const lobby = getLobby();
        return (id == getSquad1().owner._id) || (id == getSquad2().owner._id);
    }
});

/* Events */
Template.partLobbySelectedPlayer.events({
    // Ready up
    'click .player-side-ready-up'() {
        Meteor.call('lobby.ready');
    }
});
Template.partLobbyTeamMember.events({
    'mouseenter .lobby-player'(event, instance) {
        let obj = instance.data.role.user;
        obj.ready = instance.data.role.ready;
        Session.set('lobbySelectedPlayer', obj);
        Session.set('lobbySelectedPlayerHovered', true);
    },
    'mouseleave .lobby-player'() {
        Session.set('lobbySelectedPlayerHovered', false);
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
function getReadies(squad) {
    const roles = squad.roleSelection;
    let rdy = 0;
    for (let i = 0; i < roles.length; i++) {
        if (roles[i].ready)
            rdy++;
    }
    return rdy;
}