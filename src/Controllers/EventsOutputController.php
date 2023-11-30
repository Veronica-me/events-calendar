<?php

namespace EventsCalendar\Controllers;

use EventsCalendar\Models\Event;
use EventsCalendar\Repositories\EventsRepository;

require_once __DIR__ . '/../../Autoloader.php';

class EventsOutputController
{
    static function getAllEvents() 
    {
        $eventsArr = [];
        $eventsRepository = new EventsRepository();
        $events = $eventsRepository->getAll();

        foreach ($events as $event) {
            $date = substr($event['date'], 0, 10); // Extract the date part
            $eventsArr[$date][] = $event; // Use date as the key
        }

        return $eventsArr;
    }

    static function getEventsByDate($date)
    {
        $eventsArrD = [];
        $eventsRepositoryD = new EventsRepository();
        $eventsArrD = $eventsRepositoryD->getEventsByDate($date);
        return($eventsArrD);  
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Create an array to store the response
    $response = ['debug' => []];

    // Add debug information about the received action
    $response['debug']['received_action'] = $action;

    switch ($action) {
        case 'getAllEvents':
            $eventsRepository = new EventsRepository();
            $events = $eventsRepository->getAll();

            // Add events to the response
            $response['events'] = $events;
            break;
        default:
            // Add an error message to the response
            $response['error'] = 'Invalid action';
            break;
    }

    // Send the response as JSON
    echo json_encode($response);
} else {
    // Send an error response if action is not specified
    echo json_encode(['error' => 'Action not specified']);
}
