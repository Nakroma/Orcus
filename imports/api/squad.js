import { Meteor } from 'meteor/meteor';
import { Mongo } from 'meteor/mongo';
import { check } from 'meteor/check';

import { Schemas } from './_schemas.js';
import { Lobbies } from './lobby.js';

// Create squad collection
export const Squads = new Mongo.Collection('squads');
Squads.attachSchema(Schemas.Squads);

// Create squad invite collection
export const SquadInvitations = new Mongo.Collection('squadInvitations');
SquadInvitations.attachSchema(Schemas.SquadInvitations);


// Methods
Meteor.methods({

    // Creates new empty squad
    'squad.create'() {
        // Login error
        if (!this.userId) {
            throw new Meteor.Error('not-authorized');
        }

        squadCreate(this.userId);
    },

    // Creates a new squad invitation
    'squad.invite'(invite) {
        const userId = this.userId;

        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Get invited user by name
        const invitedUser = Meteor.users.findOne({
            username: invite
        });

        // User not found error
        if (!invitedUser) {
            throw new Meteor.Error('not-found-invited-user');
        }

        // Create new object for insertion
        const squadInviteObj = {
            invite: {
                _id: invitedUser._id,
                username: invitedUser.username,
                avatar: invitedUser.profile.avatar
            },
            squadId: squad._id,
            createdAt: new Date()
        };

        // Check object against schema
        check(squadInviteObj, Schemas.SquadInvitations);

        // Insert squad invitation
        SquadInvitations.insert(squadInviteObj);
    },

    // Initiates matchmaking
    'squad.start_matchmaking'() {
        changeMatchmakingStatus(this.userId, 1);
    },

    // Cancels matchmaking
    'squad.stop_matchmaking'() {
        changeMatchmakingStatus(this.userId, 0);
        resetRoles(this.userId);
    },

    // Selects a role
    'squad.role.select_role'(id) {
        selectRole(this.userId, id);
    },

    // Locks a role
    'squad.role.lock_role'() {
        lockRole(this.userId);
    },

    // Attempts to join users in another squad looking for members
    'squad.role.matchmaking'() {
        roleSelectionMatchmaking(this.userId);
    }

});


if (Meteor.isServer) {
    // Listen for login and create new squad
    UserStatus.events.on('connectionLogin', function(fields) {
        const user = Meteor.users.findOne(fields.userId);
        if (!user.hasOwnProperty('squadId')) {
            // TODO: Also do this when the squad the id is linking to doesn't exist anymore
            squadCreate(fields.userId);
        } else {
            // See if hes offline, if yes set him online
            console.log('someones logging in');
            const squad = Squads.findOne({_id: user.squadId});
            if (squad.owner._id == fields.userId) {
                // Is owner
                Squads.update({_id: user.squadId}, {$set: {
                    'owner.offline': false
                }});
            } else {
                // Is member
                Squads.update({_id: user.squadId, 'members._id': fields.userId}, {$set: {
                    'members.$.offline': false
                }});
            }
        }
    });

    // Relogging
    UserStatus.events.on('connectionLogout', function(fields) {
        // Set him to offline
        const user = Meteor.users.findOne(fields.userId);
        if (!user.status.online) {  // See if all connections are timed out
            console.log('someones logging out');
            const squad = Squads.findOne({_id: user.squadId});
            if (squad.owner._id == fields.userId) {
                // Is owner
                Squads.update({_id: user.squadId}, {$set: {
                    'owner.offline': true,
                    'owner.lastLogin': fields.logoutTime
                }});
            } else {
                // Is member
                Squads.update({_id: user.squadId, 'members._id': fields.userId}, {$set: {
                    'members.$.offline': true,
                    'members.$.lastLogin': fields.logoutTime
                }});
            }
        }
    });

    // Publishing
    Meteor.publish('squads', function () {
        return Squads.find();
    });
    Meteor.publish('squadInvitations', function () {
        return SquadInvitations.find();
    });
}

