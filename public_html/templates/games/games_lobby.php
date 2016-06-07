<?php
// Assign path variables for easier use
$path = $this->_['path'];
$skey = $this->_['skey'];
$templateSidebar = $this->_['templateSidebar'];

// Page specific vars
$_d = $this->_;

// AUTH STUFF HERE
$_SESSION[$skey] = 14;
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


        <!-- Backgrounds -->
        <img src='<?php echo $path['img']; ?>game_details_bg_league5.jpg' class='content-bg' id='normal-bg'>
        <img src='<?php echo $path['img']; ?>game_details_bg_league5_blur.jpg' class='content-bg invis' id='blur-bg'>
        <!-- <video loop muted autoplay poser="<?php echo $path['img']; ?>lp_header.png" class="video">
            <source src="bootstrap/video/game_hub_bg2.mp4" type="video/mp4">
        </video>



        <!-- Menu Bar -->
        <div class='menu-bar-top'>
            <div class="lock-in-role"> Lock In </div>
            <a href="#">
                <img src='<?php echo $path['img']; ?>logo_solo.png' class='menu-logo'>
                <img src='<?php echo $path['img']; ?>orcus_font.png' class='menu-logo-font'>
            </a>
            <a href='#' class='sidebar-list-link' style='padding-left:2%;'>All</a>&nbsp;&nbsp;-
            <a href='#' class='sidebar-list-link'>MOBAs</a>&nbsp;&nbsp;-
            <span class='sidebar-list-link-game' style='cursor:pointer'>**debug** quick lobby</span>
            <div class='menu-options'>
                <div class='menu-icons'>
                    <img src='<?php echo $path['img']; ?>feedback-ico.svg' class='feedback-ico hidden'>
                    <span class='menu-ico-desc hidden' style='margin-right:20px;'>Feedback</span>



                    <img src='<?php echo $path['img']; ?>friends-ico.svg' class='menu-ico hidden' id='friends'>
                    <span class='menu-ico-desc desc-hidden' id='friends-desc'>Friends</span>
                    <img src='<?php echo $path['img']; ?>invest-ico.svg' class='menu-ico hidden' id='invest'>
                    <span class='menu-ico-desc desc-hidden-2' id='invest-desc'>Invest</span>
                    <img src='<?php echo $path['img']; ?>tournament-ico.svg' class='menu-ico hidden' id='tournament'>
                    <span class='menu-ico-desc desc-hidden-3' id='tournament-desc'>Tournaments</span>
                </div>
                <div class='menu-play'>
                    <img src='<?php echo $path['img']; ?>play-ico.svg' class='svg play-ico'>
                    <span class='play-text'>Play</span>
                    <img src='<?php echo $path['img']; ?>bloom.png' class='play-bloom animated pulse'>
                </div>
                <div class='menu-create show-filters'>
                    <div class='menu-create-normal '>
                        <img src='<?php echo $path['img']; ?>create_lobby_ico.svg' class='create-ico'>
                        <span class='create-text'>Create Lobby</span>
                    </div>
                    <div class='menu-create-filters invis'>
                        <div class='filter-game-modes'>
                        </div>
                    </div>
                    <div class='filter-entry invis'>
                        <span class='filter-entry-text'>Entry</span>
                        <span class='filter-entry-value'></span>
                    </div>
                </div>
                <!-- Menu -->
                <nav class='user-menu'>
                    <div class='user-menu-container'>
                        <a href='#' class='user-money'>50.00 <img src='<?php echo $path['img']; ?>currency_dark.svg' style='margin-bottom:3px;'></a>
                        <a class='side-menu'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>
                    </div>
                </nav>
            </div>
        </div>




        <!-- Left Side -->
        <div class='main-content' id='main'>
            <!-- News/Notifications -->
            <div class='news-notifications news-visible'>
                <script src='bootstrap/js/gallery.js'></script>
                <script src='bootstrap/js/motionblur.js'></script>
                <script src='bootstrap/js/TweenMax.min.js'></script>
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
                    <div class='notification-wrapper'>
                        <div class='notification'>
                            <div class='ntfc-title-hlpr'></div>
                            <div class='ntfc-title-wr'>
                                <h1 class='ntfc-title'><span class='number'>1K</span> worth giveaway</h1>
                                <span class='ntfc-txt'>Participate by playing within<br>the next <span class='number'>250</span> matches.
                                <br><a href="#" class='ntfc-rm'>Read more</a></span>
                            </div>
                        </div>
                        <div class='notification investment-notf'>
                            <img src='<?php echo $path['img']; ?>investment_bg.png' class='ntfc-bg'>
                            <div class='ntfc-title-hlpr'></div>
                            <div class='ntfc-title-wr'>
                                <h1 class='ntfc-title'>Received <span class='number'>20$</span></h1>
                                <span class='ntfc-txt'>From investing in Meemy.</span>
                            </div>
                            <div class='top-ntf'>
                                +20$
                            </div>
                        </div>
                        <div class='notification investment-notf'>
                            <img src='<?php echo $path['img']; ?>investment_bg.png' class='ntfc-bg'>
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

                <div class='notification-ref'>
                    <div class='ntfc-title-hlpr'></div>
                    <div class='ntfc-title-wr-ref'>
                        <div class='ntfc-title-wr-ref-cntr'>
                            <h1 class='ntfc-title ntfc-inv-title'>Invite a friend<br>& profit.</h1>
                        </div>
                    </div>
                </div>

                <div class='updates-wrapper'>
                    <div class='slide-bot-shade'></div>
                    <div class='updates'>
                        <div class='update-content'>
                            <span class='update-date'>06/03/2016</span>
                            <h3 class='update-title'>Beta giveaway winner announced!</h3>
                            <span class='update-text'><span class='inline-block'>Congratulations to <a href='#'>Webbel</a>, <a href='#'>Pleb</a> and <a href='#'>Oppai Blaster</a> for winning a combined value of 1000$ </span>
                            </span>
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

            </div>


            <div class="lobby">
                <div class='lobby-wr'>
                </div>
            </div>



        </div>
        <!-- End Main Content -->
        <div class='bot-content'>
            <div class='squad'>
                <div class='squad-ava-self'>
                    <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='squad-ava-img-self'>
                    <div class='squad-ava-swap-helper'>
                        <img class='squad-ava-img-self-swap'>
                    </div>
                </div>
                <div class='squad-ava-self-inf'>
                    <a href="#" class='squad-self-name'>TotalBiscuit</a>
                    <a href="#" class='squad-self-name-alt'></a>
                    <br>
                    <div class='squad-self-role'>Tank</div>
                    <div class='squad-self-role-alt'></div>
                </div>

                <img src='<?php echo $path['img']; ?>squad-border.png' class='squad-seperator'>
                <div class='squad-ava-wrapper'>
                    <div class='squad-ava squad-slot-taken'>
                        <img src='<?php echo $path['img']; ?>ava_default.png' class='squad-ava-img'>
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

            <div class='bot-mid-notifications'>

            </div>

            <div class='chat-preview'>

                <!-- Right Side / Chat -->
                <div class='chat'>
                    <div class='chat-container'>
                        <div class='chat-groups'>
                            <img src='<?php echo $path['img']; ?>chat_arrow.svg' class='chat-arrow-left'>
                            <div class='chats-groups-wrapper'>
                                <div class='chat-hrz-wr' id='chat-hrz'>
                                    <div class='chat-group chat-group-active' id='all-chat'>
                                        <span class='chat-group-title'>All Chat</span>
                                        <br><span class='chat-group-desc'><span class='number'>590</span> online</span>
                                    </div>
                                    <div class='chat-group' id='squad-chat'>
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


                        <div class='chat-content'>
                            <div class='chat-scroll'>
                                <span class='chat-lobby-notification'></span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class='chat-preview-wr'>
                    <div class='chat-content'>
                        <div class='chat-scroll-preview'>
                            <div class="sidebar-chat-post">
                                <div class="chat-post-content">
                                    <div class="chat-info">
                                        <a class="sidebar-chat-username"></a>
                                    </div>
                                    <div class="sidebar-chat-message"></div>
                                </div>
                            </div>
                            <div class="sidebar-chat-post">
                                <div class="chat-post-content">
                                    <div class="chat-info">
                                        <a class="sidebar-chat-username"></a>
                                    </div>
                                    <div class="sidebar-chat-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='chat-input'>
                    <input type=text class='chat-input-text' placeholder="Write something">
                    <img src='<?php echo $path['img']; ?>send-msg-ico.svg' class='send-ico'>
                </div>
            </div>


        </div>

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
                        <div class='game-mode-box'>All Pick</div>
                        <div class='game-mode-box'>ARAM</div>
                        <div class='game-mode-box'>SWAG</div>
                        <div class='game-mode-box'>Captain's Draft</div>
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
</body>

