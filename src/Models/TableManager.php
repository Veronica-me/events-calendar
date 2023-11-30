<?php

namespace EventsCalendar\Models;

use EventsCalendar\Models\Connection;

class TableManager
{
    public static function createEventDataTable()
    {
        echo 'INNN ';
        $conn = Connection::getDBConnection();

        $tableName = 'event_data';

        $checkTableExists = $conn->query("
        SELECT 1
        FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_NAME = '$tableName'
    ");

        if ($checkTableExists->fetchColumn()) {
            return 'exist!';
        }

        $createTableQuery = "
        CREATE TABLE $tableName (
            id INT IDENTITY(1,1) PRIMARY KEY,
            date DATE,
            time TIME,
            place VARCHAR(255),
            title VARCHAR(255),
            description TEXT
        )
    ";

        try {
            $conn->exec($createTableQuery);
            return 'table was created!';
        } catch (\PDOException $e) {
            echo 'Exception: ' . $e->getMessage();
            return 'table creation failed!';
        }
    }


    public static function isEventDataTableExists()
    {

        try {
            $conn = Connection::getDBConnection();

            $tableName = 'event_data';

            $checkTableExists = $conn->query("SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '$tableName'");
            if ($checkTableExists->fetchColumn()) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo 'Exception: ' . $e->getMessage();
        }
    }
}
