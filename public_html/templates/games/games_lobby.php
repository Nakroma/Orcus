<?php
// Assign path variables for easier use
$path = $this->_['path'];
$skey = $this->_['skey'];
$templateSidebar = $this->_['templateSidebar'];

// Page specific vars
$_d = $this->_;

// AUTH STUFF HERE
$_SESSION[$skey] = 13;
$sid = $_SESSION[$skey];

// Get auth info
$_u = Model::getUser($sid, 'username, okken');
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orcus | League of Legends</title>

    <link rel="stylesheet" href="<?php echo $path['css']; ?>bootstrap.min.css">
    <link href="<?php echo $path['css']; ?>games_league.css" rel="stylesheet">
    <link href="<?php echo $path['css']; ?>odometer.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600' rel='stylesheet' type='text/css'>
    <script src="<?php echo $path['js']; ?>jquery.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $path['js']; ?>odometer.js"></script>
    <script language="javascript" src="<?php echo $path['js']; ?>lz-string.js"></script>

    <!-- Websocket Server -->
    <script>var sid = <?php echo json_encode($sid); ?></script>
    <script type="text/javascript" src="../server/client.js"></script>
    <script>SocketClient_init();</script>
</head>




<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class='container row' style='margin-top:22vh; margin-right: auto; margin-left: auto;'>
        <!-- Left -->
        <div class='col-md-4 login-left'>
            <img src='<?php echo $path['img']; ?>login-bg.png' class='login-bg'>
            <img src="<?php echo $path['img']; ?>logo_solo.png" class='login-logo'>
            <br>
            <span class='sign-up-headline'>SIGN UP</span>
            <br>
            <span class='sign-up-swap-headline'>Already have an account?</span>
            <br>
            <a href='#' class='sign-up-swap'>Log me in</a>
        </div>
        <!-- Right-->
        <div class='col-md-8 login-right'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src='<?php echo $path['img']; ?>login-close.svg' aria-hidden="true" class='login-close'>
            </button>
            <span class='login-headline'>Create Account</span>
            <div class='login-sub-headline-wrapper'>
                <img src='<?php echo $path['img']; ?>steam.svg' class='steam-ico'>
                <a href='#' class='login-sub-headline'>Sign in through Steam</a>
            </div>

            <span class="input input--jiro">
					<input class="input__field input__field--jiro" type="text" required/>
					<label class="input__label input__label--jiro">
                        <span class="input__label-content input__label-content--jiro">E-Mail <span class='input-content'>entered.email@gmail.com</span></span>
                    </label>
            </span>
            <span class="input input--jiro">
					<input class="input__field input__field--jiro" type="password" required/>
					<label class="input__label input__label--jiro">
                        <span class="input__label-content input__label-content--jiro" >Password</span>
                    </label>
            </span>
            <br>
            <br>
            <br>
            <label class='login-checkbox'>
                <input type="checkbox"> Here are the <a href='#' class='TOU'>Terms of Use.</a> I know you won't read them, so tl;dr - Don't cheat!
            </label>

            <div class="modal-footer">
                <button type="submit" class="login-btn">Sign Up</button>
            </div>
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->



<!-- Squad Invite -->
<div class='squad-invite-wr squad-invite-hidden'>
    <div class='squad-invite-helper'></div>
    <div class='squad-invite-notification'>
        <div class='squad-invite-box-shade'></div>
        <div class='squad-invite-notification-wr'>
            <img src='<?php echo $path['img']; ?>squad-invite-ico.svg' class='squad-invite-ico'>
            <span class='squad-invite-title'><a href='#' target='_blank' class='invite-player'>Fukushima.</a> invited you to their squad!</span>
        </div>
        <div class='squad-invite-preview'>
            <div class='squad-invite-ava-self'>
                <img src='<?php echo $path['img']; ?>ava_sample_3.png' class='squad-ava-img-self'>
                <div class='squad-invite-ava-swap-helper'>
                    <img class='squad-invite-ava-img-self-swap'>
                </div>
            </div>
            <div class='squad-invite-ava-self-inf'>
                <a href="#" class='squad-invite-self-name'>
                    Fukushima.
                </a>
                <a href="#" class='squad-invite-self-name-alt'>
                    TotalBiscuit
                </a>
                <a href="#" class='squad-invite-self-name-alt'>
                    TotalBiscuit
                </a>
                <br>
                <div class='squad-self-status'>In Lobby</div>
            </div>
            <div class='squad-invite-team-wr'>
                <img src='<?php echo $path['img']; ?>squad-border.png' class='squad-invite-seperator'>
                <div class='squad-ava-wrapper'>
                    <div class='squad-invite-ava squad-slot-taken'>
                    </div>
                    <div class='squad-invite-ava squad-slot-taken'></div>
                    <div class='squad-invite-ava'></div>
                    <div class='squad-invite-ava'></div>
                </div>
            </div>
        </div>
        <div class='squad-invite-accept-decline'>
            <div class='squad-invite-accept'>Accept</div>
            <div class='squad-invite-decline'>Decline</div>
        </div>
        <div class='squad-invite-decline-block'>
            <div class='squad-invite-block-box'></div>
            Block Communications
        </div>
    </div>
    <div class='squad-invite-ava-self-inf-alt'>

    </div>
