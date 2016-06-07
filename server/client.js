/**
 * Created by Nakroma on 27.02.2016.
 */

// Websocket vars
var socket;
var username;
var userid;

// Squadfinding vars
var squadFrequency = 5000;
var squadInterval = 0;

// Other vars
var squadCurrentInvite = -1;

function SocketClient_init() {
    var host = "ws://127.0.0.1:9000/Orcus/server"; // SET THIS TO YOUR SERVER
    try {
        socket = new WebSocket(host);
        socket.onopen    = function(msg) {
            // NUR ZUSAGEN WENN SESSION ID GESETZT WURDE!!!!
            // NEEDS 'sid' passed!!!!!
            SocketClient_send('SESSIONID_SET', sid);
        };

        socket.onmessage = function(msg) {
            console.log(msg);

            var _prc = JSON.parse(msg['data']);

            switch (_prc.code) {

                /**
                 * Signals the successful setting of the session ID
                 *
                 * @argument Userdata JSON array containing user data (id, username)
                 */
                case 'SUCCESS_SESSIONID_SET':
                    username = _prc.args[0].username;
                    userid = _prc.args[0].id;
                    SocketClient_resetSquad();
                    break;


                /**
                 * Receives a chat message
                 *
                 * @argument Chat Lobby (ALL, SQUAD, PRIVATE)
                 * @argument Message (LZ-String compressed)
                 * @argument Author of the message
                 */
                case 'NOTICE_CHAT_RECEIVE_MESSAGE':
                    var user = _prc.args[2];
                    GamesChat_createPost(user.username, LZString.decompressFromUTF16(_prc.args[1]), user.id);
                    break;


                /**
                 * Signals the successful joining of a squad
                 *
                 * @argument JSON array containing 'info' and 'owner' bool for each member
                 */
                case 'SUCCESS_SQUAD_JOIN':
                    SocketClient_setSquadMembers(_prc.args[0]);
                    break;


                /**
                 * Signals the disbanding of the squad
                 */
                case 'NOTICE_SQUAD_DISBAND':
                    SocketClient_resetSquad();
                    break;

                /**
                 * Signals that a user left the squad
                 *
                 * @argument JSON array containing user data
                 */
                case 'NOTICE_SQUAD_LEFT':
                    SocketClient_removeSquadMember(_prc.args[0]);
                    break;

                /**
                 *  Signals a user if his invite was successful
                 *
                 *  @argument Was the invite successful? (True/False)
                 */
                case 'NOTICE_SQUAD_INVITE_USER':
                    if (_prc.args[0]) {
                        // Found user: Reset GVAR and hide input
                        GamesChat_Reset_Invite_Input();
                        GamesChat_subMenuSquadHide();
                    } else {
                        // Didnt find user: Reset GVAR and dipslay error
                        GamesChat_Reset_Invite_Input();
                        $('.squad-sub-options .squad-invite #squad-group-error').removeClass('error-hidden');
                    }
                    break;

                /**
                 *  Sends a squad invitation
                 *
                 *  @argument Squad ID
                 *  @argument Owner of the squad
                 */
                case 'NOTICE_SQUAD_INVITATION':
                    var oName = _prc.args[1].username;

                    // Set content
                    $('.squad-invite-notification-wr .squad-invite-title .invite-player').text(oName);
                    $('.squad-invite-preview .squad-invite-ava-self-inf .squad-invite-self-name').text(oName);

                    // Make invite visible
                    $('.squad-invite-wr.squad-invite-hidden').removeClass('squad-invite-hidden');

                    // Save squad id into variable
                    squadCurrentInvite = _prc.args[0];
                    break;

                /**
                 * Signals that a new user joined the squad
                 *
                 * @argument JSON array containing the user data
                 */
                case 'NOTICE_SQUAD_NEW_JOIN':
                    SocketClient_addSquadMember(_prc.args[0]);
                    break;

                /**
                 * Notifies the user that the join failed
                 *
                 * @argument Error message
                 */
                case 'ERROR_SQUAD_JOIN':
                    alert(_prc.args[0]); // TODO: Add better visuals
                    break;


                default:
                    console.log('Couldnt parse code: ' + _prc.code);
                    break;
            }
        };

        socket.onclose   = function(msg) {
            alert('Disconnected from server!');
        };
    }
    catch(ex){

    }
}

