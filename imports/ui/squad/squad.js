import './squad.html';

/* Created */
Template.partSquad.onCreated(function squadOnCreated() {
    Meteor.subscribe('userData');
});

/* Helper */
Template.partSquad.helpers({
    // Returns user data
    userData() {
        return Meteor.user();
    }
});
