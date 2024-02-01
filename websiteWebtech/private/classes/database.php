<?php
require_once(__DIR__ . '/../../private/config.php');

class Database
{
    private static $connection;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}