</div>






<body class=''>
<div class='sidebar-content-dim'></div>

<!-- Content -->
<div class="content">
<img src='<?php echo $path['img']; ?>game_details_bg_league5.jpg' class='content-bg'>


<!-- Menu Bar -->
<div class='menu-bar-top'>
    <a href="#">
        <img src='<?php echo $path['img']; ?>logo_solo.png' class='menu-logo'>
        <img src='<?php echo $path['img']; ?>orcus_font.png' class='menu-logo-font'>
    </a>
    <a href='#' class='sidebar-list-link' style='padding-left:2%;'>All</a>&nbsp;&nbsp;-
    <a href='#' class='sidebar-list-link'>MOBAs</a>&nbsp;&nbsp;-
    <span class='sidebar-list-link-game'>League of Legends</span>
    <div class='menu-options'>
        <div class='menu-icons'>
            <img src='<?php echo $path['img']; ?>friends-ico.svg' class='menu-ico' id='friends'>
            <span class='menu-ico-desc desc-hidden' id='friends-desc'>Friends</span>
            <img src='<?php echo $path['img']; ?>invest-ico.svg' class='menu-ico' id='invest'>
            <span class='menu-ico-desc desc-hidden-2' id='invest-desc'>Invest</span>
            <img src='<?php echo $path['img']; ?>tournament-ico.svg' class='menu-ico' id='tournament'>
            <span class='menu-ico-desc desc-hidden-3' id='tournament-desc'>Tournaments</span>
        </div>
        <div class='menu-play'>
            <img src='<?php echo $path['img']; ?>play-ico.svg' class='svg play-ico cancel-ico'>
            <span class='play-text cancel-text'>Cancel</span>
        </div>
        <div class='menu-create'>
            <div class='menu-create-normal'>
                <img src='<?php echo $path['img']; ?>create_lobby_ico.svg' class='create-ico'>
                <span class='create-text'>Create Lobby</span>
            </div>
            <div class='menu-create-filters'>

            </div>
        </div>
    </div>
</div>




