<?php

    require_once('abstract_repository.php');

    class Account_type_Repository extends Repository
    {
        public const TABLE_NAME = "account_types";
    }

    class Person_Repository extends Repository
    {
        public const TABLE_NAME = "persons";

        public static function insert($person)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(first_name, last_name, ";
            $sql .= "birthdate, nationality, ";
            $sql .= "sex, phone_number, ";
            $sql .="email) ";
            $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("sssssss", $person['first_name'], $person['last_name'], $person['birthdate'], $person['nationality'], $person['sex'], $person['phone_number'], $person['email']);

                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }
    class Address_Repository extends Repository
    {
        public const TABLE_NAME = "address";

        public static function insert($address)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(person_id, country, ";
            $sql .= "city, npa, ";
            $sql .= "street, address_status) ";
            $sql .= "VALUES (?, ?, ?, ?, ?, ?)";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("ississ", $address['person_id'], $address['country'], $address['city'], $address['npa'], $address['street'], $address['address_status']);

                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }

    class Client_Auth_Repository extends Repository
    {
        public const TABLE_NAME = "client_auths";

        public static function insert($client_auth)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(person_id, nip, ";
            $sql .= "hashed_password) ";
            $sql .= "VALUES (?, ?, ?)";

            // encrypt password before save to the db
            $hashed_password = password_hash($client_auth['password'], PASSWORD_BCRYPT);

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("iss", $client_auth['person_id'], $client_auth['nip'], $hashed_password);
                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }

        public static function find_client_auth_by_nip($nip)
        {
            $sql = "SELECT * FROM client_auths ";
            $sql .= "WHERE nip = ?";
    
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('s', $nip);
                
                // execute the prepared statement
                $stmt->execute();
    
                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }

    class Iban_Repository extends Repository
    {
        public const TABLE_NAME = "ibans";

        public static function insert($iban_number)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(iban_number) ";
            $sql .= "VALUES (?)";
            
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("s", $iban_number);
                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
        public function find_iban_by_iban_number($iban_number)
        {
            $sql = "SELECT * FROM ibans ";
            $sql .= "WHERE iban_number = ? ";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('s', $iban_number);
                
                // execute the prepared statement
                $stmt->execute();
    
                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }
    class Individual_Repository extends Repository
    {
        public const TABLE_NAME = "individuals";

        public static function insert($individual)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(person_id, iban_id) ";
            $sql .= "VALUES (?, ?)";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("ii", $individual['person_id'], $individual['iban_id']);
                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }
    class Account_Repository extends Repository
    {
        public const TABLE_NAME = "accounts";

        public static function insert($account)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(account_type_id, iban_id, ";
            $sql .= "account_number, overdraft, ";
            $sql .= "interest_rate, balance, ";
            $sql .="owner_type) ";
            $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";
    

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("iisddds", $account['account_type_id'], $account['iban_id'], $account['account_number'], $account['overdraft'], $account['interest_rate'], $account['balance'], $account['owner_type']);
                // execute the prepared statement
                $stmt->execute();
                // Close statement
                $stmt->close();
                return true;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
        public function find_account_by_account_number($account_number)
        {
            $sql = "SELECT * FROM accounts ";
            $sql .= "WHERE account_number = ?";
    
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('s', $account_number);
                
                // execute the prepared statement
                $stmt->execute();
    
                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result->fetch_assoc();
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }
