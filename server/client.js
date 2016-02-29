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
            switch (msg['data']) {
                case 'S|SQUAD_JOIN':
                    findSquad('stop');
                    queueQuit(); // Visual
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