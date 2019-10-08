<?php

    function insert_person($person)
    {
        global $db;

        $errors = validate_person($person);
        if (!empty($errors)) {
            return $errors;
        }
        
        // prepare an insert statement
        $sql = "INSERT INTO persons ";
        $sql .= "(first_name, last_name, ";
        $sql .= "birthdate, place_birth, ";
        $sql .= "nationality, sex, phone_number, ";
        $sql .="email) ";
        $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $person['first_name'], $person['last_name'], $person['birthdate'], $person['place_birth'], $person['nationality'], $person['sex'], $person['phone_number'], $person['email']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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

        $errors = validate_address($address);
        if (!empty($errors)) {
            return $errors;
        }

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
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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

        $errors = validate_client_auth($client_auth);
        if (!empty($errors)) {
            return $errors;
        }
        // encrypt password before save to the db
        $hashed_password = password_hash($client_auth['password'], PASSWORD_BCRYPT);


        // prepare an insert statement
        $sql = "INSERT INTO client_auths ";
        $sql .= "(person_id, nip, ";
        $sql .= "hashed_password) ";
        $sql .= "VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iss", $client_auth['person_id'], $client_auth['nip'], $hashed_password);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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

    function insert_individual($individual)
    {
        global $db;

        // prepare an insert statement
        $sql = "INSERT INTO individuals ";
        $sql .= "(person_id, iban_id) ";
        $sql .= "VALUES (?, ?)";

        if ($stmt = mysqli_prepare($db, $sql)) {
            // bind varaibles to prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $individual['person_id'], $individual['iban_id']);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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
        
        $errors = validate_account($account);
        if (!empty($errors)) {
            return $errors;
        }

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
                // Close statement
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // insert execute failled
                echo mysqli_error();
                // Close statement
                mysqli_stmt_close($stmt);
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

    function find_client_auth_by_nip($nip)
    {
        global $db;

        $sql = "SELECT * FROM client_auths ";
        $sql .= "WHERE nip='" . db_escape($db, $nip) . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $client_auth = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $client_auth;
    }
    function find_iban_by_iban_number($iban_number)
    {
        global $db;

        $sql = "SELECT * FROM ibans ";
        $sql .= "WHERE iban_number='" . db_escape($db, $iban_number) . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $iban = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $iban;
    }
    function find_account_by_account_number($account_number)
    {
        global $db;

        $sql = "SELECT * FROM accounts ";
        $sql .= "WHERE account_number='" . db_escape($db, $account_number) . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $account = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $account;
    }
    function find_account_types()
    {
        global $db;

        $sql = "SELECT * FROM account_types";

        if ($stmt = $db->prepare($sql)) {
            
            // execute the prepared statement
            if ($stmt->execute()) {

                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            } else {
                // SELECT execute failled
                echo mysqli_error();
                // Close statement
                $stmt->close();
                $db->close();
                exit();
            }
        } else {
            // select preparement failled
            echo mysqli_error();
            $db->close();
            exit();
        }
    }
    function find_account_type_by_id($account_type_id)
    {
        global $db;

        $sql = "SELECT * FROM account_types " ;
        $sql .= "WHERE account_type_id = ? ";
        $sql .=  "LIMIT 1";

        if ($stmt = $db->prepare($sql)) {
            $stmt->bind_param('i', $account_type_id);
            
            // execute the prepared statement
            if ($stmt->execute()) {

                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            } else {
                // SELECT execute failled
                echo mysqli_error();
                // Close statement
                $stmt->close();
                $db->close();
                exit();
            }
        } else {
            // select preparement failled
            echo mysqli_error();
            $db->close();
            exit();
        }
    }
