<?php
    // Assign path variables for easier use
    $path = $this->_['path'];
    $templateSidebar = $this->_['templateSidebar'];
?>

    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Orcus - All Games</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="<?php echo $path['css']; ?>games.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Titillium+Web:200,400' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,500' rel='stylesheet' type='text/css'>
        <script src="<?php echo $path['js']; ?>ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo $path['js']; ?>jquery.knob.min.js"></script>
        <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
        <script src="<?php echo $path['js']; ?>games.js"></script>
        <script src="<?php echo $path['js']; ?>modernizr-custom.js"></script>

    </head>

    <body>

        <div class='sidebar-content-dim'></div>
        <!-- Menu Open -->
        <div class='menu-open'>
            <div class='menu-ava'></div>
            <div class='menu-group-1'>
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

            <!-- Sidebar -->
            <div class='gd-sidebar'>
                <div class='header-wrapper'>
                    <img src='<?php echo $path[' img ']; ?>logo_solo.png' class='heading-icon'>
                    <img src='<?php echo $path[' img ']; ?>orcus_font.png' class='heading-font'>

                </div>
                <div class='header-search'>
                    <span class='header-search-font'>Search game</span>
                    <input type='text' class='header-input' placeholder='e.g. Hearthstone'>
                </div>

                <div id="ml-menu" class="menu">
                    <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
                    <div class="menu__wrap">
                        <ul data-menu="main" class="menu__level">
                            <li class="menu__item"><a class="menu__link" data-submenu="submenu-1" href="#">MOBAs</a></li>
                            <li class="menu__item"><a class="menu__link" data-submenu="submenu-2" href="#">Counter Strike</a></li>
                            <li class="menu__item"><a class="menu__link" href="#">Hearthstone</a></li>
                            <li class="menu__item"><a class="menu__link" data-submenu="submenu-4" href="#">Call of Duty</a></li>
                        </ul>
                        <!-- Submenu 1 -->
                        <ul data-menu="submenu-1" class="menu__level">
                            <li class="menu__item"><a class="menu__link" href="#">Dota 2</a></li>
                            <li class="menu__item"><a class="menu__link" href="#">League of Legends</a></li>
                        </ul>
                        <!-- Submenu 2 -->
                        <ul data-menu="submenu-2" class="menu__level">
                            <li class="menu__item"><a class="menu__link" href="#">CS:GO</a></li>
                            <li class="menu__item"><a class="menu__link" href="#">CSS</a></li>
                        </ul>
                        <!-- Submenu 4 -->
                        <ul data-menu="submenu-4" class="menu__level">
                            <li class="menu__item"><a class="menu__link" href="#">Black Ops 3</a></li>
                            <li class="menu__item"><a class="menu__link" href="#">Advanced Warfare</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <?php
    include $templateSidebar;
?>

                  <div class="content">
        <div class='game-groups'>
            <div class='games-group-1'>
                <div class='game-g-1-container csgo'>
                    <img src='<?php echo $path['img']; ?>csgo_game_full_bg.png' class='game-bg csgo-bg'>
                    <a href='#' class='game-g-1'>
                        <img src='<?php echo $path['img']; ?>CSGO_game_bg.png' class='game-g-1-bg'>
                        <img src='<?php echo $path['img']; ?>csgo_preview.png' class='game-csgo-logo'>
                    </a>
                    <h2 class='game-g-1-name'>Counter Strike Global Offensive</h2>
                    <div class='game-g-1-name-border'></div>
                    <div class='game-stats-container'>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                4300
                            </span>
                            <span class='game-stats-property'>
                                PLAYERS
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                320
                            </span>
                            <span class='game-stats-property'>
                                LOBBIES
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                0
                            </span>
                            <span class='game-stats-property'>
                                EVENTS
                            </span>
                        </div>
                    </div>
                </div>
                <div class='game-g-1-container dota'>
                    <img src='<?php echo $path['img']; ?>dota_bg.png' class='game-bg dota-bg' id='dota'>
                    <a href='#' class='game-g-1'>
                        <img src='<?php echo $path['img']; ?>dota_game_bg.png' class='game-g-1-bg'>
                        <img src='<?php echo $path['img']; ?>dota_preview.png' class='game-dota-logo'>
                    </a>
                    <h2 class='game-g-1-name'>Defense of the Ancients</h2>
                    <div class='game-g-1-name-border'></div>
                    <div class='game-stats-container'>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                4300
                            </span>
                            <span class='game-stats-property'>
                                PLAYERS
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                320
                            </span>
                            <span class='game-stats-property'>
                                LOBBIES
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                0
                            </span>
                            <span class='game-stats-property'>
                                EVENTS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class='games-group-1'>
                <div class='game-g-1-container lol'>
                    <img src='<?php echo $path['img']; ?>league_game_full_bg.png' class='game-bg lol-bg'>
                    <a href='#' class='game-g-1'>
                        <img src='<?php echo $path['img']; ?>lol_game_bg.png' class='game-g-1-bg'>
                        <img src='<?php echo $path['img']; ?>league_preview.png' class='game-dota-logo'>
                    </a>
                    <h2 class='game-g-1-name'>League of Legends</h2>
                    <div class='game-g-1-name-border'></div>
                    <div class='game-stats-container'>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                4300
                            </span>
                            <span class='game-stats-property'>
                                PLAYERS
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                320
                            </span>
                            <span class='game-stats-property'>
                                LOBBIES
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                0
                            </span>
                            <span class='game-stats-property'>
                                EVENTS
                            </span>
                        </div>
                    </div>
                </div>
                <div class='game-g-1-container hearthstone'>
                    <img src='<?php echo $path['img']; ?>hearthstone_game_full_bg.png' class='game-bg hearthstone-bg'>
                    <a href='#' class='game-g-1'>
                        <img src='<?php echo $path['img']; ?>hearthstone_game_bg.png' class='game-g-1-bg'>
                        <img src='<?php echo $path['img']; ?>hearthstone_preview.png' class='game-hearthstone-logo'>
                    </a>
                    <h2 class='game-g-1-name'>Hearthstone</h2>
                    <div class='game-g-1-name-border'></div>
                    <div class='game-stats-container'>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                4300
                            </span>
                            <span class='game-stats-property'>
                                PLAYERS
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                320
                            </span>
                            <span class='game-stats-property'>
                                LOBBIES
                            </span>
                        </div>
                        <div class='game-stats'>
                            <span class='game-stats-value'>
                                0
                            </span>
                            <span class='game-stats-property'>
                                EVENTS
                            </span>
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
        </div>
    </div>
                <script src="<?php echo $path['js']; ?>games.js"></script>
                <script src="<?php echo $path['js']; ?>classie.js"></script>
                <script src="<?php echo $path['js']; ?>dummydata.js"></script>
                <script src="<?php echo $path['js']; ?>main.js"></script>
    </body>

    </html>
