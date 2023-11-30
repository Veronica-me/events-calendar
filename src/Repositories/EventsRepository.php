<?php
namespace EventsCalendar\Repositories;

use EventsCalendar\Models\Event;
use EventsCalendar\Models\Connection;

class EventsRepository 
{

    /**
     *  @var \PDO
     */

    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getDBConnection();
    }

    public function get (int $eventId)
    {
        $stmt = $this->pdo->prepare(('SELECT * FROM event_data WHERE id = :id'));
        $stmt->bindValue(':id', $eventId);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getEventsByDate($date)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM event_data WHERE DATE_FORMAT(date, "%Y-%m-%d") = :date');
        $stmt->bindValue(':date', $date);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function getAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM event_data');
        return $stmt->fetchAll();
    }

    public function create(Event $event)
{
    $stmt = $this->pdo->prepare('INSERT INTO event_data (date, time, place, title, description) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([
        $event->getDate(),
        $event->getTime(),
        $event->getPlace(),
        $event->getTitle(),
        $event->getDescription()
    ]);
}

    public function delete(int $eventId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM event_data WHERE id = :id');
        $stmt->bindValue(':id', $eventId);
        $stmt->execute();
    }

}