<?php

class Database
{

    public static $connection;

    public static function setUpConnection()
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "Akinda@2004", "scorpex", "3306");

            if (Database::$connection->connect_error) {
                die("Connection failed: " . Database::$connection->connect_error);
            }
        }
    }

    public static function iud($q)
    {
        Database::setUpConnection();
        Database::$connection->query($q);
    }

    public static function search($q)
    {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }

    public static function searchPrepared($q, $params, $types)
    {
        Database::setUpConnection();
        $stmt = Database::$connection->prepare($q);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars(Database::$connection->error));
        }

        if (count($params) > 0) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();

        if ($stmt->error) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        return $stmt->get_result();
    }
}
