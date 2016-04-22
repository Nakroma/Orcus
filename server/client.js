/**
 * Created by Nakroma on 27.02.2016.
 */

// Websocket vars
var socket;
var username;

// Squadfinding vars
var squadFrequency = 5000;
var squadInterval = 0;

function SocketClient_init() {
    var host = "ws://127.0.0.1:9000/Orcus/server"; // SET THIS TO YOUR SERVER
    try {
        socket = new WebSocket(host);
        socket.onopen    = function(msg) {
            // NUR ZUSAGEN WENN SESSION ID GESETZT WURDE!!!!
            // NEEDS 'sid' passed!!!!!
            socket.send('SESSIONID_SET|' + sid);
            socket.send('SQUAD_CREATE|lol');
        };

        socket.onmessage = function(msg) {
            console.log(msg);
            var p = msg['data'].split('|');
            switch (p[0]) {
                case 'S':
                    switch(p[1]) {
                        case 'SESSIONID_SET':
                            var user = JSON.parse(p[2]);
                            username = user.username;
                            break;

                        case 'SQUAD_JOIN':
                            SocketClient_findSquad('stop');
                            GamesLeague_queueQuit(); // Visual

                            var user = JSON.parse(p[2]);
                            SocketClient_setSquadMembers(user);
                            break;

                        default:
                            break;
                    }
                    break;

                case 'N':
                    switch (p[1]) {
                        case 'SQUAD_JOINED':
                            var user = JSON.parse(p[2]);
                            SocketClient_addSquadMember(user);
                            break;

                        case 'SQUAD_LEFT':
                            var user = JSON.parse(p[2]);
                            SocketClient_removeSquadMember(user);
                            break;

                        case 'SQUAD_DISBAND':
                            SocketClient_resetSquad();
                            break;

                        case 'CHAT_RECEIVE_MESSAGE':
                            var user = JSON.parse(p[4]);
                            GamesChat_createPost(user.username, LZString.decompress(p[3]));
                            break;

                        default:
                            break;
                    }
                    break;

                default:
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

function SocketClient_send(msg){
    if(!msg) {
        alert("Message can not be empty");
        return;
    }
    try {
        socket.send(msg);
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

// Initiates a squad searching loop
function SocketClient_findSquad(k) {
    switch (k) {
        case 'start':
            squadInterval = setInterval(function(){
                socket.send('SQUAD_SEARCH|lol');
            }, squadFrequency);
            break;

        case 'stop':
        default:
            clearInterval(squadInterval);
            break;
    }
}

// Creates a new squad and displays it visually
function SocketClient_resetSquad() {
    // TODO: Add visual message to let user know their squad was disbanded
    // Clean up all slots
    SocketClient_cleanSquad();

    // Insert you
    var avatar = $('.squad-wrapper .squad-ava-wrapper .squad-ava').first();
    avatar.switchClass('squad-ava', 'squad-ava-self', 0);
    avatar.html("<a class='squad-name'><img src='bootstrap/img/lobby_host.svg' class='lobby-host'>" + username + "</a>");

    // Create new squad
    socket.send('SQUAD_CREATE|lol');
}

// Adds a user to the squad
function SocketClient_addSquadMember(uObj) {
    // Get wrapper
    var wrapper = $('.squad-wrapper .squad-ava-wrapper .squad-ava').first();

    // Change name and class
    wrapper.html("<a class='squad-name'>" + uObj.username + "</a>");
    wrapper.switchClass('squad-ava', 'squad-ava-other-1');
}

// Sets users in a squad
function SocketClient_setSquadMembers(uObj) {
    // Set everything to an empty player.
    SocketClient_cleanSquad();

    // Insert the avatars
    var owner;
    for (var i = 0; i < uObj.length; i++) {
        // Select the first free avatar
        var avatar = $('.squad-wrapper .squad-ava-wrapper .squad-ava').first();

        // Insert user
        if (uObj[i].owner) {
            avatar.switchClass('squad-ava', 'squad-ava-self', 0);
            avatar.html("<a class='squad-name'><img src='bootstrap/img/lobby_host.svg' class='lobby-host'>" + uObj[i].username + "</a>");
            owner = uObj[i].id;
        } else {
            avatar.switchClass('squad-ava', 'squad-ava-other-1', 0);
            avatar.html("<a class='squad-name'>" + uObj[i].username + "</a>");
        }
    }

    // Hide lock if not owner (technically not necessary but maybe I want the function called not only on join somewhere)
    if (owner != sid) {
        $('.squad-helper').fadeOut();
    }
}

// Removes a user in a squad
function SocketClient_removeSquadMember(uObj) {
    // Remove squad member
    $('.squad-wrapper .squad-ava-wrapper .squad-ava-other-1 .squad-name').filter(function () {
        return $(this).text() === uObj.username;
    }).parent().parent().remove();

    // Add empty squad slot
    $('.squad-wrapper .squad-ava-wrapper').last().after("<div class='squad-ava-wrapper'><div class='squad-ava'><a class='squad-name-blank'>Click to add player</a></div></div>");
}

// Sets everything to an empty player
function SocketClient_cleanSquad() {
    var wrapper = $('.squad-wrapper .squad-ava-wrapper .squad-ava-self, .squad-wrapper .squad-ava-wrapper .squad-ava-other-1');
    wrapper.switchClass('squad-ava-self', 'squad-ava', 0);
    wrapper.switchClass('squad-ava-other-1', 'squad-ava', 0);
    wrapper.html("<a class='squad-name-blank'>Click to add player</a>");
}

// Changes the lock state
function SocketClient_squadStatecheck() {
    if (document.getElementById('checkbox-switch').checked) {
        socket.send('SQUAD_LOCK_CHANGE|true');
    } else {
        socket.send('SQUAD_LOCK_CHANGE|false');
    }
}