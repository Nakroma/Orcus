import '../imports/api/user.js';
import '../imports/api/chat.js';
import '../imports/api/squad.js';
import '../imports/api/notifications.js';

import { Squads } from '../imports/api/squad.js';


/**
 * Easy Cron Jobs
 */

/* Cleans up squads and offline users */
var squadCleanup = new Cron(function() {
    // Go through offline users
    const offlineMembers = Squads.find({'members.offline': true});
}, {});