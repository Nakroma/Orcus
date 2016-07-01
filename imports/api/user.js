// Attach schema to Meteor.users
Schema = {};
Schema.User = new SimpleSchema({
    // Optional because accounts-password does own validation
    username: {
        type: String,
        optional: true
    },
    emails: {
        type: Array,
        optional: true
    },
    "emails.$.address": {
        type: String,
        regEx: SimpleSchema.RegEx.Email
    },
    "emails.$.verified": {
        type: Boolean
    },
    createdAt: {
        type: Date,
        // Inserts date on creation
        autoValue: function() {
            if (this.isInsert) {
                return new Date();
            } else if (this.isUpsert) {
                return { $setOnInsert: new Date() };
            } else {
                this.unset(); // Prevents setting own date
            }
        }
    },
    // Needed for whatever reason for accounts packages
    services: {
        type: Object,
        optional: true,
        blackbox: true
    },
    // Global group for roles package
    roles: {
        type: Object,
        optional: true,
        blackbox: true
    },
    // In order to avoid an 'Exception in setInterval callback' from Meteor
    heartbeat: {
        type: Date,
        optional: true
    }
});

Meteor.users.attachSchema(Schema.User);