<!-- Left Side -->
<div class='main-content'>
<div class='lobby hidden'>
    <div class='lobby-top-teams'>
        <div class='team-wrapper'>
            <div class='team-1'>
                <span class='team-name'>Team Blue</span>
                <div class='match-queue-team'>
                    <div class='team-placeholder player-ready'></div>
                    <div class='team-placeholder player-ready'></div>
                    <div class='team-placeholder player-ready'></div>
                    <div class='team-placeholder player-ready'></div>
                    <div class='team-placeholder'></div>
                </div>

            </div>
            <div class='match-status'>
                <img src='<?php echo $path['img']; ?>puff.svg' class='queue-ico hidden'>
                <span class='match-status-text hidden'>Finding Carry..</span>
                <span class='match-status-text'>Preparing Queue</span>
            </div>
            <div class='team-2'>
                <div class='match-queue-team'>
                    <div class='team-placeholder'></div>
                    <div class='team-placeholder'></div>
                    <div class='team-placeholder player-ready-2'></div>
                    <div class='team-placeholder player-ready-2'></div>
                    <div class='team-placeholder player-ready-2'></div>
                </div>
                <span class='team-name'>Team Green</span>
            </div>
        </div>
    </div>
    <div class='pick-a-role'>
        <!-- Make scrollable for responsive -->
        <span class='par-title'>choose your Role</span>
        <br>
        <span class='par-sub'>Queue will start when everyone locked in.</span>
        <br>
        <div class='roles-wrapper'>
            <div class='role-container'>
                <div class='role' id='jungler'>
                    <img src='<?php echo $path['img']; ?>league_role_backdrop.png' class='role-img-bg'>
                    <img src='<?php echo $path['img']; ?>league_jungle_role.png' class='role-img support'>
                    <img src='<?php echo $path['img']; ?>game_role_ico_circle.svg' class='role-ico-circle'>
                    <img src='<?php echo $path['img']; ?>game_jungle.svg' class='role-ico' style='margin-left:-12px;'>
                    <div class='role-taken-wr'>
                        <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='role-taken-img'>
                    </div>
                </div>
                <div class='locked-in-helper'>
                    <div class='locked-in-status '>
                        <img src='<?php echo $path['img']; ?>check.svg' class='check-ico'>
                    </div>
                </div>
                <div class='role-name'>
                    <span>Jungler</span>
                    <br>
                                <span class='queue-est'>
                                    Queue Time: 2min
                                </span>
                </div>
            </div>
            <div class='role-container'>
                <div class='role' id='support'>
                    <img src='<?php echo $path['img']; ?>league_role_backdrop.png' class='role-img-bg'>
                    <img src='<?php echo $path['img']; ?>league_support_role.png' class='role-img support'>
                    <img src='<?php echo $path['img']; ?>game_role_ico_circle.svg' class='role-ico-circle'>
                    <img src='<?php echo $path['img']; ?>game_support.svg' class='role-ico' style='margin-top:-110px; margin-left:-10px;'>
                    <div class='role-taken-wr'>
                        <img src='<?php echo $path['img']; ?>ava_sample_1.png' class='role-taken-img'>
                    </div>
                </div>
                <div class='locked-in-helper'>
                    <div class='locked-in-status '>
                        <img src='<?php echo $path['img']; ?>check.svg' class='check-ico'>
                    </div>
                </div>

                <div class='role-name'>
                    <span>Support</span>
                    <br>
                                <span class='queue-est'>
                                    Queue Time: 1min
                                </span>
                </div>
            </div>
            <div class='role-container'>
                <div class='role' id='carry'>
                    <img src='<?php echo $path['img']; ?>league_role_backdrop.png' class='role-img-bg'>
                    <img src='<?php echo $path['img']; ?>league_adc_role.png' class='role-img support'>
                    <img src='<?php echo $path['img']; ?>game_role_ico_circle.svg' class='role-ico-circle'>
                    <img src='<?php echo $path['img']; ?>game_carry.svg' class='role-ico' style='margin-top:-112px; margin-left:-12px;'>
                    <div class='role-taken-wr'>
                        <img src='<?php echo $path['img']; ?>ava_sample_1.png' class='role-taken-img'>
                    </div>
                </div>
                <div class='locked-in-helper'>
                    <div class='locked-in-status'>
                        <img src='<?php echo $path['img']; ?>check.svg' class='check-ico'>
                    </div>
                </div>
                <div class='role-name'>
                    <span>Carry</span>
                    <br>
                                <span class='queue-est'>
                                    Queue Time: 4min
                                </span>
                </div>
            </div>
            <div class='role-container'>
                <div class='role' id='tank'>
                    <img src='<?php echo $path['img']; ?>league_role_backdrop.png' class='role-img-bg'>
                    <img src='<?php echo $path['img']; ?>league_tank_role.png' class='role-img support'>
                    <img src='<?php echo $path['img']; ?>game_role_ico_circle.svg' class='role-ico-circle'>
                    <img src='<?php echo $path['img']; ?>game_tank.svg' class='role-ico'>
                    <div class='role-taken-wr'>
                        <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='role-taken-img'>
                    </div>
                </div>
                <div class='locked-in-helper'>
                    <div class='locked-in-status'>
                        <img src='<?php echo $path['img']; ?>check.svg' class='check-ico'>
                    </div>
                </div>
                <div class='role-name'>
                    <span>Tank</span>
                    <br>
                                <span class='queue-est'>
                                    Queue Time: 1min
                                </span>
                </div>
            </div>
            <div class='role-container'>
                <div class='role' id='cc'>
                    <img src='<?php echo $path['img']; ?>league_role_backdrop.png' class='role-img-bg'>
                    <img src='<?php echo $path['img']; ?>league_cc_role.png' class='role-img support'>
                    <img src='<?php echo $path['img']; ?>game_role_ico_circle.svg' class='role-ico-circle'>
                    <img src='<?php echo $path['img']; ?>game_cc.svg' class='role-ico' style='margin-top:-110px; margin-left:-11px;'>
                    <div class='role-taken-wr'>
                        <img src='<?php echo $path['img']; ?>ava_sample_1.png' class='role-taken-img'>
                    </div>
                </div>
                <div class='locked-in-helper'>
                    <div class='locked-in-status '>
                        <img src='<?php echo $path['img']; ?>check.svg' class='check-ico'>
                    </div>
                </div>
                <div class='role-name'>
                    <span>Disabler</span>
                    <br>
                                <span class='queue-est'>
                                    Queue Time: 1min
                                </span>
                </div>
            </div>
        </div>
        <div class='lock-in-role'>
            Lock In
        </div>
    </div>


    <div class='lobby-bot-stats'>
        <div class='bot-stats-members'>
            <div class='bot-stats-b-left'></div>
            <div class='bot-stats-team'>
                <div class='bot-team-member team-slot-taken'>
                    <img src='<?php echo $path['img']; ?>ava_sample_1.png' class='team-ava'>
                </div>
                <div class='bot-team-member'>
                    <img class='team-ava'>
                </div>
                <div class='bot-team-member'>
                    <img class='team-ava'>
                </div>
                <div class='bot-team-member'>
                    <img class='team-ava'>
                </div>
            </div>
            <div class='bot-stats-b-left'></div>
        </div>
        <div class='lobby-user-stats'>
            <div class='lobby-user-stats-sub'>
                <span class='stats-number' id='wins'>33</span>
                <br>
                <span class='stats-title'>Wins</span>
            </div>
            <div class='lobby-user-stats-sub'>
                <span class='stats-number' id='skill'>433</span>
                <br>
                <span class='stats-title'>Skill</span>
            </div>
            <div class='lobby-user-stats-sub'>
                <span class='stats-number' id='lost'>7</span>
                <br>
                <span class='stats-title'>Lost</span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $path['js']; ?>games_lobby.js"></script>





