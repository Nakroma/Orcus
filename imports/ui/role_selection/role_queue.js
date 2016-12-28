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

/* On rendered MM helper */
Template.partRoleQueueHelper.onRendered(function () {
    const squad = Squads.findOne({ _id: Meteor.user().squadId });

    if (squad.owner._id == Meteor.user()._id) { // Call the matchmaking function every few seconds

        let squadQueueTimer = Meteor.setInterval(function () {
            const squad = Squads.findOne({ _id: Meteor.user().squadId });
            if (squad.status != 2) {
                Meteor.clearInterval(squadQueueTimer);
            } else {

                Meteor.call('squad.role.matchmaking')
            }
        }, 5000);
    }
});