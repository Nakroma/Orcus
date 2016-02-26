<?php
    // Assign path variables for easier use
    $path = $this->_['path'];
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
    <script src="<?php echo $path['js']; ?>jquery.knob.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $path['js']; ?>greensock/minified/TweenMax.min.js"></script>
</head>

<body>
<div class='sidebar-content-dim'></div>
<!-- Sidebar -->
<div class="gd-sidebar">
    <img src='<?php echo $path['img']; ?>sidebar_bg.jpg' class='gd-sidebar-bg' id='sidebar'>
    <a class='sidebar-hide' id='sidebar-visible'>&nbsp;</a>
    <div class='sidebar-top-links'>
        <a href='#' class='sidebar-list-link'>All</a>&nbsp;&nbsp;-
        <a href='#' class='sidebar-list-link'>MOBAs</a>&nbsp;&nbsp;-
        <span class='sidebar-list-link-game'>League of Legends</span>
    </div>
    <div class='sidebar-squad'>
        <span class='squad-title'>Your Squad</span>
        <a class='squad-leave'>Leave Squad</a>
        <div class='squad-wrapper'>
            <div class='squad-ava-wrapper'>
                <div class='squad-ava-self'>
                    <a href="#" class='squad-name'><img src='<?php echo $path['img']; ?>lobby_host.svg' class='lobby-host'>TotalBiscuit</a>
                </div>
            </div>
            <div class='squad-ava-wrapper'>
                <div class='squad-ava-other-1'><a class='squad-name'>Weaboo_Overlord</a></div>
            </div>
            <div class='squad-ava-wrapper'>
                <div class='squad-ava'><a class='squad-name-blank'>Click to add player</a></div>
            </div>
            <div class='squad-ava-wrapper'>
                <div class='squad-ava'><a class='squad-name-blank'>Click to add player</a></div>
            </div>
            <div class='squad-ava-wrapper' style='padding-right:10px;'>
                <div class='squad-ava'><a class='squad-name-blank'>Click to add player</a></div>
            </div>
            <div class='squad-helper'>
                <div class='squad-open-switch'>
                    <input type='checkbox' id="checkbox-switch" class='checkbox-switch' checked>
                    <label for="checkbox-switch" class='squad-toggle-ico'></label>
                </div>
                <span class='squad-toggle'>Toggle Public Squad</span>
                <span class='squad-open' id='squad-open'>Squad Open</span>
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
                        <span class='sidebar-chat-message'>blyatblyatblyatblyatblyatblyatblyatblyatblyat</span>
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
    <div class='sidebar-news'>
        <div class='sidebar-news-w'>
            <img src='<?php echo $path['img']; ?>News.svg' class='news-ico'>
            <h2 class='news-headline'>OLC now live!</h2>
            <span class='news-text'>Orcus League Championships open for entries. <a href="#" class='sb-read-more'>Read more.</a></span>
        </div>
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


<!-- Content -->
<div class="content">
<div class='lobby'>

    <div class='lobby-header'>
        <div class='lobby-quit'>
            <img src='<?php echo $path['img']; ?>login-close.svg' class='lobby-quit-ico'>
            <span class='lobby-quit-text'>Rage Quit</span>
        </div>
        <div class='lobby-info'>
            <img src='<?php echo $path['img']; ?>info.svg' class='lobby-info-ico'>
            <span class='lobby-info-text'>No money will be lost until match starts</span>
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
        <a href='#' class='user-money'>50 <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'></a>
        <a class='side-menu'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>
    </div>
</nav>

<!-- Suggested Match + Tournament CTA -->
<div class='suggested-match parallax'>
    <img src='<?php echo $path['img']; ?>suggested_match_bg.png' class='suggested-match-bg'>
    <div class='suggested-match-bg-dim'></div>
    <div class='suggested-match-details'>
        <div class='suggestd-match-ava-wrap'>
            <img src='<?php echo $path['img']; ?>ava_sample_3.png'>
        </div>
        <a href='#' class='suggested-match-opp-name'>Alpacko</a>
        <div class='suggested-match-opponent-stats'>
            <div class='suggested-match-stats'>
                <span class='suggested-match-stats-value'>430</span>
                <br>
                <span class='suggested-match-stats-headline'>SKILL</span>
            </div>
            <div class='suggested-match-stats'>
                <span class='suggested-match-stats-value'>30</span>
                <br>
                <span class='suggested-match-stats-headline'>WINS</span>
            </div>
            <div class='suggested-match-stats'>
                <span class='suggested-match-stats-value'>4</span>
                <br>
                <span class='suggested-match-stats-headline'>LOST</span>
            </div>
        </div>
        <div class='suggested-match-join-skip'>
            <a href='#' class='sgt-mtch-btn'>
                <div class='suggested-match-join' id='activate-lobby'>
                    <div class='suggested-match-join-text'>
                        <span>JOIN</span>
                        <img src='<?php echo $path['img']; ?>currency.svg' style='margin-left:2px; margin-bottom:3px;'>
                        <span class='number' style='margin-left:-2px;'>5</span>
                    </div>
                </div>
            </a>
            <div class='suggested-match-skip'>
                <span class='suggested-match-skip-text'>SKIP</span>
            </div>
        </div>
    </div>
</div>

<div class='match-filter'>
    <span class='sort'>Sort by</span>
    <a class='sort-link-focused'>Entry</a><img src='<?php echo $path['img']; ?>arrow_down.svg' class='descending'>
    <a class='sort-link'>Price Pool</a><img src='<?php echo $path['img']; ?>arrow_down.svg' class='descending'>
    <a class='sort-link'>Avg. Skill</a><img src='<?php echo $path['img']; ?>arrow_down.svg' class='descending'>
    <a class='sort-link'>Friends</a><img src='<?php echo $path['img']; ?>arrow_down.svg' class='descending' style='padding-right:calc(80% - 430px);'>
    <div class='view-wrapper'>
        <span class='view-by'>View By</span>
        <a href='#' class='view-ico-grid'>&nbsp;</a>
        <a href='#' class='view-ico-list'>&nbsp;</a>
    </div>
</div>

<div class='game-preview-wrapper'>
<h1 class='game-mode-h1'>5 vs 5</h1>
<!-- Lobby 1 -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
</div>



<div class='game-preview-wrapper'>

<h1 class='game-mode-h1'>1 vs 1</h1>
<!-- Lobby 1 -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>
<!-- Lobby -->
<div class='game-preview'>
    <div class='game-preview-top'>
        <img src='<?php echo $path['img']; ?>game_preview_bg.png' class='game-preview-bg'>
        <div class='entry'>
            <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'>
            <span class='number'>11 ENTRY</span>
        </div>
        <div class='price-pool'>
            <img src='<?php echo $path['img']; ?>currency.svg' class='price-pool-coins'>
            <span class='number'>830</span>
        </div>
        <div class='avg-skill'>
            <span class='number' style='font-weight:700; margin-right:4px;'>430</span><span class='number'>AVG SKILL</span>
        </div>
    </div>
    <div class='game-preview-title'>
        <div class='team-1'>
            <span class='team-title'>Void Boys</span>
            <p class='team-count'>4/5</p>
        </div>
        <span class='game-preview-vs'>vs.</span>
        <div class='team-2'>
            <span class='team-title'>Team Liquid</span>
            <p class='team-count'>5/5</p>
        </div>
    </div>
</div>



<div class='footer'>
    500 online 20 matches
</div>
</div>
</div>

<script type="text/javascript" src="<?php echo $path['js']; ?>games_league.js"></script>
</body>

</html>
