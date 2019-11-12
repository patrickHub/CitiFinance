<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Citifinance -
        <?php if (isset($page_title)) {
    echo $page_title;
} else {
    echo 'Home';
}
        ?> 
    </title>
    <script src="https://use.fontawesome.com/6e47fdd73a.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Assistant:300|Gothic+A1:300|Noto+Sans+SC:300|Saira:500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo url_for('/js/public.js'); ?>"></script>
   
 
   
     <link rel="stylesheet" href="<?php echo url_for('/css/styles.css'); ?>" />
    </head>
  <body class="body">

        <header class="home-header" >
            <nav>
                <ul class="list-menu large-screen-menu">
                    <li class="menu-item"> 
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-home-24.png'); ?>" alt=""> 
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-paper-money-80.png'); ?>" alt=""> 
                            <span>Wealth</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-transfer-80.png'); ?>" alt=""> 
                            <span>Transfer</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-download-40.png'); ?>" alt=""> 
                            <span>Document</span>
                        </a>
                    </li>
                    <li class="menu-item logo-item">
                        <a class="menu-link logo-link" href="#">
                            <span>CitiFinance</span>
                        </a>
                    </li>
                    <li class="menu-item full-name">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-admin-settings-male-50.png'); ?>" alt=""> 
                            <span>Jane Doe</span>
                        </a>
                    </li>
                    <li class="menu-item logout">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-export-50.png'); ?>" alt=""> 
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
                <ul class="list-menu menu-left small-screen-menu">
                    <button id="btn-toggle-menu" class="menu-item logo-item logo-link">
                        ☰
                    </button>
                    <li class="menu-item toggle"> 
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-home-24.png'); ?>" alt=""> 
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="menu-item toggle">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-paper-money-80.png'); ?>" alt=""> 
                            <span>Wealth</span>
                        </a>
                    </li>
                    <li class="menu-item toggle">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-transfer-80.png'); ?>" alt=""> 
                            <span>Transfer</span>
                        </a>
                    </li>
                    <li class="menu-item toggle">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-download-40.png'); ?>" alt=""> 
                            <span>Document</span>
                        </a>
                    </li>
                    <li class="menu-item full-name toggle">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-admin-settings-male-50.png'); ?>" alt=""> 
                            <span>Jane Doe</span>
                        </a>
                    </li>
                </ul>
                <ul class="list-menu menu-right small-screen-menu">
                    <li class="menu-item logout">
                        <a class="menu-link" href="#">
                            <img src="<?php echo url_for('/images/landingpage_assets/icons8-export-50.png'); ?>" alt=""> 
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>

    </header>
