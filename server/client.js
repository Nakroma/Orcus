/**
 * Created by Nakroma on 27.02.2016.
 */

// Websocket vars
var socket;

// Squadfinding vars
var squadFrequency = 5000;
var squadInterval = 0;

function init() {
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
                        case 'SQUAD_JOIN':
                            findSquad('stop');
                            queueQuit(); // Visual
                            break;

                        default:
                            break;
                    }
                    break;

                case 'N':
                    switch (p[1]) {
                        case 'SQUAD_JOINED':
                            var user = JSON.parse(p[2].slice(1, -1));
                            addSquadMember(user);
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

function send(msg){
    if(!msg) {
        alert("Message can not be empty");
        return;
    }
    try {
        socket.send(msg);
    } catch(ex) {

    }
}

function quit(){
    if (socket != null) {
        socket.close();
        socket=null;
    }
}


/** User Functions **/

// Initiates a squad searching loop
function findSquad(k) {
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

// Adds a user to the squad
function addSquadMember(uObj) {
    // Get wrapper
    var wrapper = $('.squad-wrapper .squad-ava-wrapper .squad-ava').first();

    // Change name and class
    wrapper.html("<a class='squad-name'>" + uObj.username + "</a>");
    wrapper.switchClass('squad-ava', 'squad-ava-other-1');
}