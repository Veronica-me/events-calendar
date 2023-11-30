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
            $date = substr($event['date'], 0, 10);
            $eventsArr[$date][] = $event; 
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

    $response = ['debug' => []];

    $response['debug']['received_action'] = $action;

    switch ($action) {
        case 'getAllEvents':
            $eventsRepository = new EventsRepository();
            $events = $eventsRepository->getAll();
            $response['events'] = $events;
            break;
        case 'updateEvent':
            try {
                
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);

                error_log(print_r($data, true));

                
                if ($data && isset($data['id'], $data['title'], $data['place'], $data['description'])) {
                   // error_log('Received data for updateEvent:');
                    //error_log(print_r($data, true));

                    // Extract values
                    $id = $data['id'];
                    $title = $data['title'];
                    $place = $data['place'];
                    $description = $data['description'];

                    /*
                    error_log("ID: $id");
                    error_log("Title: $title");
                    error_log("Place: $place");
                    error_log("Description: $description");
*/
                    $eventsRepository = new EventsRepository();
                    $eventsRepository->updateEvent($id, $title, $place, $description);

                    $response['success'] = true;
                } else {
                    
                    $response['error'] = 'Invalid data provided for updateEvent';
                }
            } catch (\Exception $e) {
                // Log the exception for debugging
                error_log('Exception caught: ' . $e->getMessage());
            
                // Provide an error response with the exception message
                $response['error'] = 'An error occurred: ' . $e->getMessage();
            }
            break;
        default:
            
            $response['error'] = 'Invalid action';
            break;
    }

    echo json_encode($response);
} else {
  
    echo json_encode(['error' => 'Action not specified']);
}
