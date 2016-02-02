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
    <title>Orcus</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="<?php echo $path['css']; ?>landingpage.css" rel="stylesheet">
    <link href="<?php echo $path['css']; ?>odometer-theme-default.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:200' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,200' rel='stylesheet' type='text/css'>
    <script src="<?php echo $path['js']; ?>jquery.min.js"></script>
    <script src="<?php echo $path['js']; ?>jquery.knob.min.js"></script>
    <script src="<?php echo $path['js']; ?>bootstrap.min.js"></script>
    <script src="<?php echo $path['js']; ?>landingpage.js"></script>
    <script src="<?php echo $path['js']; ?>odometer.js"></script>
</head>

<body style='background-color:black;'>
<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class='menu-font'>MENU</span>
                <img src='<?php echo $path['img']; ?>hamburger.svg' class='menu-ico'>
                <span class="sr-only">Toggle navigation</span>
            </button>
            <a class="orcus-font-menu-anchor" href="#"><img src='<?php echo $path['img']; ?>logo_solo.png' class='orcus-logo-menu'><img src='<?php echo $path['img']; ?>orcus_font.png' class='orcus-font-menu'></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#"><img src='<?php echo $path['img']; ?>lp_header_tournament.svg'>Tournaments</a>
                </li>
                <li>
                    <a href="#"><img src='<?php echo $path['img']; ?>lp_header_leaderboard.svg'>Leaderboards</a>
                </li>
                <li>
                    <a href="#" style='margin-top:16px; min-width:140px;'><img src='<?php echo $path['img']; ?>lp_header_games.svg'>Games</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#login-modal">Sign Up</a></li>
                <li><a href='#' data-toggle="modal" data-target="#login-modal2">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- BEGIN # MODAL REGISTRATION -->
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

                <form action="?view=scr_registration" method="POST" enctype="multipart/form-data">
                    <span class="input input--jiro">
                        <input class="input__field input__field--jiro" name="email" type="text" required/>
                        <label class="input__label input__label--jiro">
                            <span class="input__label-content input__label-content--jiro">E-Mail <span class='input-content'>entered.email@gmail.com</span></span>
                        </label>
                    </span>
                    <span class="input input--jiro">
                        <input class="input__field input__field--jiro" name="password" type="password" required/>
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
                </form>

        </div>
    </div>
</div>
<!-- END # MODAL REGISTRATION -->

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class='container row' style='margin-top:22vh; margin-right: auto; margin-left: auto;'>

        <!-- Left -->
        <div class='col-md-4 login-left'>
            <img src='<?php echo $path['img']; ?>login-bg.png' class='login-bg'>
            <img src="<?php echo $path['img']; ?>logo_solo.png" class='login-logo'>
            <br>
            <span class='sign-up-headline'>LOGIN</span>
            <br>
            <span class='sign-up-swap-headline'>Need an account?</span>
            <br>
            <a href='#' class='sign-up-swap'>Register a new account</a>
        </div>

        <!-- Right-->
        <div class='col-md-8 login-right'>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src='<?php echo $path['img']; ?>login-close.svg' aria-hidden="true" class='login-close'>
            </button>
            <span class='login-headline'>Log in to your account</span>
            <div class='login-sub-headline-wrapper'>
                <img src='<?php echo $path['img']; ?>steam.svg' class='steam-ico'>
                <a href='#' class='login-sub-headline'>Sign in through Steam</a>
            </div>

            <form action="?view=scr_login" method="POST" enctype="multipart/form-data">
                    <span class="input input--jiro">
                        <input class="input__field input__field--jiro" name="email" type="text" required/>
                        <label class="input__label input__label--jiro">
                            <span class="input__label-content input__label-content--jiro">E-Mail <span class='input-content'>entered.email@gmail.com</span></span>
                        </label>
                    </span>
                    <span class="input input--jiro">
                        <input class="input__field input__field--jiro" name="password" type="password" required/>
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
                    <button type="submit" class="login-btn">Login</button>

                </div>
            </form>

        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->

<!-- Vid-BG -->
<img src='<?php echo $path['img']; ?>top shade.png' class='top-shade'>
<div class='vid-pattern'></div>
<video loop muted autoplay poser="<?php echo $path['img']; ?>lp_header.png" class="video">
    <source src="<?php echo $path['video']; ?>header.mp4" type="video/mp4">
    <source src="<?php echo $path['video']; ?>header.ogv" type="video/ogv">
    <source src="<?php echo $path['video']; ?>header.webm" type="video/webm">
</video>


<!-- Header -->
<div class='header' id='fade'>
    <div class='header-bg'></div>
    <div class='container'>
        <h1>Bet on your Gaming Skills!</h1>
        <h2>Real esports - Open for everyone</h2>
        <a href="#">
            <div class='header-cta' data-toggle="modal" data-target="#login-modal">GET STARTED TODAY</div>
        </a>
    </div>
</div>


