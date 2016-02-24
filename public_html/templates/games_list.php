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
    <title>Orcus - All Games</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="<?php echo $path['css']; ?>games.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:200' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500' rel='stylesheet' type='text/css'>
    <script src="<?php echo $path['js']; ?>ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo $path['js']; ?>jquery.knob.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script src="<?php echo $path['js']; ?>games.js"></script>
    <script src="<?php echo $path['js']; ?>modernizr-custom.js"></script>

</head>

<body>

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

<div class='sidebar-content-dim'></div>


<!-- Sidebar -->
<div class='gd-sidebar'>
    <div class="select-game-header">
        <div class='header-wrapper'>
            <img src='<?php echo $path['img']; ?>gl-game-icon.png' class='heading-icon'>
            <h2 class="dummy-heading">Select a Game</h2>
            <div class='header-search'>
                <span class='header-search-font'>Search game</span>
                <input type='text' class='header-input' placeholder='e.g. Hearthstone'>
            </div>
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

<div class="content">
    <img id='dota' class='game-bg'>
    <!-- Menu -->
    <nav class='user-menu'>
        <div class='user-menu-container'>
            <a href='#' class='user-menu-name'>TotalBiscuit</a>
            <a href='#' class='user-money'>50 <img src='<?php echo $path['img']; ?>currency.svg' style='margin-bottom:3px;'></a>
            <a class='side-menu'><img src='<?php echo $path['img']; ?>hamburger.svg' class='sidebar-menu-ico'></a>
        </div>
    </nav>


</div>
<script src="<?php echo $path['js']; ?>games.js"></script>
<script src="<?php echo $path['js']; ?>classie.js"></script>
<script src="<?php echo $path['js']; ?>dummydata.js"></script>
<script src="<?php echo $path['js']; ?>main.js"></script>
</body>

</html>