<script type="text/javascript" src='bootstrap/js/games_chat.js'></script>
<script type="text/javascript" src="bootstrap/js/games_league.js"></script>
<script type="text/javascript" src="bootstrap/js/games_lobby.js"></script>
<script type="text/javascript" src="bootstrap/js/games_lobby_role.js"></script>
<script type="text/javascript" src="bootstrap/data/lobby-data-league.js"></script>
<script type="text/javascript" src="bootstrap/js/moment.js"></script>
<script type="text/javascript" src="bootstrap/js/jquery.timeago.js"></script>
<script type="text/javascript" src="bootstrap/js/odometer.js"></script>
<script>
    $(".sidebar-queue-start, .sidebar-list-link-game").click(function () {
        if ($(this).hasClass('queue-ready') || $(this).hasClass('sidebar-list-link-game')) {
            GamesLeague_queueStartTransforms();
            GamesLeague_HideMatchFilters();
            GamesLeague_queueLoadLobby();
            $(lobbyData["Lobby Role"]).insertAfter($('.lobby-wr'));
            setTimeout(function () {
                GamesLobby_Roles();
            }, 500);
            clearInterval(galleryLoop);
            GamesLobby_SwapChat();
            setTimeout(function () {
                GamesLobby_selectRole('AX.Aeon.피자', '<?php echo $path['img']; ?>ava_sample_3.png', '#support', 'other');
            }, 6000);
        } else {};
    })
</script>


</html>
