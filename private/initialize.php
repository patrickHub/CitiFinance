<?php

    ob_start(); // turn on output buffering
    session_start(); // turn on the session
    // Assign file paths to PHP constants
    // __FILE__ returns the current path to this file
    // dirname() returns the path to the parent directory
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . "/public");
    define("SHARED_PATH", PRIVATE_PATH . "/shared");
    define("DB_PATH", PRIVATE_PATH . "/db");
    define("DAO_PATH", PRIVATE_PATH . "/dao");
    define("VALIDATION", PRIVATE_PATH . "/validation");

    // Assign the root URL to a PHP constant
    // * Do not need to include the domain
    // * Use same document root as webserver
    // * Can set a hardcoded value:
    // define("WWW_ROOT", '/~patrick-pc/citifinance/public');
    // define("WWW_ROOT", '');
    // * Can dynamically find everything in URL up to "/public"
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('functions.php');
    require_once(DB_PATH . '/db.php');
    require_once(DAO_PATH . '/account_dao.php');
    require_once(SHARED_PATH . '/countries_list.php');
    require_once(VALIDATION . '/validate_account_functions.php');

    $db = db_connect();
