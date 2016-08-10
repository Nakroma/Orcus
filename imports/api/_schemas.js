/*
 * Defines mongoDB schemas
 */

export const Schemas = {};

/* Schema whenever a user is referenced */
Schemas.UserData = new SimpleSchema({
    _id: {
        type: String,
        regEx: SimpleSchema.RegEx.Id
    },
    username: {
        type: String
    },
    avatar: {
        type: String
    }
});

/* Chat.js schema */
Schemas.Chat = new SimpleSchema({
    text: {
        type: String,
        label: 'Chat Message',
        max: 200
    },
    author: {
        type: Schemas.UserData,
        label: 'Author of the message'
    },
    createdAt: {
        type: Date,
        label: 'Date of creation',
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
    }
});

/* Squad.js schema */
Schemas.Squads = new SimpleSchema({
    owner: {
        type: Schemas.UserData,
        label: 'Owner of the squad'
    },
    members: {
        type: [Schemas.UserData],
        optional: true,
        minCount: 4,
        maxCount: 4,
        defaultValue: [
            {
                _id: '22222222222222222',
                username: '',
                avatar: ''
            },
            {
                _id: '22222222222222222',
                username: '',
                avatar: ''
            },
            {
                _id: '22222222222222222',
                username: '',
                avatar: ''
            },
            {
                _id: '22222222222222222',
                username: '',
                avatar: ''
            }
        ]
    },
    'members.$.empty': {
        type: Boolean,
        defaultValue: true
    },
    createdAt: {
        type: Date,
        label: 'Date of creation',
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
    }
});
