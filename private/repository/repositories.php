<?php

    class Account_type_Repository extends Repository
    {
        public const TABLE_NAME = "account_types";


        public static function find_account_type_by_name($type_name)
        {
            $sql = "SELECT * FROM account_types ";
            $sql .= "WHERE type_name = ?";
    
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('s', $type_name);
                
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
        public static function find_iban_by_iban_number($iban_number)
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

        public static function find_individual_by_person_id($person_id)
        {
            $sql = "SELECT * FROM individuals ";
            $sql .= "WHERE person_id = ? ";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('d', $person_id);
                
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
        public static function find_account_by_account_number($account_number)
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
        public static function find_accounts_by_iban_id($iban_id)
        {
            $sql = "SELECT * FROM accounts ";
            $sql .= "WHERE iban_id = ? ";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('i', $iban_id);
                
                // execute the prepared statement
                $stmt->execute();
    
                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
        public static function add_money_to_account($id, $amount)
        {
            // get the current balance from db
            $account = static::get_by_id($id);
            // set the amount to save
            $totalAmount = $amount + $account['balance'];

            // prepare an insert statement
            $sql = "UPDATE " . static::TABLE_NAME . " ";
            $sql .= "SET balance = ? ";
            $sql .= "WHERE account_id = ?";
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("di", $totalAmount, $id);
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
        public static function remove_money_from_account($id, $amount)
        {
            // get the current balance from db
            $account = static::get_by_id($id);
            // set the amount to save
            $remainedAmount = $account['balance'] - $amount;

            // prepare an insert statement
            $sql = "UPDATE " . static::TABLE_NAME . " ";
            $sql .= "SET balance = ? ";
            $sql .= "WHERE account_id = ?";
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("di", $remainedAmount, $id);
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
    class Supply_Account_Repository extends Repository
    {
        public const TABLE_NAME = "supply_accounts";

        public static function insert($supply_account)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(account_id, person_id, ";
            $sql .= "amount, issued_date) ";
            $sql .= "VALUES (?, ?, ?, ?)";
            
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("iids", $supply_account['account_id'], $supply_account['person_id'], $supply_account['amount'], $supply_account['issued_date']);
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
    class Transaction_Repository extends Repository
    {
        public const TABLE_NAME = "transactions";

        public static function insert($transaction)
        {
            // prepare an insert statement
            $sql = "INSERT INTO " . static::TABLE_NAME . " ";
            $sql .= "(account_id, bank_card_id, ";
            $sql .= "remained_balance, amount, ";
            $sql .= "issued_date, description, transaction_type) ";
            $sql .= "VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);

                // bind varaibles to prepared statement as parameters
                $stmt->bind_param("iiddsss", $transaction['account_id'], $transaction['bank_card_id'], $transaction['remained_balance'], $transaction['amount'], $transaction['issued_date'], $transaction['description'], $transaction['transaction_type']);
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

        public static function find_transaction_by_account_id($account_id)
        {
            $sql = "SELECT * FROM transactions ";
            $sql .= "WHERE account_id = ? ";
            $sql .= "ORDER BY issued_date DESC ";
            $sql .= "LIMIT 4";

            try {
                //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_ALL);
                # wannabe noticed about all errors except those about indexes
                $driver = new mysqli_driver();
                $driver->report_mode = MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX;

                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('i', $account_id);
                
                // execute the prepared statement
                $stmt->execute();
    
                // get result
                $result = $stmt->get_result();
                $stmt->close();
                return $result;
            } catch (mysqli_sql_exception $e) {
                echo $e->__toString();
                exit();
            }
        }
    }
