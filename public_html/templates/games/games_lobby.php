<?php
    // Assign path variables for easier use
    $path = $this->_['path'];
    $skey = $this->_['skey'];
    $templateSidebar = $this->_['templateSidebar'];

    // Page specific vars
    $_d = $this->_;

    // AUTH STUFF HERE
    $_SESSION[$skey] = 15;
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
    <title>Orcus | All Games</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="<?php echo $path['css']; ?>games_league.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600' rel='stylesheet' type='text/css'>
    <script src="<?php echo $path['js']; ?>ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo $path['js']; ?>ajax.googleapis.com/ajax/libs/jquery/ui-1.11.4/jquery-ui.js"></script>
    <script src="<?php echo $path['js']; ?>jquery.knob.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $path['js']; ?>greensock/minified/TweenMax.min.js"></script>

    <!-- Websocket Server -->
    <script>var sid = <?php echo json_encode($sid); ?></script>
    <script type="text/javascript" src="../server/client.js"></script>
    <script>init();</script>
</head>

<!-- Websocket Startup -->
<body class=''>
    <div class='sidebar-content-dim'></div>
    <!-- Sidebar -->
    <div class="gd-sidebar">
        <img src='<?php echo $path['img']; ?>sidebar_bg.jpg' class='gd-sidebar-bg' id='sidebar'>
        <a class='sidebar-hide' id='sidebar-visible'>&nbsp;</a>
        <div class='sidebar-top-links'>
            <a href='#' class='sidebar-list-link'>All</a>&nbsp;&nbsp;-
            <a href='#' class='sidebar-list-link'>MOBAs</a>&nbsp;&nbsp;-
            <span class='sidebar-list-link-game'>LEAGUE</span>
        </div>
        <div class='sidebar-squad'>
            <span class='squad-title'>Your Squad</span>
            <a class='squad-leave'>Leave Squad</a>
            <div class='squad-wrapper'>
                <div class='squad-ava-wrapper'>
                    <div class='squad-ava'><img src='<?php echo $path['img']; ?>ava_sample_1.png' class='squad-ava-img'>
                        <a href="#" class='squad-name' style='margin-top:9px;'><img src='<?php echo $path['img']; ?>lobby_host.svg' class='lobby-host'>TotalBiscuit</a>
                    </div>
                </div>
                <div class='squad-ava-wrapper'>
                    <div class='squad-ava'><img src='<?php echo $path['img']; ?>ava_sample_2.png' class='squad-ava-img'></div>
                    <a class='squad-name'>Weaboo_Overlord</a>
                </div>
                <div class='squad-ava-wrapper'>
                    <div class='squad-ava'></div><a class='squad-name-blank'>Add Player</a>
                </div>
                <div class='squad-ava-last-2'>
                    <div class='squad-ava-wrapper'>
                        <div class='squad-ava'></div><a class='squad-name-blank'>Add Player</a>
                    </div>
                    <div class='squad-ava-wrapper'>
                        <div class='squad-ava'></div><a class='squad-name-blank'>Add Player</a>

                    </div>
                    <div class='squad-helper'>
                        <div class='squad-open-switch'>
                            <input type='checkbox' id="checkbox-switch" class='checkbox-switch' checked>
                            <label for="checkbox-switch" class='squad-toggle-ico'></label>
                            <br>
                        </div>
                    </div>
                </div>


            </div>
            <div class='sidebar-pub-squads'>
                <a class='queue-pub-squads'>Find Squad</a>
                <a class='show-pub-squads'>Show Public Squads</a>
                <div class='queue-bg' id='inactive'></div>
                <div class='queue-loading-container'>
                    <img src="<?php echo $path['img']; ?>puff.svg" width="50" alt="" class='queue-loading'>
                    <span class='queue-status'></span>
                    <a class='close'> <img src='<?php echo $path['img']; ?>login-close.svg' aria-hidden="true" class='queue-quit'></a>
                </div>
            </div>
        </div>

        <div class='sidebar-chat'>
            <span class='squad-chat-title'>Squad Chat</span>
            <a class='chat-inactive' id="chat-option-2">All Chat</a>
            <div class='sidebar-chat-comments-scrollbar'>
                <div class='sidebar-chat-comments'>
                    <span class='sidebar-lobby-note'>You are now connected to the Lobby Chat!</span>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>3 hours ago</span> </a>
                            <br>
                            <span class='sidebar-chat-message'>FURION TP TOP FURION TP TOP FURION</span>
                        </div>
                    </div>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>2 minutes ago</span></a>
                            <br>
                            <span class='sidebar-chat-message'>Me Mid.</span>
                        </div>
                    </div>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>Just now</span></a>
                            <br>
                            <span class='sidebar-chat-message'>blyatblyatblyatblya tblyatblyatblyat blyatblyat</span>
                        </div>
                    </div>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>Just now</span></a>
                            <br>
                            <span class='sidebar-chat-message'>blyatblyatblyatblyat<br>blyatblyatblyatblyatblyat</span>
                        </div>
                    </div>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>Just now</span></a>
                            <br>
                            <span class='sidebar-chat-message'>blyatblyatblyatblyat<br>blyatblyatblyatblyatblyat</span>
                        </div>
                    </div>
                    <div class='squad-chat-post'>
                        <div class='sidebar-chat-ava'></div>
                        <div class='sidebar-chat-text'>
                            <a href='#' class='sidebar-chat-username'> Say not to Autism <span class='sidebar-chat-date'>Just now</span></a>
                            <br>
                            <span class='sidebar-chat-message'>blyatblyatblyatblyat<br>blyatblyatblyatblyatblyat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='chat-input'>
            <input type='text' class='chat-input-box' placeholder='Type a message'>
            <a href="#" class='chat-input-btn'>&nbsp;</a>
        </div>
        <div class='sidebar-bottom-links'>
            <a href='#' class='sidebar-bot-link'>Support </a>|
            <a href='#' class='sidebar-bot-link'>Impressum </a>|
            <a href='#' class='sidebar-bot-link'>Contact Us </a>|
            <a href='#' class='sidebar-bot-link'>Privacy Policy </a>
           </div>
    </div>

    <!-- Menu Open -->
    <div class='menu-open'>
        <div class='menu-ava'></div>
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

    <!-- Content -->
    <div class="content">
        <div class='queue-container'>
             <div class='find-match-btn' id='find-match'>
                <img src='<?php echo $path['img']; ?>find_match_bg.png' class='find-match-btn-bg'>
                <div class='find-match-btn-z-helper'>
                    <img src='<?php echo $path['img']; ?>find_match_ico.svg' class='find-match-ico'>
                    <br>
                    <span class='cta-btn-text'>Find Match</span>
                    <br>
                    <span class='cta-btn-text-desc'><span class='number'>23</span> People in your skill range online!</span>
                </div>
            </div>
            <div class='find-match-btn' id='create-lobby'>
                <img src='<?php echo $path['img']; ?>create_lobby_bg.png' class='find-match-btn-bg'>
                <div class='find-match-btn-z-helper'>
                    <img src='<?php echo $path['img']; ?>find_match_ico.svg' class='find-match-ico'>
                    <br>
                    <span class='cta-btn-text'>Create Lobby</span>
                    <br>
                    <span class='cta-btn-text-desc'><span class='number'>4.000</span> People currently in queue!</span>
                </div>
            </div>
             <div class='find-match-btn' id='invest' style='cursor:default;'>
                <img src='<?php echo $path['img']; ?>invest_bg.png' class='find-match-btn-bg'>
                <div class='find-match-btn-z-helper'>
                    <img src='<?php echo $path['img']; ?>find_match_ico.svg' class='find-match-ico'>
                    <br>
                    <span class='cta-btn-text'>Invest</span>
                    <br>
                    <span class='cta-btn-text-desc'>Coming soon.</span>
                </div>
            </div>
        </div>
        <div class='notification-container'>
            <img src='<?php echo $path['img']; ?>notification_seperator.png' class='notification-seperator'><br>
            <div class='notification-wrapper'>
                <div class='notification-ico'></div>
                <h5 class='notification-title'>Investment Return<br> <span class='notification-text'>Received 20$ from Meemy</span></h5>
            </div>
             <div class='notification-wrapper'>
                <div class='notification-ico'></div>
                <h5 class='notification-title'>Investment Return<br> <span class='notification-text'>Received 20$ from Meemy</span></h5>
            </div>
             <div class='notification-wrapper'>
                <div class='notification-ico'></div>
                <h5 class='notification-title'>Investment Return<br> <span class='notification-text'>Received 20$ from Meemy</span></h5>
            </div>
        </div>

        <!-- Queue Status -->
        <div class='match-queue-status'>
            <span class='players-ready'>Players Ready: <span class='number'>6/10</span></span>
            <div class='match-queue-status-desc'>Finding Support...</div>
            <div class='match-queue-team'>
                <div class='team-placeholder player-ready'></div>
                <div class='team-placeholder player-ready'></div>
                <div class='team-placeholder player-ready'></div>
                <div class='team-placeholder player-ready'></div>
                <div class='team-placeholder'></div>
            </div>
            <span class='team-1-2'>vs</span>
            <div class='match-queue-team'>
                <div class='team-placeholder player-ready-2'></div>
                <div class='team-placeholder player-ready-2'></div>
                <div class='team-placeholder player-ready-2'></div>
                <div class='team-placeholder player-ready-2'></div>
                <div class='team-placeholder'></div>
            </div>
        </div>

        <!-- Sidebar Lobby Options -->
        <div class='sidebar-lobby-options filters-hidden'>
            <div class='sidebar-lobby-header'>
                <h3 class='queue-options'>TotalBiscuit</h3>
                <br>
                <a href='#' class='queue-options-hide'>Jungler</a>
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


        <!-- Full Lobby -->
        <div class='lobby'>
            <div class='lobby-header'>
                <div class='lobby-quit'>
                    <img src='<?php echo $path['img']; ?>login-close.svg' class='lobby-quit-ico'>
                    <span class='lobby-quit-text'>Rage Quit</span>
                </div>
                <div class='lobby-info'>
                    <img src='<?php echo $path['img']; ?>info.svg' class='lobby-info-ico'>
                    <span class='lobby-info-text'>Leaving now will cause you to lose your entry</span>
                </div>
                <div class='lobby-details'>
                    <span class='lobby-name'>
                    Lobby <span class='number'>72</span>
                    </span>
                    <span class='lobby-game-mode'>
                    - <span class='number'>5 vs 5</span> - All Pick
                    </span>
                </div>
            </div>
            <div class='lobby-content'>
                <div class='lobby-main'>
                    <div class='lobby-teams'>
                        <div class='lobby-team-1'>
                            <div class='team-header'>
                                <h2 class='team-1-name'>Axiom Esports</h2>
                                <span class='team-ready'><span class='number'>3</span> of <span class='number'>5</span> ready</span>
                            </div>

                            <div class='lobby-players'>
                                <div class='lobby-player'>
                                    <div class='player-ava-wrapper'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                    <a href='#' class='lobby-player-name'>TotalBiscuit</a>
                                    <span class='lobby-player-role'>Tank</span>
                                </div>
                                <div class='lobby-player'>
                                    <div class='player-ava-wrapper'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                    </div>
                                    <a href='#' class='lobby-player-name'>Dondo</a>
                                    <span class='lobby-player-role-nonhost'>Carry Roam</span>
                                </div>
                                <div class='lobby-player'>
                                    <div class='player-ava-wrapper'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                    </div>
                                    <a href='#' class='lobby-player-name'>EG.Sumail</a>
                                    <span class='lobby-player-role-nonhost'>Carry</span>
                                </div>
                                <div class='lobby-player'>
                                    <div class='player-ava-wrapper'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                    </div>
                                    <a href='#' class='lobby-player-name'>EG.ppd</a>
                                    <span class='lobby-player-role-nonhost'>Support</span>
                                </div>
                                <div class='lobby-player'>
                                    <div class='player-ava-wrapper'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                    </div>
                                    <a href='#' class='lobby-player-name'>EG.Universe</a>
                                    <span class='lobby-player-role-nonhost'>Offlane</span>
                                </div>
                            </div>
                        </div>


                        <div class='lobby-teams-middle'>
                            <span class='versus'>vs</span>
                            <div class='lobby-price-pool'>
                                <span class='lobby-price-value'>180<img src='<?php echo $path['img']; ?>currency.svg' class='lobby-price-ico'></span>
                                <span class='lobby-price-text'>PRIZE POOL</span>
                            </div>
                        </div>


                        <div class='lobby-team-2'>
                            <div class='team-header'>
                                <span class='team-ready'><span class='number'>3</span> of <span class='number'>5</span> ready</span>
                                <h2 class='team-2-name'>Axiom Esports</h2>
                            </div>

                            <div class='lobby-players-2'>
                                <div class='lobby-player'>
                                    <a href='#' class='lobby-player-name-2'>TotalBiscuit</a>
                                    <span class='lobby-player-role-2'>Tank</span>
                                    <div class='player-ava-wrapper-2'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                </div>
                                <div class='lobby-player'>
                                    <a href='#' class='lobby-player-name-2'>TotalBiscuit</a>
                                    <span class='lobby-player-role-2'>Tank</span>
                                    <div class='player-ava-wrapper-2'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host' style='visibility:hidden;'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                </div>
                                <div class='lobby-player'>
                                    <a href='#' class='lobby-player-name-2'>TotalBiscuit</a>
                                    <span class='lobby-player-role-2'>Tank</span>
                                    <div class='player-ava-wrapper-2'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host' style='visibility:hidden;'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                </div>
                                <div class='lobby-player'>
                                    <a href='#' class='lobby-player-name-2'>TotalBiscuit</a>
                                    <span class='lobby-player-role-2'>Tank</span>
                                    <div class='player-ava-wrapper-2'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host' style='visibility:hidden;'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                </div>
                                <div class='lobby-player'>
                                    <a href='#' class='lobby-player-name-2'>TotalBiscuit</a>
                                    <span class='lobby-player-role-2'>Tank</span>
                                    <div class='player-ava-wrapper-2'>
                                        <div class='player-ava'>
                                            <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                                        </div>
                                        <div class='player-host' style='visibility:hidden;'>
                                            <img src='<?php echo $path['img']; ?>lobby_host.svg' class='player-host-ico'>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class='lobby-player-self'>
                        <img src='<?php echo $path['img']; ?>lobby_role_bg.png'>
                        <span class='player-sidebar'></span>
                    </div>
                    <div class='lobby-player-other'>

                    </div>
                </div>
            </div>
        </div>
        <!-- Menu -->
        <nav class='user-menu'>
            <div class='user-menu-container'>
                <a href='#' class='user-menu-name'>TotalBiscuit</a>
                <a href='#' class='user-money'>50.00 <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'></a>
                <a class='side-menu'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>
            </div>
        </nav>


    </div>

    <script type="text/javascript" src="bootstrap/js/games_league.js"></script>
</body>


</html>