<!-- What can i do? -->
<div class='top-ind'><img src='<?php echo $path['img']; ?>top-indicator-accent.svg' class='top-ind-acc'></div>
<div class='hdiw-top-headline'>
    <span>WHAT CAN I DO AT</span>
    <br><img src='<?php echo $path['img']; ?>orcus_font.png' class='orcus-font-hdiw'>
    <br><img src='<?php echo $path['img']; ?>hdiw-headline-accent2.svg' style='margin-top:-240px;'>
</div>

<!-- Row 1 -->
<div class='container-fluid parallax' style='position:relative; background-color:#0a0c0f; overflow:hidden;'>
    <img src='<?php echo $path['img']; ?>hdiw-challenge-bg.png' class='hdiw-bg-1'>
    <div class='hdiw-top-smoothing'></div>
    <div class='row container'>
        <div class='col-md-5'>
            <h2 class='hwdi-desc-headline'><img src='<?php echo $path['img']; ?>hdiw-headline-accent.svg' style='margin-bottom:7px; padding-right:10px;'>Challenge the World<span class='unncessary-tm'>™</span></h2>
                <span class='hwdi-desc'>Going forward, our world-class best practice will deliver value to industry leaders. Key players will take ownership of their team players by globally impacting knowledge transfer stand-ups.
                <br>
                <br>

                <br>
                </span>
            <img src='<?php echo $path['img']; ?>hwid-team.svg' class='hdiw-note-ico'><span class='hwdi-desc-list'>Easy Team Creation</span>
            <br>
            <span class='hwdi-note'>Playing with your friends has never been easier!<br>Simply send them your link and you're good to go.</span>
            <br>
            <img src='<?php echo $path['img']; ?>hwid-matchmaking.svg' class='hdiw-note-ico' style='margin-left:7px; padding-right:16px '><span class='hwdi-desc-list'>Buzzword Matchmaking</span>
            <br>
            <span class='hwdi-note'>With our Skill Evaluation Algorithm you'll<br> always find the right opponents.</span>
        </div>
        <div class='col-md-7 hdiw-preview'>
            <img src='<?php echo $path['img']; ?>hdiw-desktop-mockup.png' style='margin-left:160px;'>
            <img src='<?php echo $path['img']; ?>hdiw-phone-mockup.png' class='hdiw-phone'>
            <img src='<?php echo $path['img']; ?>hdiw-zoom.png' class='hdiw-zoom'>
            <img src='<?php echo $path['img']; ?>hwid-matchmaking.svg' class='hdiw-zoom zoom-ico'>
        </div>
    </div>
</div>

<!-- Row 2 -->
<div class='container-fluid parallax2' style='position:relative; background-color:#11151a; overflow:hidden;'>
    <img src='<?php echo $path['img']; ?>hdiw-invest-bg.png' class='hdiw-bg-2'>
    <div class='row container' id='fade-02' style='margin-top:40px; margin-bottom:10px;'>
        <div class='col-md-5'>
            <h2 class='hwdi-desc-headline'><img src='<?php echo $path['img']; ?>hdiw-headline-accent.svg' style='margin-bottom:7px; padding-right:10px;'>Streamlined Investments <span class='hwdi-note' style='margin-left:2px;'>(Coming March 2016)</span></h2>
                <span class='hwdi-desc'>Think you have vast eSports knowledge but don't want to compete on your own? Our unique investment system is what you need! Fund the match entry for any player and get a share of the profit upon winning.
                <br>
                <br>

                <br>
                </span>
            <img src='<?php echo $path['img']; ?>hdiw-stats.svg' class='hdiw-note-ico' style='padding-right:20px;'><span class='hwdi-desc-list'>All Stats in One View</span>
            <br>
            <span class='hwdi-note'>We will provide you with the most in-depth statistics imaginable  to make sure you find the right peers.</span>
            <br>
            <img src='<?php echo $path['img']; ?>hdiw-workflow.svg' class='hdiw-note-ico' style='margin-left:7px; padding-right:22px;'><span class='hwdi-desc-list'>Optimized Calculation Workflow</span>
            <br>
            <span class='hwdi-note'>Nothing is being left to chance. Enjoy the ease of investment while we do all the maths for you. </span>
        </div>
        <div class='col-md-7 hdiw-preview'>
            <img src='<?php echo $path['img']; ?>hdiw-desktop-mockup2.png' style='margin-left:160px;'>
        </div>
    </div>
</div>

