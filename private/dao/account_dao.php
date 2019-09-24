<?php

    function insert_person($person)
    {
        global $db;
        
        // prepare an insert statement
        $sql = "INSERT INTO persons ";
        $sql .= "(first_name, last_name, ";
        $sql .= "birthdate, place_birth, ";
        $sql .= "nationality, phone_number, ";
        $sql .="email) ";
        $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $person['first_name'], $person['last_name'], $person['birthdate'], $person['place_birth'], $person['nationality'], $person['phone_number'], $person['email']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }

    
    function insert_address($address)
    {
        global $db;

        // prepare an insert statement
        $sql = "INSERT INTO address ";
        $sql .= "(person_id, country, ";
        $sql .= "city, npa, ";
        $sql .= "street, address_status) ";
        $sql .= "VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ississ", $address['person_id'], $address['country'], $address['city'], $address['npa'], $address['street'], $address['address_status']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }
    function insert_client_auth($client_auth)
    {
        global $db;

        // prepare an insert statement
        $sql = "INSERT INTO client_auths ";
        $sql .= "(person_id, nip, ";
        $sql .= "password) ";
        $sql .= "VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iss", $client_auth['person_id'], $client_auth['nip'], $client_auth['password']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }
    function insert_iban($iban_number)
    {
        global $db;

        // prepare an insert statement
        $sql = "INSERT INTO ibans ";
        $sql .= "(iban_number) ";
        $sql .= "VALUES (?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $iban_number);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }
    function insert_account_type($type_name)
    {
        global $db;

        // prepare an insert statement
        $sql = "INSERT INTO account_types ";
        $sql .= "(type_name) ";
        $sql .= "VALUES (?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $type_name);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }

    function insert_account($account)
    {
        global $db;
        
        // prepare an insert statement
        $sql = "INSERT INTO accounts ";
        $sql .= "(account_type_id, iban_id, ";
        $sql .= "account_number, overdraft, ";
        $sql .= "interest_rate, balance, ";
        $sql .="owner_type) ";
        $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iisddds", $account['account_type_id'], $account['iban_id'], $account['account_number'], $account['overdraft'], $account['interest_rate'], $account['balance'], $account['owner_type']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                db_disconnect($db);
                exit();
            }
        } else {
            // insert preparement failled
            echo mysqli_error();
            db_disconnect($db);
            exit();
        }
    }
