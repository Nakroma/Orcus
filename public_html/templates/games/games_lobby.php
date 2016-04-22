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
    <title>Orcus | League of Legends</title>

    <link rel="stylesheet" href="<?php echo $path['css']; ?>bootstrap.min.css">
    <link href="<?php echo $path['css']; ?>games_league.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:300,400' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600' rel='stylesheet' type='text/css'>
    <script src="<?php echo $path['js']; ?>jquery.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script src='<?php echo $path['js']; ?>gallery.js'></script>
    <script src='<?php echo $path['js']; ?>motionblur.js'></script>
    <script src='<?php echo $path['js']; ?>TweenMax.min.js'></script>
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

<body class=''>

<div class='sidebar-content-dim'></div>
<!-- Menu Open -->
<div class='menu-open'>
    <div class='menu-ava'></div>
    <a href='#' class='user-menu-name'><?php echo $_u['username']; ?></a>

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

<!-- Content -->
<div class="content">
<div class='vid-pattern'></div>

<img src='<?php echo $path['img']; ?>game_details_bg_league.jpg' class='content-bg'>

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
            <img src='<?php echo $path['img']; ?>play-ico.svg' class='play-ico'>
            <span class='play-text'>Play</span>
        </div>
        <div class='menu-create'>
            <img src='<?php echo $path['img']; ?>create_lobby_ico.svg' class='create-ico'>
            <span class='create-text'>Create Lobby</span>
        </div>
    </div>
</div>

<!-- Left Side -->
<div class='main-content'>
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
</div>


<!-- Right Side / Chat -->
<div class='chat'>
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
    <div class='chat-content'>
        <div class='chat-scroll'>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava ava-offline'><img src='<?php echo $path['img']; ?>ava_sample_2.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>FatFuckMoh</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava ava-offline'><img src='<?php echo $path['img']; ?>ava_sample_2.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>FatFuckMoh</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis BeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnisBeffnis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <time class='timeago sidebar-chat-date' datetime="2008-07-17T09:24:17Z">Just now</time>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
            <div class='sidebar-chat-post'>
                <div class='chat-ava'><img src='<?php echo $path['img']; ?>ava_sample_3.png' class='chat-ava-img'></div>
                <div class='chat-post-content'>
                    <div class='chat-info'>
                        <a href='#' class='sidebar-chat-username'>Aeon</a>
                        <div class='sidebar-chat-date'>Just now</div>
                    </div>
                    <div class='sidebar-chat-message'>Benis Beffnis Benis Benis</div>
                </div>
            </div>
        </div>

    </div>
    <div class='chat-input'>
        <input type=text class='chat-input-text' placeholder="Write something">
        <img src='<?php echo $path['img']; ?>send-msg-ico.svg' class='send-ico'>
    </div>
    <div class='squad'>
        <div class='squad-ava-self'></div>
        <div class='squad-ava-self-inf'>
            <a href="#" class='squad-self-name'>
                <?php echo $_u['username']; ?>
            </a>
            <br>
            <div class='squad-self-role'>Tank</div>
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
                <input type='text' placeholder='Enter player to invite' class='squad-inv-input' >
                <div class='sidebar-entry-error error-hidden' id='squad-group-error'>Not Found</div>
            </div>
            <div class='leave-squad'><img src='<?php echo $path['img']; ?>logout.svg' class='leave-squad-ico'></div>
        </div>
    </div>
</div>

<!-- Sidebar Lobby Options -->
<div class='sidebar-lobby-options filters-hidden'>
    <div class='sidebar-lobby-header'>
        <h3 class='queue-options'><?php echo $_u['username']; ?></h3>
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
                            <a href='#' class='lobby-player-name'><?php echo $_u['username']; ?></a>
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
                            <a href='#' class='lobby-player-name-2'><?php echo $_u['username']; ?></a>
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
                            <a href='#' class='lobby-player-name-2'><?php echo $_u['username']; ?></a>
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
                            <a href='#' class='lobby-player-name-2'><?php echo $_u['username']; ?></a>
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
                            <a href='#' class='lobby-player-name-2'><?php echo $_u['username']; ?></a>
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
                            <a href='#' class='lobby-player-name-2'><?php echo $_u['username']; ?></a>
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
                <img src='<?php echo $path['img']; ?>lobby_role_bg.png' class='player-side-bg'>
                <div class='lobby-player-content-wr'>
                    <span class='player-sidebar'>Selected Player</span>
                    <br>
                    <div class='player-side-ava player-ava-ready'>
                        <img src='<?php echo $path['img']; ?>ava_sample_4.png' class='player-img'>
                    </div>
                    <div class='player-side-ready-up'>Un-Ready</div>
                </div>

            </div>
            <div class='lobby-player-other'>

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
<script src='<?php echo $path['js']; ?>games_chat.js'></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>games_league.js"></script>
<script type="text/javascript" src="<?php echo $path['js']; ?>moment.js"></script>
<script src="<?php echo $path['js']; ?>jquery.timeago.js"></script>
</body>

</html>