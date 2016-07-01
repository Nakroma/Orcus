/*
 * Defines mongoDB schemas
 */

var Schemas = {};

Schemas.Chat = new SimpleSchema({
    text: {
        type: String,
        label: 'Chat Message',
        max: 200
    },
    owner: {
        type: String,
        label: 'Author userID',
        regEx: SimpleSchema.regEx.Id
    },
    username: {
        type: String,
        label: 'Author Username'
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