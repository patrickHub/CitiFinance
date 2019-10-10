<?php
    require_once('db_credentials.php');

    function db_connect()
    {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_db_connect($connection);
        activate_reporting();
        return $connection;
    }

    function activate_reporting()
    {
        $mysqli_driver = new mysqli_driver();
        $mysqli_driver->report_mode = MYSQLI_REPORT_ALL;
    }

    function db_disconnect($connection)
    {
        if (isset($connection)) {
            $connection->close();
        }
    }
    function confirm_db_connect($connection)
    {
        if ($connection->connect_errno) {
            $msg = "Database connection failed: ";
            $msg .=$connection->connect_error;
            $msg .= " (" .  $connection->connect_errno . ")";
            exit($msg);
        }
    }

    function confirm_result_set($result_set)
    {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }
    function db_escape($connection, $string)
    {
        return $connection->real_escape_string($string);
    }