<!-- Row 3 -->
<div class='container-fluid parallax3' style='position:relative; background-color:#0a0c0f; overflow:hidden;'>
    <img src='<?php echo $path['img']; ?>hdiw-tournament-bg2.png' class='hdiw-bg-4'>
    <img src='<?php echo $path['img']; ?>hdiw-tournament-bg.png' class='hdiw-bg-3' align='right'>
    <div class='row container' id='fade-03' style='margin-top:40px;'>
        <div class='col-md-5'>
            <h2 class='hwdi-desc-headline'><img src='<?php echo $path['img']; ?>hdiw-headline-accent.svg' style='margin-bottom:7px; padding-right:10px;'>Competitive Tournaments</h2>
                <span class='hwdi-desc'>Think you have vast eSports knowledge but don't want to compete on your own? Our unique investment system is what you need! Fund the match entry for any player and get a share of the profit upon winning.
                <br>
                <br>

                <br>
                </span>
            <img src='<?php echo $path['img']; ?>hwid-team.svg' class='hdiw-note-ico'><span class='hwdi-desc-list'>All Stats in One View</span>
            <br>
            <span class='hwdi-note'>We will provide you with the most in-depth statistics imaginable  to make sure you find the right peers.</span>
            <br>
            <img src='<?php echo $path['img']; ?>hwid-matchmaking.svg' class='hdiw-note-ico'><span class='hwdi-desc-list'>Optimized Calculation Workflow</span>
            <br>
            <span class='hwdi-note'>Nothing is being left to chance. Enjoy the ease of investment while we do all the maths for you. </span>
        </div>
        <div class='col-md-7 hdiw-preview'>
            <img src='<?php echo $path['img']; ?>hdiw-tournament.png' style='margin-top:-80px;margin-left:200px; height:600px;'>
        </div>
    </div>
</div>
<!-- /.hdiw -->

<!-- Stats -->
<div class='container-fluid stats-bg'>
    <div class='container row'>
        <div class='col-md-2'></div>
        <div class='col-md-4'>
            <span class='stats-upper'>128</span>
            <br>
            <span>MATCHES PLAYED</span>
        </div>
        <div class='col-md-4'>
            <span class='stats-upper'>5,324</span>
            <br>
            <span style='display:inline-block; margin-bottom:60px;'>MONEY PAID</span>
        </div>
        <div class='col-md-2'></div>
    </div>
</div>


<!-- Bot CTA -->
<div class='container-full bot-cta-bg'>
    <div class='container'>
        <span class='bot-cta-bold'>Be one of the first!</span><span class='bot-cta-regular'> Win a reward of your choice during the</span><span class='bot-cta-bold'> first <span class='number'>5000</span> matches.</span>
        <div class='row'>
            <!-- AWP -->
            <div class='col-md-4'>
                <div class='bot-cta-wrapper-awp'>
                    <img src='<?php echo $path['img']; ?>bot_cta_awp_2.png' class='bot-cta-img'>
                    <h1 class='bot-cta-head'>AWP | Dragon Lore</h1>
                    <span class='bot-cta-desc-awp'>Minimal Wear <span class='number'>~1.52%</span></span>
                </div>
            </div>
            <!-- Dota -->
            <div class='col-md-4'>
                <div class='bot-cta-wrapper-dota'>
                    <img src='<?php echo $path['img']; ?>bot_cta_dota_2.png' class='bot-cta-img'>
                    <br>
                    <h1 class='bot-cta-head'>Genuine Golden Doomling</h1>
                        <span class='bot-cta-desc-dota'>+All Arcanas<br><span class='bot-cta-desc-dota-2'>+Any items for ~<span class='number'>$500</span></span>
                        </span>
                </div>
            </div>
            <!-- League -->
            <div class='col-md-4'>
                <div class='bot-cta-wrapper-league'>
                    <img src='<?php echo $path['img']; ?>bot_cta_league_2.png' class='bot-cta-img'>
                    <h1 class='bot-cta-head'>All League of Legends Skins</h1>
                    <span class='bot-cta-desc-league'>All Skins obtainable through<br><span class='bot-cta-desc-league-2'>the store</span></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class='hwdi-bot-cta'>
    <a href="#">
        <div class='bot-cta-btn' data-toggle="modal" data-target="#login-modal">SIGN UP NOW</div>
    </a>
</div>

<!-- Games Preview -->
<div class="game-preview">
    <div class="container-full" style='text-align:center;'>
        <a href="#"><img src="<?php echo $path['img']; ?>csgo_preview.png" class='game-preview-img'></a>
        <a href="#"><img src="<?php echo $path['img']; ?>dota_preview.png" class='game-preview-img'></a>
        <a href="#"><img src="<?php echo $path['img']; ?>league_preview.png" class='game-preview-img'></a>
        <a href="#"><img src="<?php echo $path['img']; ?>hearthstone_preview.png" class='game-preview-img'></a>
    </div>
</div>

<!-- Footer -->
<div class="lp-footer">
    <div class='container-full' style='text-align:center;'>
        <img src="<?php echo $path['img']; ?>logo_solo.png" style='opacity:0.2; height:80px;'>
        <br><img src='<?php echo $path['img']; ?>orcus_font.png' class='orcus-font-hdiw' style='margin-top:-25px; opacity:0.2; height:24px;'>
        <br>
        <span class="lp-footer-nav">Support | Impressum | Contact Us | Advertising | Privacy Policy</span>
        <p>All rights reserved. Orcus, Okken are registered trademarks of the Orcus Company
            <br>in the EU, the USA & other countries. All other trademarks are property of their respective owners</p>
        <br>
        <br>
        <br>
    </div>
</div>
</body>
<script src="<?php echo $path['js']; ?>odometer.js"></script>
<script src="<?php echo $path['js']; ?>landingpage.js"></script>

</html>