# Development Branch #
Use this branch to develop the ongoing project.  
When the content is ready for a new release, merge into the master branch.  


## Matchmaking Server - Internal Codes ##
These are the internal codes used in the matchmaking server to communicate between server and client.  
`CODENAME|(VAR1)|(VAR2)`  

**Client -> Server**  
`SESSIONID_SET|(SID)` Sets the session ID (mysql info) for the WebSocket user. This is required to do anything.  

`LOBBY_CREATE|(Game)|(Teamsize)` Creates a new lobby and sets the calling user as the owner.  
`LOBBY_JOIN|(LobbyID)` The calling user joins a lobby. Broadcasts this to everyone else in the lobby. (also squads)  

`SQUAD_CREATE|(Game)` Creates a new squad and sets the calling user as the owner.  
`SQUAD_SEARCH|(Game)` Searches for an empty squad (gets called repeatedly by the matchmaking queue).  
`SQUAD_LOCK_CHANGE|(Boolean)` Changes the locked state of a squad. True = Open, False = Closed.  

**Server -> Client**  
`S`: Success - `E`: Error - `N`: Notice  

`S|SESSIONID_SET` Confirms that the SID was set to the client.  
`S|LOBBY_JOIN` Confirms the successful joining in a lobby.
`S|SQUAD_JOIN|(Json: squad members[][id, username])` Confirms the successful joining of a squad.

`E|LOBBY_FULL` Signals that the lobby is full.  
`E|LOBBY_NOSPACE` Signals that the lobby doesn't have enough space for the squad.  
`E|SQUAD_FULL` Signals that the squad is full.  

`N|LOBBY_JOINED|(SID)` Notifies the other users with the SID of the new user.  
`N|LOBBY_LEFT|(SID)` Notifies the other users with the SID of the left user.   
`N|LOBBY_DISBAND` Notifies the other users of the disband.  
`N|SQUAD_JOINED|(Json: squad member[id, username])` Notifies the other users with the SID of the new user.
`N|SQUAD_LEFT|(SID)` Notifies the other users with the SID of the left user.  
`N|SQUAD_DISBAND` Notifies the other users of the disband.  