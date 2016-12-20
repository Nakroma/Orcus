import './role_lock.html';

/* Events */
Template.partRoleLock.events({
    'click .lock-in-role'(event) {
        Meteor.call('squad.role.lock_role');
    }
});