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
    },

    // For relogging purposes
    offline: {
        type: Boolean,
        optional: true,
        defaultValue: false
    },
    lastLogin: {
        type: Date,
        optional: true
    }
});

/* Schema for role selection */
Schemas.SingleRole = new SimpleSchema({
    selected: {
        type: Boolean,
        defaultValue: false
    },
    user: {
        type: Schemas.UserData
    },
    title: {
        type: String,
        optional: true,
        defaultValue: "UNDEFINED"
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
    status: {
        // 0: Normal, 1: Looking for mates, 2: Looking for lobby
        type: SimpleSchema.Integer,
        optional: true,
        defaultValue: 0
    },
    members: {
        type: [Schemas.UserData],
        optional: true,
        minCount: 4,
        maxCount: 4,
        defaultValue: [
            {
                _id: '22222222222222222',
                username: '_',
                avatar: '_'
            },
            {
                _id: '22222222222222222',
                username: '_',
                avatar: '_'
            },
            {
                _id: '22222222222222222',
                username: '_',
                avatar: '_'
            },
            {
                _id: '22222222222222222',
                username: '_',
                avatar: '_'
            }
        ]
    },
    'members.$.empty': {
        type: Boolean,
        defaultValue: true
    },
    roleSelection: {
        type: [Schemas.SingleRole],
        optional: true,
        minCount: 5,
        maxCount: 5,
        defaultValue: [ // 0->4, Jungler -> Support -> Carry -> Top -> Mid
            {
                selected: false,
                user: {
                    _id: '22222222222222222',
                    username: '_',
                    avatar: '_'
                },
                title: "Jungler"
            },
            {
                selected: false,
                user: {
                    _id: '22222222222222222',
                    username: '_',
                    avatar: '_'
                },
                title: "Support"
            },
            {
                selected: false,
                user: {
                    _id: '22222222222222222',
                    username: '_',
                    avatar: '_'
                },
                title: "Carry"
            },
            {
                selected: false,
                user: {
                    _id: '22222222222222222',
                    username: '_',
                    avatar: '_'
                },
                title: "Top"
            },
            {
                selected: false,
                user: {
                    _id: '22222222222222222',
                    username: '_',
                    avatar: '_'
                },
                title: "Mid"
            }
        ]
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

/* Squad.js Invitation schema */
Schemas.SquadInvitations = new SimpleSchema({
    invite: {
        type: Schemas.UserData,
        label: 'Person to invite'
    },
    squadId: {
        type: String,
        regEx: SimpleSchema.RegEx.Id
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

/* Matchmaking Lobby schema */
Schemas.Lobbies = new SimpleSchema({
    squad1: {
        type: String,
        regEx: SimpleSchema.RegEx.Id
    },
    squad2: {
        type: String,
        regEx: SimpleSchema.RegEx.Id
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
