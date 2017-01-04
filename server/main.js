import '../imports/api/user.js';
import '../imports/api/chat.js';
import '../imports/api/squad.js';
import '../imports/api/lobby.js';
import '../imports/api/notifications.js';

import { Squads } from '../imports/api/squad.js';


/**
 * Easy Cron Jobs
 */

/* Cleans up squads and offline users */
/* TODO: Remove comment
let squadCleanup = new Cron(function() {
    // Go through offline users
    const offlineMembers = Squads.find({'members.offline': true});
    if (offlineMembers) {
        offlineMembers.forEach(function(sql) {
            for (let i=0; i<4; i++) {
                if (sql.members[i].offline && !sql.members[i].empty) {
                    const uId = sql.members[i]._id; // Don't ask, just referencing sql in the user update doesn't work
                    let mLastLogin = moment(sql.members[i].lastLogin);
                    let mMinuteOver = moment();
                    if (mLastLogin.add(1, 'm').isBefore(mMinuteOver)) {
                        // Get old array and modify it
                        let squadMembers = sql.members;
                        squadMembers[i].empty = true;
                        squadMembers[i]._id = '22222222222222222';
                        squadMembers[i].username = '_';
                        squadMembers[i].avatar = '_';
                        squadMembers[i].offline = false;

                        // TODO: Make role selection

                        // Update user
                        Meteor.users.update({_id: uId}, {$unset: {
                            squadId: ''
                        }});

                        // One minute passed since log off, update squad
                        Squads.update({_id: sql._id}, {$set: {
                            members: squadMembers
                        }});
                    }
                }

            }
        });
    }
}, {});*/
