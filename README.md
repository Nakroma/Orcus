# Development Branch
Use this branch to develop the ongoing project.  
When the content is ready for a new release, merge into the master branch.  


## Matchmaking Server/Client Communication 
Server and Client communicate via JSON.  
Default JSON template:  
```json
{
  "code": "SESSIONID_SET",
  "args": [
    23, "nakroma"
  ]
}
```


### Matchmaking Server/Client Codes  
**Client -> Server**  

```
SESSIONID_SET	// Sets the session ID for a WebSocket user. Required for everything to work.
	0: SID	// Session ID

SQUAD_CREATE	// Creates a new squad and sets the calling user as the owner.
	0: Game	// Game (lol, dota, hs)
SQUAD_INVITE_USER	// Invites a user to the squad
	0: Name	// Name of the user
SQUAD_JOIN_USER	// Joins a squad
	0: Squad ID	// ID of the squad
SQUAD_START_MATCHMAKING	// Starts the matchmaking of a squad
	0: Matchmaking parameters	// Parameters for the matchmaking (Mode, Size, Entry)
SQUAD_CANCEL_MATCHMAKING	// Cancels the matchmaking
SQUAD_SELECT_ROLE	// Selects a role in role selection
	0: Role ID	// Id of the role
SQUAD_LOCK_ROLE	// Locks in a role

CHAT_SEND_MESSAGE	// Sends a chat message
	0: Lobby	// Chat Lobby (ALL, SQUAD, PRIVATE)
	1: Message	// Message (LZ-String compressed)
	2: User		// User to send to (only if Lobby is PRIVATE)
```


**Server -> Client**

```
SUCCESS_SESSIONID_SET	// Signals the successful setting of the session ID
	0: User JSON	// JSON array containing user data (id, username)

NOTICE_LOBBY_DISBAND	// Signals the disbanding of the lobby
NOTICE_LOBBY_LEFT	// Signals that a user left the lobby
	0: User SID	// Session ID of the user

SUCCESS_SQUAD_JOIN	// Signals the successful joining of a squad
	0: Squad JSON	// JSON array containing 'info' and 'owner' bool for each member
NOTICE_SQUAD_DISBAND	// Signals the disbanding of the squad
NOTICE_SQUAD_LEFT	// Signals that a user left the squad
	0: Username	// Name of the user
NOTICE_SQUAD_INVITE_USER	// Signals a user if his invite was successful
	0: True/False	// Was the invite successful?
NOTICE_SQUAD_INVITATION	// Sends a squad invitation
	0: Squad ID	// Squad ID
	1: Owner JSON	// JSON array containing owner data
	//2: Members	// Members of the squad
NOTICE_SQUAD_NEW_JOIN	// Signals that a new user joined the squad
	0: User JSON	// JSON array containing user data
NOTICE_SQUAD_START_ROLE_SELECTION	// Signals that the role selection starts
	0: Matchmaking parameters	// Parameters for the matchmaking (Mode, Size, Entry)
NOTICE_SQUAD_CANCEL_MATCHMAKING	// Cancels the matchmaking proccess
NOTICE_SQUAD_ROLE_SELECTION	// Notifies that a user selected a role
	0: User JSON	// JSON array containing user data (id, username)
	1: Role		// Role ID
NOTICE_SQUAD_LOCK_ROLE	// Signals that a user locked in a role
	0: Role		// Role ID
ERROR_SQUAD_JOIN	// Notifies the user that the join failed
	0: Error	// Error message

NOTICE_CHAT_RECEIVE_MESSAGE	// Client receives a chat message
	0: Lobby	// Chat Lobby (ALL, SQUAD, PRIVATE)
	1: Message	// Message (LZ-String compressed)
	2: User		// Author of the message
``` 