<!-- News/Notifications -->
<script src='<?php echo $path['js']; ?>gallery.js'></script>
<script src='<?php echo $path['js']; ?>motionblur.js'></script>
<script src='<?php echo $path['js']; ?>TweenMax.min.js'></script>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="filters hidden">
    <defs>
        <filter id="blur">
            <feGaussianBlur in="SourceGraphic" stdDeviation="0,0" />
        </filter>
    </defs>
</svg>

<div class='news-slideshow'>
    <ul class="gallery-pictures">
        <li class="gallery-picture">
            <img src='<?php echo $path['img']; ?>league_ocs_header_img.jpg' class='slideshow-img img01'>
            <h2 class='slideshow-category'>Tournament News</h2>
            <h1 class='slideshow-headline'>OCS - Starting Friday</h1>
        </li>
        <li class="gallery-picture">
            <img src="<?php echo $path['img']; ?>league_aaa_header_img.jpg" class='slideshow-img img02'>
            <h2 class='slideshow-category'>Tournament News</h2>
            <h1 class='slideshow-headline'>OCS - Starting Friday</h1>
        </li>
        <li class="gallery-picture">
            <img src='<?php echo $path['img']; ?>league_ocs_header_img.jpg' class='slideshow-img img01'>
            <h2 class='slideshow-category'>Tournament News</h2>
            <h1 class='slideshow-headline'>OCS - Starting Friday</h1>
        </li>
        <li class="gallery-picture">
            <img src="<?php echo $path['img']; ?>league_aaa_header_img.jpg" class='slideshow-img img02'>
            <h2 class='slideshow-category'>Tournament News</h2>
            <h1 class='slideshow-headline'>OCS - Starting Friday</h1>
        </li>
        <li class="gallery-picture">
            <img src='<?php echo $path['img']; ?>league_bbb_header_img.jpg' class='slideshow-img img03'>
            <h2 class='slideshow-category'>Tournament News</h2>
            <h1 class='slideshow-headline'>OCS - Starting Friday</h1>
        </li>
    </ul>
    <div class='slide-bot-shade'></div>
    <div class='slide-pagination'>
        <div class='pagination-size-incr'>
            <div class='slide-pagination-circle'></div>
        </div>
        <div class='pagination-size-incr'>
            <div class='slide-pagination-circle'></div>
        </div>
        <div class='pagination-size-incr'>
            <div class='slide-pagination-circle'></div>
        </div>
        <div class='pagination-size-incr'>
            <div class='slide-pagination-circle'></div>
        </div>
        <div class='pagination-size-incr'>
            <div class='slide-pagination-circle'></div>
        </div>
    </div>
