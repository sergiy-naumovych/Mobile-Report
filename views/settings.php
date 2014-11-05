<!DOCTYPE html>
<html lang="en">
    <head>


        <meta charset="utf-8" />
        <title>MobileReport</title>
        <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <meta name="viewport" content="width=device-width" />



        <link href="css/login.css" rel="stylesheet"/>

        <link href="css/jquery-ui.css" rel="stylesheet"/>

        <link type="text/css" rel="stylesheet" href="css/main.css" />

        <link type="text/css" rel="stylesheet" href="css/colortip.css" />

        <link href='css/fonts.css' rel='stylesheet' type='text/css'>
        
        <link href='css/settings.css' rel='stylesheet' type='text/css'>
        
        
        <!--
        <link href='css/cupertino/jqueryui.css' rel='stylesheet' type='text/css'>
        
        <script src="/bundles/modernizr?v=qVODBytEBVVePTNtSFXgRX0NCEjh9U_Oj8ePaSiRcGg1"></script>
        <script src="/bundles/admin?v=s8pYqCynC01TLDLdNVhuXHp6f0z-AkExrf_kND4ahfw1"></script>
        <script type="text/javascript" src="/scripts/jquery.minicolors.min.js"></script>
        <script type="text/javascript" src="/scripts/jquery.mjs.nestedSortable.js"></script>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
        -->
<!--
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
-->
        <!-- for testing -->
        <script src="js/jquery.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>

        <script src="//ajax.aspnetcdn.com/ajax/mvc/3.0/jquery.validate.unobtrusive.min.js"></script>
        
        
        
        <script src="js/settings.js"></script>
        
        <script src="js/companies.js"></script>
        
        <script src="js/preview.js"></script>
        
        <script src="js/highcharts.js"></script>
        
        

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
                            <?php echo $mainPage['hello']; ?>, <a class="username"><?php echo Main::$user->company; ?></a>
                            <form action="#" id="logoutForm" method="post">
                                <a href="<?php echo URL; ?>/main/logout"><?php echo $mainPage['logout']; ?></a>
                            </form>      

                        </div>
                        
                    </section>
                </div>
            </div>
        </header>
        <div id="body">


            <div class="app-header">
                <div class="app-name">
                    <?php echo $mainPage['adminPanel']; ?>
                </div>
                <div class="commands">
                    <!--<div id="lang">
                        <a href="?l=tur"><img src="img/tur.png" height="15" /></a>
                        <a href="?l=en"><img src="img/en.png" height="15" /></a>
                    </div>-->
                </div>
            </div>

            <table class="main-block">
                <tr>
                    <td class="left-block">
                        <div id="scroller-anchor"></div>
                        <div id="scroller" style="width: 105px;">
                            <input id="user-id" type="number" hidden="hidden" value="<?php echo Main::$user->id; ?>" />
                            <ul class="app-links">
                                <?php if(Main::$user->type == 1 || Main::$user->type == 3 || Main::$user->type == 4){ ?>
                                <li id="settings-menu">
                                    <a href="javascript:none();">
                                        <img src="img/company.png" width="30" height="30" />
                                        <div class="appLink"><?php echo $mainPage['companies']; ?></div>
                                    </a>
                                </li>
                                <li id="serials-menu">
                                    <a href="javascript:none();">
                                        <img src="img/serial.png" width="35" height="30" />
                                        <div class="appLink"><?php echo $mainPage['licenses']; ?></div>
                                    </a>
                                </li>
                                <?php } 
                                
                                if(Main::$user->type == 3){ ?>
                                <li id="subdistributors-menu">
                                    <a href="javascript:none();">
                                        <img src="img/distributor.png" width="30" height="30" />
                                        <div class="appLink"><?php echo $mainPage['subdistributors']; ?></div>
                                    </a>
                                </li>
                                <?php } 
                                
                                if(Main::$user->type == 1){ ?>
                                <li id="distributors-menu">
                                    <a href="javascript:none();">
                                        <img src="img/distributor.png" width="30" height="30" />
                                        <div class="appLink"><?php echo $mainPage['distributors']; ?></div>
                                    </a>
                                </li>
                                <li id="content-menu">
                                    <a href="javascript:none();">
                                        <img src="img/menu-05.png" />
                                        <div class="appLink"><?php echo $mainPage['icons']; ?></div>
                                    </a>
                                </li>
                                
                                <?php } 
                                    
                                if(Main::$user->type == 2){ ?>
                                <li id="company-menu">
                                    <a href="javascript:none();">
                                        <img src="img/settings.png" width="30" height="30" />
                                        <div class="appLink"><?php echo $mainPage['settings']; ?></div>
                                    </a>
                                </li>
                                <li id="categories-menu">
                                    <a href="javascript:none();">
                                        <img src="img/menu-03.png" />
                                        <div class="appLink"><?php echo $mainPage['content']; ?></div>
                                    </a>
                                </li>
                                <li id="push-menu">
                                    <a href="javascript:none();">
                                        <img src="img/push.png" width="30" height="30" />
                                        <div class="appLink"><?php echo $mainPage['push']; ?></div>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>

                        </div>

                    </td>
                    <td class="right-block">
                        <div class="right-block-content">
                            <?php if(Main::$user->type == 1 || Main::$user->type == 3 || Main::$user->type == 4){ ?>
                            <div id="settingsForm">
                                <?php include 'views/companiesForm.php'; ?>
                            </div>
                            <div id="serialsForm">
                                <?php include 'views/serialsForm.php'; ?>
                            </div>
                            <?php } 
                                
                            if(Main::$user->type == 3){ ?>
                            <div id="subdistributorsForm">
                                <?php include 'views/subdistributorsForm.php'; ?>
                            </div>
                            <?php } 
                                
                            if(Main::$user->type == 1){ ?>
                            <div id="distributorsForm">
                                <?php include 'views/distributorsForm.php'; ?>
                            </div>
                            <?php
                            }
                            ?>
                            <div id="contentForm">
                                <?php include 'views/contentForm.php'; ?>
                            </div>
                            <?php  
                                    
                            if(Main::$user->type == 2){ ?>
                            <div id="companyForm">
                                <?php include 'views/companyForm.php'; ?>
                            </div>
                            <div id="categoriesForm">
                                <?php include 'views/categoriesForm.php'; ?>
                            </div>
                            
                            <div id="pushForm">
                                <?php include 'views/pushForm.php'; ?>
                            </div>
                            <?php } ?>
                            <div id="pictures-window">
                                <?php echo ContentPage::$contentLayout; ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

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