// Outsourced method for easier user
function squadCreate(userId) {
    if (Meteor.isServer) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Create new object for insertion
        const squadObj = {
            owner: {
                _id: userId,
                username: user.username,
                avatar: user.profile.avatar
            },
            createdAt: new Date()
        };

        // Check object against schema
        check(squadObj, Schemas.Squads);

        // Insert squad
        const squadId = Squads.insert(squadObj);

        // Change users squad id
        Meteor.users.update(userId, {
            $set: {
                squadId: squadId
            }
        });
    }
}
function changeMatchmakingStatus(userId, status) {
    if (Meteor.isServer) {
        check(status, Number);

        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Update status to 1
        Squads.update(user.squadId, {
            $set: {
                status: status
            }
        });
    }
}
function selectRole(userId, id) {
    if (Meteor.isServer) {
        check(id, Number);

        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Role already selected
        if (squad.roleSelection[id].selected) {
            throw new Meteor.Error('role-already-selected');
        }

        // New user
        const userObj = {
            _id: userId,
            username: user.username,
            avatar: user.profile.avatar
        };

        // Make new role selection
        let roleObj = squad.roleSelection;
        for (let i = 0; i < roleObj.length; i++) {  // Reset old selects
            if (roleObj[i].user._id == userId) {
                if (roleObj[i].selected && roleObj[i].locked) { // U already locked in boi
                    throw new Meteor.Error('role-already-locked');
                }
                roleObj[i].selected = false;
            }
        }
        roleObj[id].selected = true;    // Update new select
        roleObj[id].user = userObj;

        // Update status to selected
        Squads.update(user.squadId, {
            $set: { roleSelection: roleObj }
        });
    }
} // TODO: Account for going offline mid role selection
function lockRole(userId) {
    if (Meteor.isServer) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Go through roles
        let roleFound = false;
        let roleObj = squad.roleSelection;
        for (let i = 0; i < roleObj.length; i++) {
            if (roleObj[i].selected && (roleObj[i].user._id == userId)) {
                roleObj[i].locked = true;
                roleFound = true;
                break;
            }
        }

        // Not found
        if (!roleFound) {
            throw new Meteor.Error('not-role-selected');
        } else {
            // Update squads
            Squads.update(user.squadId, {
                $set: { roleSelection: roleObj }
            });
        }

        // If everyone is locked in, start queue
        let lockedPlayers = 0;
        for (let i = 0; i < roleObj.length; i++) {
            if (roleObj[i].selected && roleObj[i].locked) {
                lockedPlayers++;
            }
        }
        let members = 1; // Account for owner
        for (let i = 0; i < squad.members.length; i++) {
            if (!squad.members[i].empty) {
                members++;
            }
        }

        // Start queue
        if (lockedPlayers == members && members > 0) {
            // Update squads
            Squads.update(user.squadId, {
                $set: { status: 2 }
            });
        }
    }
}
function resetRoles(userId) {
    if (Meteor.isServer) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        const squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Reset everything
        let roleObj = squad.roleSelection;
        for (let i = 0; i < roleObj.length; i++) {
            roleObj[i].selected = false;
            roleObj[i].locked = false;
        }

        // Update status to 1
        Squads.update(user.squadId, {
            $set: { roleSelection: roleObj }
        });
    }
}
function roleSelectionMatchmaking(userId) {
    if (Meteor.isServer) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        let squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Count own squads open slots
        let emptySlots = 0;
        for (let i = 0; i < squad.members.length; i++) {
            if (squad.members[i].empty)
                emptySlots++;
        }

        // Team full? Search for lobby
        if (emptySlots == 0) {
            roleSelectionLobbyMatchmaking(userId);
            return;
        }

        // Get squads
        let allOpenSquads = Squads.find({
            status: 2
        });
        allOpenSquads = allOpenSquads.fetch();
        let potentialSquads = [];

        // Filter squads
        for (let i = 0; i < allOpenSquads.length; i++) {
            let lSquad = allOpenSquads[i];

            // Count empty slots
            let usedSlots = 1; // Account for owner
            for (let j = 0; j < lSquad.members.length; j++) {
                if (!lSquad.members[j].empty)
                    usedSlots++;
            }

            // If enough, check for roles
            if (usedSlots <= emptySlots) {
                // Check for roles
                let noDoubleSelection = true;
                for (let j = 0; j < squad.roleSelection.length; j++) {
                    // TODO: If you'd want, change the mm algorithm here
                    // If a role is double selected, view the squad as non-potential
                    if (squad.roleSelection[j].selected && lSquad.roleSelection[j].selected) {
                        noDoubleSelection = false;
                        break;
                    }
                }

                // If not double selected, add to potential squads
                if (noDoubleSelection)
                    potentialSquads.push(lSquad);
            }
        }

        // Merge both squads
        if (potentialSquads.length == 0) {
            throw new Meteor.Error('no-open-squad-found'); // TODO: Remove, maybe
        } else {
            let joinSquad = potentialSquads[0]; // TODO: idk select the longest open one or something, works fine for now
            // Merge users
            for (let i = -1; i < joinSquad.members.length; i++) { // Note that it goes from -1 to represent the owner
                if (i == -1 || !joinSquad.members[i].empty) {
                    for (let j = 0; j < squad.members.length; j++) {
                        if (squad.members[j].empty) {
                            // Replace user
                            if (i == -1) {
                                squad.members[j] = joinSquad.owner;
                                squad.members[j].empty = false;
                            } else {
                                squad.members[j] = joinSquad.members[i];
                            }
                            // Update users squad id
                            Meteor.users.update(squad.members[j]._id, {
                                $set: {
                                    squadId: squad._id
                                }
                            });
                            break;
                        }
                    }
                }
            }
            // Merge roles
            for (let i = 0; i < joinSquad.roleSelection.length; i++) {
                if (joinSquad.roleSelection[i].selected && !squad.roleSelection[i].selected) // Double check just for safety, you never know
                    squad.roleSelection[i] = joinSquad.roleSelection[i]
            }

            // Update merged squad, delete old one
            Squads.update(user.squadId, {
                $set: { members: squad.members, roleSelection: squad.roleSelection }
            });
            Squads.remove(joinSquad._id);
        }
    }
}
function roleSelectionLobbyMatchmaking(userId) {
    if (Meteor.isServer) {
        // Login error
        if (!userId) {
            throw new Meteor.Error('not-authorized');
        }

        // Get user
        const user = Meteor.users.findOne(userId);

        // Get squad
        let squad = Squads.findOne({
            _id: user.squadId
        });

        // Not owner error
        if (squad.owner._id != userId) {
            throw new Meteor.Error('not-squad-owner');
        }

        // Count all slots
        let ownSlots = 1;
        for (let i = 0; i < squad.members.length; i++) {
            if (!squad.members[i].empty) {
                ownSlots++;
            } else {
                throw new Meteor.Error('not-full-squad');
            }
        }

        // Get squads
        let allOpenSquads = Squads.find({
            status: 2
        });
        allOpenSquads = allOpenSquads.fetch();
        let potentialSquads = [];

        // Filter squads
        for (let i = 0; i < allOpenSquads.length; i++) {
            let lSquad = allOpenSquads[i];

            // Own squad
            if (lSquad._id == user.squadId)
                break;

            // Count squads slots
            let usedSlots = 1;
            for (let j = 0; j < lSquad.members.length; j++) {
                if (!lSquad.members[j].empty) {
                    usedSlots++;
                } else {
                    usedSlots = -1;
                    break;
                }
            }
            if (usedSlots == -1)
                break;

            // Assign
            if (usedSlots == ownSlots)
                potentialSquads.push(lSquad);
        }

        // Merge both squads into lobby
        if (potentialSquads.length == 0) {
            throw new Meteor.Error('no-open-squad-found'); // TODO: Remove, maybe
        } else {
            let joinSquad = potentialSquads[0]; // TODO: idk select the longest open one or something, works fine for now

            // Create lobby
            const lobbyObject = {
                squad1: user.squadId,
                squad2: joinSquad._id,
                createdAt: new Date()
            };
            const lobbyId = Lobbies.insert(lobbyObject);

            console.log("Squad " + user.squadId + " and Squad " + joinSquad._id + " joined in a lobby");

            // Update squads to be in lobby
            Squads.update(user.squadId, { $set: { lobbyId: lobbyId } });
            Squads.update(joinSquad._id, { $set: { lobbyId: lobbyId } });
            Squads.update(user.squadId, { $set: { status: 3 } });
            Squads.update(joinSquad._id, { $set: { status: 3 } });
        }
    }
}