</div>
<div class='lower-main-content'>
    <div class='updates-wrapper'>
        <div class='slide-bot-shade'></div>
        <div class='updates'>
            <div class='update-content'>
                <span class='update-date'>06/03/2016</span>
                <h3 class='update-title'>orcus Update <span class='number'>0.56</span></h3>
                <span class='update-text'><span class='inline-block'>· Addressed minor bugfixes <br></span><span class='inline-block'>· Addressed AP to match filters<br></span><span class='inline-block'>· Orcus Mobile has been &nbsp;&nbsp;enhanced <br></span></span>
            </div>
            <div class='update-content'>
                <span class='update-date'>06/03/2016</span>
                <h3 class='update-title'>orcus Update <span class='number'>0.56</span></h3>
                <span class='update-text'><span class='inline-block'>· Addressed minor bugfixes <br></span><span class='inline-block'>· Addressed AP to match filters<br></span><span class='inline-block'>· Orcus Mobile has been &nbsp;&nbsp;enhanced <br></span></span>
            </div>
            <div class='update-content'>
                <span class='update-date'>06/03/2016</span>
                <h3 class='update-title'>orcus Update <span class='number'>0.56</span></h3>
                <span class='update-text'><span class='inline-block'>· Addressed minor bugfixes <br></span><span class='inline-block'>· Addressed AP to match filters<br></span><span class='inline-block'>· Orcus Mobile has been &nbsp;&nbsp;enhanced <br></span></span>
            </div>
        </div>
    </div>
    <div class='notification-wrapper'>
        <div class='notification-ref'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr-ref'>
                <div class='ntfc-title-wr-ref-cntr'>
                    <h1 class='ntfc-title'>Refer a friend<br>& profit.</h1>
                </div>
            </div>
        </div>
        <div class='notification ntf-alt'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr'>
                <h1 class='ntfc-title'><span class='number'>1K</span> worth giveaway</h1>
                            <span class='ntfc-txt'>Participate by playing within<br>the next <span class='number'>250</span> matches.
                            <br><a href="#" class='ntfc-rm'>Read more</a></span>
            </div>
        </div>
        <div class='notification'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr'>
                <h1 class='ntfc-title'>Received <span class='number'>20$</span></h1>
                <span class='ntfc-txt'>From investing in Meemy.</span>
            </div>
            <div class='top-ntf'>
                +20$
            </div>
        </div>
        <div class='notification ntf-alt'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr'>
                <h1 class='ntfc-title'>Received <span class='number'>20$</span></h1>
                <span class='ntfc-txt'>From investing in Meemy.</span>
            </div>
            <div class='top-ntf'>
                +20$
            </div>
        </div>
        <div class='notification'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr'>
                <h1 class='ntfc-title'>Received <span class='number'>20$</span></h1>
                <span class='ntfc-txt'>From investing in Meemy.</span>
            </div>
            <div class='top-ntf'>
                +20$
            </div>
        </div>
        <div class='notification ntf-alt'>
            <div class='ntfc-title-hlpr'></div>
            <div class='ntfc-title-wr'>
                <h1 class='ntfc-title'>Received <span class='number'>20$</span></h1>
                <span class='ntfc-txt'>From investing in Meemy.</span>
            </div>
            <div class='top-ntf'>
                +20$
            </div>
        </div>
    </div>
</div>
-->
</div>





