<?php

    abstract class Repository
    {
        protected const TABLE_NAME = 'undefined';
        protected static $db;

        public static function set_db($db)
        {
            self::$db = $db;
        }

        public static function get_all()
        {
            $sql = "SELECT * FROM " . static::TABLE_NAME;

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
            
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

        public static function get_by_id($id)
        {
            $sql = "SELECT * FROM " . static::TABLE_NAME . " ";
            $sql .= "WHERE " . substr(static::TABLE_NAME, 0, -1) . "_id = ? ";
            $sql .=  "LIMIT 1";

            try {
                $stmt = self::$db->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('i', $id);
                
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

        protected static function insert($params)
        {
        }
    }
