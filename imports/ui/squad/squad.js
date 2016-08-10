import { Squads } from '../../api/squad.js';

import './squad.html';

/* Created */
Template.partSquad.onCreated(function squadOnCreated() {
    Meteor.subscribe('userData');
    Meteor.subscribe('squads');
});

/* Helper */
Template.partSquad.helpers({
    // Returns user data
    squad() {
        return Squads.findOne({
            _id: Meteor.user().squadId
        });
    }
});
