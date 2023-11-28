<?php

namespace EventsCalendar\Controllers;

use EventsCalendar\Models\Event;
use EventsCalendar\Repositories\EventsRepository;

require_once __DIR__ . '/../../Autoloader.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Explicitly set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $date = $_POST['date'] ?? date('Y-m-d');
    $title = $_POST['title'] ?? '';
    $time = $_POST['time'] ?? '';
    $place = $_POST['place'] ?? '';
    $description = $_POST['description'] ?? '';

    // Perform any additional server-side validation if needed

    // Create an instance of the EventsRepository
    $eventsRepository = new EventsRepository();

    // Create an instance of the Event model and set its properties
    $event = new Event();
    $event->setDate($date);
    $event->setTitle($title);
    $event->setTime($time);
    $event->setPlace($place);
    $event->setDescription($description);

    try {
        // Save to the database using the create method of EventsRepository
        $eventsRepository->create($event);

        // Send a success response and exit
        echo json_encode(['success' => true, 'message' => 'Event saved successfully']);
        exit;
    } catch (\Exception $e) {
        // Send an error response and exit
        echo json_encode(['success' => false, 'message' => 'Failed to save event', 'error' => $e->getMessage()]);
        exit;
    }
} else {
    // Handle invalid request method (if needed)
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>
