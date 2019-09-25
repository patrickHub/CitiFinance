<?php

    function generate_nip()
    {
        global $db;

        $nip = "";
        $client_auth = null;

        do {
            $nip = "1";

            for ($i = 0; $i<8; $i++) {
                $nip .= mt_rand(0, 9);
            }
            // verify that $nip does not exist in database
            $sql = "SELECT * FROM client_auths ";
            $sql .= "WHERE nip='" . $nip . "'";

            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $client_auth = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } while (isset($client_auth));

        return $nip;
    }

    function generate_bin()
    {
        global $db;

        $bin = ""; // 5485 0000 4755 9634
        $bank_card = null;

        do {
            $bin = "5";

            for ($i = 0; $i<15; $i++) {
                $bin .= mt_rand(0, 9);
                if ((preg_match_all('/[^ ]/', $bin) % 4 == 0) && ($i < 14)) {
                    $bin .= " ";
                }
            }
            // verify that $bin does not exist in database
            $sql = "SELECT * FROM bank_cards ";
            $sql .= "WHERE bin='" . $bin . "'";

            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $bank_card = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } while (isset($bank_card));

        return $bin;
    }
    function generate_iban_number()
    {
        global $db;

        $iban_number = ""; // CH52 0485 0000 1955 5864 0
        $iban = null;

        do {
            $iban_number = "CH" . mt_rand(5, 9) . mt_rand(1, 4) . " ";

            for ($i = 0; $i<15; $i++) {
                $iban_number .= mt_rand(0, 9);
                if ((preg_match_all('/[^ ]/', $iban_number) % 4 == 0)) {
                    $iban_number .= " ";
                }
                if (strlen($iban_number) == 15) {
                    $iban_number .= date('y');
                }
            }
            // verify that $iban_number does not exist in database
            $sql = "SELECT * FROM ibans ";
            $sql .= "WHERE iban_number='" . $iban_number . "'";

            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $iban = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } while (isset($iban));

        return $iban_number;
    }
    function generate_account_number()
    {
        global $db;

        $account_number = "";
        $account = null; //14-78555-4

        do {
            $account_number = date('y') . "-";
            for ($i = 0; $i<5; $i++) {
                $account_number .= mt_rand(0, 9);
            }
            $account_number .=  "-" . mt_rand(0, 9);

            // verify that $account_number does not exist in database
            $sql = "SELECT * FROM accounts ";
            $sql .= "WHERE account_number='" . $account_number . "'";

            $result = mysqli_query($db, $sql);
            confirm_result_set($result);
            $account = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
        } while (isset($account));

        return $account_number;
    }
    
    /*
        0 - 1000 => 0.001 000
        0 - 10 000 => 0. 000 100
        0 - 100 000 => 0. 000 010
        0 - 1 000 000 => 0. 000 001
    */
    function generate_interest_rate($overdraft)
    {
        global $db;

        $interest_rate = 0.000000;

        if ($overdraft >= 0.00 && $overdraft < 1000.00) {
            $interest_rate = $interest_rate + 0.001000;
        } elseif ($overdraft >= 1000.00 && $overdraft < 10000.00) {
            $interest_rate = $interest_rate + 0.000100;
        } elseif ($overdraft >= 10000.00 && $overdraft < 100000.00) {
            $interest_rate = $interest_rate + 0.000010;
        } elseif ($overdraft >= 100000.00 && $overdraft < 1000000.00) {
            $interest_rate = $interest_rate + 0.000001;
        }
       
        return $interest_rate;
    }
