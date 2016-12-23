import { Squads } from '../../api/squad.js';

import './role_queue.html';

/* Created */
Template.partRoleQueue.onCreated(function squadOnCreated() {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
});

/* Helper */
Template.partRoleQueue.helpers({
    // Returns user data
    squad() {
        return Squads.findOne({
            _id: Meteor.user().squadId
        });
    }
});