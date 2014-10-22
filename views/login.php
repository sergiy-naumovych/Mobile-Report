<!DOCTYPE html>
<html lang="en">
    <head>


        <meta charset="utf-8" />
        <title>Login - MobileReport</title>
        <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />


        <style type="text/css">
            IMG {
                vertical-align: bottom;
                margin-right: 5px;
                margin-left: 2px;
            }
        </style>


        <link href="./css/login.css" rel="stylesheet"/>

        <link href="./css/jquery-ui.css" rel="stylesheet"/>

        <link type="text/css" rel="stylesheet" href="./css/main.css" />
        
        <link type="text/css" rel="stylesheet" href="./css/colortip.css" />
        
        <link href='./css/fonts.css' rel='stylesheet' type='text/css'>
        <!--

        <script src="/bundles/modernizr?v=qVODBytEBVVePTNtSFXgRX0NCEjh9U_Oj8ePaSiRcGg1"></script>
        <script src="/bundles/admin?v=s8pYqCynC01TLDLdNVhuXHp6f0z-AkExrf_kND4ahfw1"></script>
        <script type="text/javascript" src="/scripts/jquery.minicolors.min.js"></script>
        <script type="text/javascript" src="/scripts/jquery.mjs.nestedSortable.js"></script>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
        -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

        <script src="//ajax.aspnetcdn.com/ajax/mvc/3.0/jquery.validate.unobtrusive.min.js"></script>


    </head>
    <body>
        <div id="loading"><?php echo $global['loading']; ?></div>
        <header>
            <div class="content-wrapper">
                <div class="float-left">
                    <div class="logo">
                        <b>MOBILE</b>REPORT
                     </div>
                </div>
                <div class="float-right">
                    <section id="login">
                        <div class="header-account">
                            <ul>

                                <li><a href="index.php" id="loginLink"><?php echo $loginPage['loginTopR']; ?></a></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </header>
        <div id="body" style="padding:0px;">

            <section class="content-wrapper main-content clear-fix" >


                <div class="manage-container">
                    <hgroup class="title">
                        <h1><?php echo $loginPage['loginLabel']; ?></h1>
                    </hgroup>



                    <section id="loginForm">
                        <!--<h2>Hesabınızla giriş yapınız</h2>-->
                        <form action="index.php" method="post">
                            <fieldset>
                                <ol>
                                    <li>
                                        <label>
                                            <?php echo $loginPage['username']; ?>
                                        </label>
                                        <input data-val="true" autofocus data-val-required="<?php echo $loginPage['userNameReqMsg']; ?>" id="Login" name="login" type="text" value="" />
                                        <span class="field-validation-valid" data-valmsg-for="login" data-valmsg-replace="true"></span>
                                    </li>
                                    <li>
                                        <label>
                                            <?php echo $loginPage['password']; ?></label>
                                        <input data-val="true" data-val-required="<?php echo $loginPage['passReqMsg']; ?>" id="Password" name="password" type="password" />
                                        <span class="field-validation-valid" data-valmsg-for="password" data-valmsg-replace="true"></span>
                                    </li>
                                 </ol>
                                <input type="submit" class="primaryButton" value="<?php echo $loginPage['loginBtn']; ?>" />
                            </fieldset>
                       </form>    
                    </section>
                </div>
            </section>
        </div>
        <footer>
            <div class="content-wrapper">
                <div class="float-left">
                    <p>&copy; 2014 - <a href="http://matrix-soft.org">Matrix Software</a></p>
                </div>
            </div>
        </footer>
    </body>
</html>