/**
 * Sends a message to the server
 * @param code Communication Code
 * @param args Array of arguments
 */
function SocketClient_send(code, args) {
    // Add code
    var json = '{ "code": "' + code + '", "args": [';

    // Checks if args is array, if not makes it one
    if (args.constructor !== Array) {
       args = [args];
    }

    // Add arguments
    for (var i = 0; i < args.length; i++) {
        if (typeof args[i] === 'number') {
            json += args[i];
        } else {
            json +=  '"' + args[i] + '"';
        }

        // Not last entry
        if (i != args.length -1) {
            json += ",";
        }
    }

    // Finish JSON and send to server
    json += ']}';
    try {
        socket.send(json);
    } catch(ex) {

    }
}

function SocketClient_quit(){
    if (socket != null) {
        socket.close();
        socket=null;
    }
}


/** User Functions **/

/**
 * Creates a new squad from scratch
 */
function SocketClient_resetSquad() {
    // TODO: Add visual message to let user know their squad was disbanded
    // Clean up all slots
    SocketClient_cleanSquad();

    // Insert you
    $('.squad .squad-ava-self .squad-ava-img-self').attr('src', 'bootstrap/img/avatars/' + userid.toString() + '_small.png');
    $('.squad .squad-ava-self-inf .squad-self-name').text(username);

    // Create new squad
    SocketClient_send('SQUAD_CREATE', 'lol');
}

/**
 * Sets everything to an empty player
 */
function SocketClient_cleanSquad() {
    var slotsTaken = $('.squad .squad-ava-wrapper .squad-ava.squad-slot-taken');

    slotsTaken.removeClass('squad-slot-taken');
    slotsTaken.html('');
}

/**
 * Adds a user to the squad
 * @param uObj JSON array
 */
function SocketClient_addSquadMember(uObj) {
    // Get wrapper
    var wrapper = $('.squad .squad-ava-wrapper .squad-ava:not(.squad-slot-taken)').first();

    // Change name and class
    wrapper.addClass('squad-slot-taken');
    wrapper.html("<img src='bootstrap/img/avatars/"+ uObj.id.toString() +"_small.png' class='squad-ava-img'>");
    $('.squad .squad-ava-self-inf .squad-self-name-alt:empty').first().text(uObj.username);
}

/**
 * Sets users in a squad
 * @param uObj JSON array
 */
function SocketClient_setSquadMembers(uObj) {
    // Set everything to an empty player.
    SocketClient_cleanSquad();

    for (var i = 0; i < uObj.length; i++) {
        if (uObj[i]['owner']) {
            // Add into owner tab
            $('.squad .squad-ava-self .squad-ava-img-self').attr('src', 'bootstrap/img/avatars/' + uObj[i]['info']['id'].toString() + '_small.png');
            $('.squad .squad-ava-self-inf .squad-self-name').text(uObj[i]['info']['username']);
        } else {
            var wrapper = $('.squad .squad-ava-wrapper .squad-ava:not(.squad-slot-taken)').first();

            // Change name and class
            wrapper.addClass('squad-slot-taken');
            wrapper.html("<img src='bootstrap/img/avatars/"+ uObj[i]['info']['id'] +"_small.png' class='squad-ava-img'>");
            $('.squad .squad-ava-self-inf .squad-self-name-alt:empty').first().text(uObj[i]['info']['username']);
        }
    }
}

/**
 * Removes a user in a squad
 * @param uObj JSON array
 */
function SocketClient_removeSquadMember(uObj) {
    // Select user
    var user = $('.squad .squad-ava-self-inf .squad-self-name-alt:contains("' + uObj + '")');
    var index = user.index(); // No -1 needed because :nth child is 1-indexed

    // Remove name
    user.text('');

    // Remove avatar
    $('.squad .squad-ava-wrapper .squad-ava:nth-child(' + index + ')').removeClass('squad-slot-taken');
    $('.squad .squad-ava-wrapper .squad-ava:nth-child(' + index + ')').html('');
}