<!-- Right Side / Chat -->
<div class='chat'>
    <div class='chat-container'>
        <div class='chat-groups'>
            <img src='<?php echo $path['img']; ?>chat_arrow.svg' class='chat-arrow-left'>
            <div class='chats-groups-wrapper'>
                <div class='chat-hrz-wr' id='chat-hrz'>
                    <div class='chat-group chat-group-active'>
                        <span class='chat-group-title'>All Chat</span>
                        <br><span class='chat-group-desc'>590 online</span>
                    </div>
                    <div class='chat-group'>
                        <div class='chat-group-td'>
                            <span class='chat-group-title'>Squad</span>
                            <br>
                            <span class='chat-group-desc'>Main Menu</span>
                        </div>
                        <div class='chat-new-msgs msgs-invis'>
                            5
                        </div>
                    </div>
                    <div class='chat-group'>
                        <div class='chat-group-td'>
                            <span class='chat-group-title'>Dendi</span>
                            <br>
                            <span class='chat-group-desc'>Idle</span>
                        </div>
                        <div class='chat-new-msgs '>
                            5
                        </div>
                    </div>
                    <div class='chat-group'>
                        <div class='chat-group-td'>
                            <span class='chat-group-title'>FatFuckMoh</span>
                            <br>
                            <span class='chat-group-desc'>Main Menu</span>
                        </div>
                        <div class='chat-new-msgs msgs-invis'>
                            5
                        </div>
                    </div>
                </div>
            </div>
            <img src='<?php echo $path['img']; ?>chat_arrow.svg' class='chat-arrow-right'>
            <div class='chat-menu-ico-wrapper'>
                <img src='<?php echo $path['img']; ?>small_menu_ico.svg' class='chat-menu-ico'>
            </div>
            <div class='chat-sub-menu-options'>
                <div class='chat-pm'>
                    <img src='<?php echo $path['img']; ?>chat_add.png' class='chat-add'>
                    <input type='text' placeholder='Enter player to chat with' class='pm-friend-input'>
                    <div class='sidebar-entry-error error-hidden' id='chat-group-error'>Not Found</div>
                </div>
            </div>
            <div class='bottom-border-indicator'>
                <div class='triangle-border-left'></div>
                <div class='triangle'></div>
                <div class='triangle-border-right'></div>
            </div>
        </div>


        <!-- Chat Messages -->
        <div class='chat-content'>
            <div class='chat-scroll'>

            </div>
        </div>


        <div class='chat-input'>
            <input type=text class='chat-input-text' placeholder="Write something">
            <img src='<?php echo $path['img']; ?>send-msg-ico.svg' class='send-ico'>
        </div>
        <div class='squad'>
            <div class='squad-ava-self'>
                <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='squad-ava-img-self'>
                <div class='squad-ava-swap-helper'>
                    <img class='squad-ava-img-self-swap'>
                </div>
            </div>
            <div class='squad-ava-self-inf'>
                <a href="#" class='squad-self-name'>
                    <?php echo $_u['username']; ?>
                </a>
                <a href="#" class='squad-self-name-alt'></a>
                <a href="#" class='squad-self-name-alt'></a>
                <a href="#" class='squad-self-name-alt'></a>
                <a href="#" class='squad-self-name-alt'></a>
                <br>
                <div class='squad-self-role'>Tank</div>
                <div class='squad-self-role-alt'></div>
                <div class='squad-self-role-alt'></div>
                <div class='squad-self-role-alt'></div>
                <div class='squad-self-role-alt'></div>
            </div>

            <img src='<?php echo $path['img']; ?>squad-border.png' class='squad-seperator'>
            <div class='squad-ava-wrapper'>
                <div class='squad-ava squad-slot-taken'>
                    <img src='<?php echo $path['img']; ?>ava_sample_1.png' class='squad-ava-img'>
                </div>
                <div class='squad-ava'></div>
                <div class='squad-ava'></div>
                <div class='squad-ava'></div>
            </div>
            <div class='squad-menu-ico-wr'>
                <img src='<?php echo $path['img']; ?>small_menu_ico.svg' class='squad-menu-ico'>
            </div>

            <div class='squad-sub-options'>
                <div class='squad-invite'>
                    <img src='<?php echo $path['img']; ?>chat_add.png' class='chat-add'>
                    <input type='text' placeholder='Enter player to invite' class='squad-inv-input'>
                    <div class='sidebar-entry-error error-hidden' id='squad-group-error'>Not Found</div>
                </div>
                <div class='leave-squad'><img src='<?php echo $path['img']; ?>logout.svg' class='leave-squad-ico'></div>
            </div>
        </div>
    </div>
</div>

<!-- Menu -->
<nav class='user-menu'>
    <div class='user-menu-container'>
        <a href='#' class='user-money'><?php echo $_u['okken']; ?> <img src='<?php echo $path['img']; ?>currency_dark.svg' style='margin-bottom:3px;'></a>
        <a class='side-menu'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>
    </div>
</nav>
</div>

