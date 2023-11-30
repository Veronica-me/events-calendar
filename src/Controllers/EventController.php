<?php

namespace EventsCalendar\Controllers;

use EventsCalendar\Models\Event;
use EventsCalendar\Repositories\EventsRepository;

require_once __DIR__ . '/../../Autoloader.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $date = $_POST['date'] ?? date('Y-m-d');
    $title = $_POST['title'] ?? '';
    $time = $_POST['time'] ?? '';
    $place = $_POST['place'] ?? '';
    $description = $_POST['description'] ?? '';

    $eventsRepository = new EventsRepository();


    $event = new Event();
    $event->setDate($date);
    $event->setTitle($title);
    $event->setTime($time);
    $event->setPlace($place);
    $event->setDescription($description);

    try {

        $eventsRepository->create($event);
        echo json_encode(['success' => true, 'message' => 'Event saved successfully']);
        exit;
    } catch (\Exception $e) {

        echo json_encode(['success' => false, 'message' => 'Failed to save event', 'error' => $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}
?>
