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
            $client_auth = Client_Auth_Repository::find_client_auth_by_nip($nip);
        } while (isset($client_auth));

        return $nip;
    }

    function generate_bin()
    {
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
            $iban = Iban_Repository::find_iban_by_iban_number($iban_number);
        } while (isset($iban));

        return $iban_number;
    }
    function generate_account_number()
    {
        $account_number = "";
        $account = null; //14-78555-4

        do {
            $account_number = date('y') . "-";
            for ($i = 0; $i<5; $i++) {
                $account_number .= mt_rand(0, 9);
            }
            $account_number .=  "-" . mt_rand(0, 9);

            // verify that $account_number does not exist in database
            $account = Account_Repository::find_account_by_account_number($account_number);
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
    function generate_pdf_individual_account_summary($person, $address, $client_auth, $account)
    {
        $person_detail = [];
        $address_detail = [];
        $client_auth_detail =[];
        $account_detail = [];
        foreach ($person as $key=>$value) {
            if (strpos($key, '_id') === false) {
                $field = str_replace('_', ' ', $key);
                $person_detail[ucfirst($field)] = $person[$key];
            }
        }
        foreach ($address as $key=>$value) {
            if (strpos($key, '_id') === false && strpos($key, 'address_status') === false) {
                $field = str_replace('_', ' ', $key);
                $address_detail[ucfirst($field)] = $address[$key];
            }
        }
        foreach ($client_auth as $key=>$value) {
            if ($key == 'password' || $key == 'nip') {
                $client_auth_detail[ucfirst($key)] = $client_auth[$key];
            }
        }
        foreach ($account as $key=>$value) {
            if (strpos($key, '_id') === false && strpos($key, 'owner_type') === false) {
                $field = str_replace('_', ' ', $key);
                $account_detail[ucfirst($field)] = $account[$key];
            }
        }
        // currency to overdraft and balance
        $account_detail['Overdraft'] = $account_detail['Overdraft'] . ' ' . 'CHF';
        $account_detail['Balance'] = $account_detail['Balance'] . ' ' . 'CHF';
        
        $pdf = new PDFDoc();
        $pdf->addPage();
        $pdf->add_section('/images/landingpage_assets/icons8-contact-details-128.png', 'About me', $person_detail);
        $pdf->add_section('/images/landingpage_assets/icons8-location-30.png', 'My address', $address_detail);
        $pdf->add_section('/images/landingpage_assets/icons8-forgot-password-64.png', 'My login informations', $client_auth_detail);
        $pdf->add_section('/images/landingpage_assets/icons8-bank-card-missing-30.png', 'My account', $account_detail);
        $pdf->Output('./accounts_pdf_summary/account_' . $account['account_number'] . '.pdf', 'F');
    }
