import { Mongo } from 'meteor/mongo';

// Create chat collection
export const Chat = new Mongo.Collection('chat');
Chat.attachSchema(Schemas.Chat);