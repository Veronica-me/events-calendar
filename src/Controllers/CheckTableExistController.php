<?php


namespace EventsCalendar\Controllers;
use EventsCalendar\Models\TableManager;

require_once __DIR__ . '/../../Autoloader.php';

// Now you can use your classes
\Autoloader::loadClass('EventsCalendar\\Models\\TableManager');

error_reporting(E_ALL);
ini_set('display_errors', 1);


class CheckTableExistController
{
    public static function handleRequest()
    {
        try {
            
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                
                $tableExists = TableManager::isEventDataTableExists();
                
                if ($tableExists) {
                    echo 'Table already exists!';
                } else {
                    // Table doesn't exist, attempt to create it
                    $result = TableManager::createEventDataTable();

                    if ($result === 'table was created!') {
                        echo 'Table was created!';
                    } else {
                        echo 'Failed to create table!';
                    }
                }
            } else {
                echo 'Invalid request method<br>';
            }

        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

// Only execute the script if it's directly accessed
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    CheckTableExistController::handleRequest();
}
