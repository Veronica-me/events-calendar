<?php

namespace EventsCalendar\Models;

class Event {


        private $id;
        private $date;
        private $time;
        private $place;
        private $title;
        private $description;
    /*
        public function __construct($date, $time, $place, $title, $description)
        {
            $this->date = $date;
            $this->time = $time;
            $this->place = $place;
            $this->title = $title;
            $this->description = $description;
        }
    */
        public function getId()
        {
            return $this->id;
        }
    
        public function getDate()
        {
            return $this->date;
        }
    
        public function getTime()
        {
            return $this->time;
        }
    
        public function getPlace()
        {
            return $this->place;
        }
    
        public function getTitle()
        {
            return $this->title;
        }
    
        public function getDescription()
        {
            return $this->description;
        }
    
        public function setDate($date) {
            $this->date = $date;
        }

        public function setTime($time) {
            $this->time = $time;
        }

        public function setTitle($title) {
            $this->title = $title;
        }

        public function setPlace($place) {
            $this->place = $place;
        }

        public function setDescription($description) {
            $this->description = $description;
        }


}