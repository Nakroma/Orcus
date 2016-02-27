/**
 * Created by Nakroma on 27.02.2016.
 */

var socket;

function init() {
    var host = "ws://127.0.0.1:9000/Orcus/server"; // SET THIS TO YOUR SERVER
    try {
        socket = new WebSocket(host);
        socket.onopen    = function(msg) {
            // NUR ZUSAGEN WENN SESSION ID GESETZT WURDE!!!!
            // NEEDS 'sid' passed!!!!!
            socket.send('SESSIONID_SET|' && sid);
        };

        socket.onmessage = function(msg) {

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