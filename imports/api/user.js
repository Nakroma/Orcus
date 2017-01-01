if (Meteor.isServer) {
    // Attach schema to Meteor.users
    Schema = {};

    Schema.UserProfile = new SimpleSchema({
        avatar: {
            type: String,
            defaultValue: '/img/avatars/_default.png'
        }
    });

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
        'emails.$': {
            type: Object
        },
        'emails.$.address': {
            type: String,
            regEx: SimpleSchema.RegEx.Email
        },
        'emails.$.verified': {
            type: Boolean
        },
        profile: {
            type: Schema.UserProfile
        },
        squadId: {
            type: String,
            optional: true,
            regEx: SimpleSchema.RegEx.Id
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
        },
        // Status for meteor-user-status
        status: {
            type: Object,
            optional: true,
            blackbox: true
        }
    });

    Meteor.users.attachSchema(Schema.User);


    // Publish user data
    Meteor.publish('userData', function userDataPublication() {
        return Meteor.users.find({_id: this.userId}, {fields : {
            'squadId': 1,
            'profile': 1,
            'username': 1
        }})
    });
    Meteor.publish('users', function () {
        return Meteor.users.find({});
    })
}
