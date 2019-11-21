<?php

    function url_for($script_path)
    {

        // check if script_path starts with '/'
        if ($script_path[0] != "/") {
            $script_path  = "/" . $script_path;
        }
        return WWW_ROOT . $script_path;
    }

    function u($string = "")
    {
        return urlencode($string);
    }

    function raw_u($string = "")
    {
        return rawurlencode($string);
    }

    function h($string = "")
    {
        return htmlspecialchars($string);
    }

    function error_404()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        exit();
    }

    function error_500()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
        exit();
    }
    function is_post_request()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    function is_get_request()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    function redirect_to($location)
    {
        header('location: ' . $location);
        exit;
    }
    function get_desc_for_imm_transfer($from_account_id, $to_account_id)
    {
        $from_account = Account_Repository::get_by_id($from_account_id);
        $to_account = Account_Repository::get_by_id($to_account_id);
        $messages = [];
        $messages['from'] = "";
        $messages['to'] = "";

        if ($from_account['account_type_id'] === 1) {
            $messages['from'] = 'ADD FR CHECK';
            switch ($to_account['account_type_id']) {
                case 2: {
                    $messages['to'] = 'ADD TO SAVING';
                break;
                }
                case 3: {
                    $messages['to'] = 'ADD TO DEPOT';
                break;
                }
                case 4: {
                    $messages['to'] = 'ADD TO RETIRE';
                break;
                }

            }
        } elseif ($from_account['account_type_id'] === 2) {
            $messages['from'] = 'ADD FR SAVING';
            switch ($to_account['account_type_id']) {
                    case 1: {
                        $messages['to'] = 'ADD TO CHECK';
                    break;
                    }
                    case 3: {
                        $messages['to'] = 'ADD TO DEPOT';
                    break;
                    }
                    case 4: {
                        $messages['to'] = 'ADD TO RETIRE';
                    break;
                    }
    
                }
        } elseif ($from_account['account_type_id'] === 3) {
            $messages['from'] = 'ADD FR DEPOT';
            switch ($to_account['account_type_id']) {
                    case 1: {
                        $messages['to'] = 'ADD TO CHECK';
                    break;
                    }
                    case 2: {
                        $messages['to'] = 'ADD TO SAVING';
                    break;
                    }
                    case 4: {
                        $messages['to'] = 'ADD TO RETIRE';
                    break;
                    }
    
                }
        } elseif ($from_account['account_type_id'] === 4) {
            $messages['from'] = 'ADD FR RETIRE';
            switch ($to_account['account_type_id']) {
                    case 1: {
                        $messages['to'] = 'ADD TO CHECK';
                    break;
                    }
                    case 2: {
                        $messages['to'] = 'ADD TO SAVING';
                    break;
                    }
                    case 3: {
                        $messages['to'] = 'ADD TO DEPOT';
                    break;
                    }
    
                }
        }
        return $messages;
    }
