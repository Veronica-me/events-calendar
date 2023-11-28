<?php

namespace EventsCalendar\Models;

class Connection
{
    public static function getDBConnection()
    {
        $servername = "DESKTOP-M4TEITP\\MSSQLSERVER1"; 
        $username = "sa";
        $password = "hello12345";
        $dbname = "events_calendar";

        try {
            $conn = new \PDO("sqlsrv:Server=$servername;Database=$dbname", $username, $password);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage() . "<br>";

            throw new \PDOException("Connection failed: " . $e->getMessage());
        }
    }
}

Connection::getDBConnection();