<!-- Sidebar Lobby Options -->
<div class='sidebar-lobby-options filters-hidden'>
    <div class='sidebar-lobby-header'>
        <h3 class='queue-options'>Find Match</h3>
        <br>
    </div>
    <!-- Game Mode -->
    <img src='<?php echo $path['img']; ?>league_jungler_sub_header.png' class='sub-header-bg'>
    <div class='queue-filters'>
        <div class='sidebar-lobby-options-wrapper'>
            <div class='sidebar-lobby-mode'>
                <h4 class='sidebar-game-mode'>Game Mode</h4>
                <div class='queue-filter-arrow-ico' id='modes'></div>
            </div>
            <div class='sidebar-lobby-mode-wrapper'>
                <div class='sidebar-lobby-mode-filters'>
                    <div class='game-mode-box'>
                        All Pick
                    </div>
                    <div class='game-mode-box'>
                        ARAM
                    </div>
                    <div class='game-mode-box'>
                        SWAG
                    </div>
                    <div class='game-mode-box'>
                        Captain's Draft
                    </div>
                </div>
                <div class='game-mode-players'>
                    <div class='game-mode-box'>
                        <span class='number'>5 vs 5</span>
                    </div>
                    <div class='game-mode-box'>
                        <span class='number'>1 vs 1</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Entry -->
        <div class='sidebar-lobby-options-wrapper-entry'>
            <div class='sidebar-lobby-entry'>
                <h4 class='sidebar-game-mode'>Select Entry</h4>
                <div class='queue-filter-arrow-ico' id='entries'>
                </div>
                <div class='sidebar-entry-error error-hidden'>Mode Incomplete</div>
            </div>
            <div class='sidebar-lobby-entry-wrapper'>
                <div class='sidebar-lobby-entry-filters'>
                    <div class='game-mode-box number'>
                        5 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'>
                    </div>
                    <div class='game-mode-box number'>
                        10 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'>
                    </div>
                    <div class='game-mode-box number'>
                        20 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'>
                    </div>
                    <div class='game-mode-box number'>
                        50 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'>
                    </div>
                    <div class='game-mode-box number' style='width:110px;'>
                        <input type="number" name="custom entry" class='custom-entry' placeholder='Custom'>
                    </div>
                </div>
                <div class='game-entry-invest'>
                    <div class='game-mode-box'>
                        <span class='number'>20 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'></span>
                    </div>
                    <div class='game-mode-box'>
                        <span class='number'>10 <img src='<?php echo $path['img']; ?>currency.svg' class='entry-currency-ico'></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class='sidebar-queue-status-wrapper'>
        <div class='sidebar-queue-status-desc'>
            <span class='entry-value'></span> - <span class='mode-selected'></span> - Europe
        </div>
        <div class='sidebar-queue-start-cancel'>
            <div class='sidebar-queue-start  queue-not-ready'>Find Match</div>
        </div>
    </div>
</div>







<!-- Menu Open -->
<div class='menu-open'>
    <div class='menu-ava'></div>
    <a href='#' class='user-menu-name'>TotalBiscuit</a>
    <a class='side-menu-open'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>

    <div class='menu-group-1'>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>lp_header_tournament.svg'>Tournaments</a>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>lp_header_leaderboard.svg'>Leaderboards</a>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>lp_header_games.svg' style='margin-left:2px;'>Games</a>
    </div>
    <div class='menu-group-2'>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>currency.svg' class='menu-currency'>Charge</a>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>settings.svg' class='menu-settings'>Settings</a>
    </div>
    <div class='menu-group-3'>
        <a href="#" class='menu-link'><img src='<?php echo $path['img']; ?>logout.svg' class='menu-settings'>Logout</a>
    </div>
</div>




<!-- Game Bar -->
<div class="gd-gamebar">
    <a href='#' class="gd-game">
        <img src="<?php echo $path['img']; ?>gd_gamebar_dota.png">
    </a>
    <a href='#' class="gd-game">
        <img src="<?php echo $path['img']; ?>gd_gamebar_csgo.png">
    </a>
    <a href='#' class="gd-game">
        <img src="<?php echo $path['img']; ?>gd_gamebar_hs.png">
    </a>
</div>



<script type="text/javascript" src='<?php echo $path['js']; ?>games_chat.js'></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>games_league.js"></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>moment.js"></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>jquery.timeago.js"></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>odometer.js"></script>
</body>

</html>
