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
    echo 'Welcome';
}
        ?> 
    </title>
    <script src="https://use.fontawesome.com/6e47fdd73a.js"></script>
    <script type="text/javascript" src="<?php echo url_for('/js/public.js'); ?>"></script>

    <link href="https://fonts.googleapis.com/css?family=Assistant:300|Gothic+A1:300|Noto+Sans+SC:300|Saira:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url_for('/css/styles.css'); ?>" />
    <?php
        echo "<style> ";
            if (isset($step) &&  in_array($step, [1,2,3,4,5,6,7])) {
                echo ".open-account-title .step .link-step-1::before { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [2,3,4,5,6,7])) {
                echo ".open-account-title .step .link-step-2::before { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [3,4,5,6,7])) {
                echo ".open-account-title .step .link-step-2::after { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [4,5,6,7])) {
                echo ".open-account-title .step .link-step-3::before { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [5,6,7])) {
                echo ".open-account-title .step .link-step-3::after { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [6,7])) {
                echo ".open-account-title .step .link-step-4::before { background-color: #eb1f1b;}";
            }
            if (isset($step) &&  in_array($step, [7])) {
                echo ".open-account-title .step .link-step-4::after { background-color: #eb1f1b;}";
            }
           
        echo "</style>";
    ?>
</head>
  <body>
    <!-- // Intro -->
    <header class="public-header">
        <div class="top-login">
            <a href="<?php echo url_for('/accounts/open-individual-account.php?step=1'); ?>">Open an Account</a>
            <a href="#"><img src="<?php echo url_for('/images/landingpage_assets/icons8-lock-50.png'); ?>" > <strong>Login</strong></a>

        </div>
        <nav>
            <a class="logo" title="start page" href="#">CitiFinance</a>
            <a class="menu-link" href="#">Your Needs</a>
            <a class="menu-link" href="#">Our Products</a>
            <a class="menu-link-search" title="search" href="#"><img src="<?php echo url_for('/images/landingpage_assets/icons8-search-50.png'); ?>" ></a>
        </nav>
     
    </header>