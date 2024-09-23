<?php

namespace Src\Services;

use Src\Models\Event;

class EventService extends Event{

    public static function listAll($data){
        
        if($data['value'] != ''){
            $filter = " AND name LIKE '%$data[value]%' ";
        }

        if($data['limit'] != ''){
            $filter2 = " LIMIT $data[limit]";
        }

        $event = new Event();

        return $event->select("SELECT * FROM events WHERE status IS NULL $filter ORDER BY id DESC  $filter2");

    }

    public static function load($id){

        $event = new Event();

        return $event->select("SELECT * FROM events WHERE status IS NULL AND id = $id");

    }

    public function save(){

        $event = new Event();

        if (!$this->getName()) {
            return false;
        }
        
        $result = $event->query("INSERT INTO events VALUES(DEFAULT,:name,:color,:comments,:theme_fk,:type_fk,:date_event_initial,:date_event_final,:created,:updated,NULL) ", array(        
            ":name" => $this->getName(),
            ":color" => $this->getColor(),
            ":comments" => $this->getComments(),
            ":theme_fk" => $this->getTheme(),
            ":type_fk" => $this->getType(),
            ":date_event_initial" => $this->getDate_Event_Initial(),
            ":date_event_final" => $this->getDate_Event_Final(),
            ":created" => $this->dateFormat('now',2),
            ":updated" => $this->dateFormat('now',2),
        ));

        return $result;
        
    }

    public function update($id){

        //var_dump($this);exit;

        $event = new Event();

        //echo($this->getName());exit;

        $result = $event->query("UPDATE events SET 
        name = :name_prod,
        color = :color,
        comments = :comments,
        theme_fk = :theme_fk,
        type_fk = :type_fk,
        date_event_initial = :date_event_initial,
        date_event_final = :date_event_final,
        updated_at = :updated WHERE id = :id", array(
        ':name_prod' => $this->getName(),
        ':color' => $this->getColor(),
        ':comments' => $this->getComments(),
        ':theme_fk' => $this->getTheme(),
        ':type_fk' => $this->getType(),
        ':date_event_initial' => $this->getDate_Event_Initial(),
        ':date_event_final' => $this->getDate_Event_Final(),
        ":updated" => $this->dateFormat('now',2),
        ":id" => $id
        ));

          
        return $result;

    }

    public function delete($id){

        $event = new Event();

        $result = $event->query(" UPDATE events SET status = NOW() WHERE id = :id", [
                ":id" => $id
            ]);

        return $result;
        

    }

    public function getPages($page = 1, $itemsForPages = 5,$filter = ''){

        if($this->getId()){
            $filter .= " AND id = ".$this->getId();
        }

        if($this->getName()){
            $filter .= " AND name LIKE '%".$this->getName()."%'";
        }

        if($this->getDate_Event_Initial()){
            $filter .= " AND date_event_initial >= '".$this->getDate_Event_Initial()."'";
        }

        
        if($this->getDate_Event_Final()){
            $filter .= " AND date_event_initial <= '".$this->getDate_Event_Final()."'";
        }

        if($this->getType()){
            $filter .= " AND type_fk = ".$this->getType();
        }

        if($this->getTheme()){
            $filter .= " AND theme_fk = ".$this->getTheme();
        }

        if($this->getType()){
            $filter .= " AND type_fk = ".$this->getType();
        }

        

        $start = ($page - 1) * $itemsForPages;

        $event = new Event();


        $results = $event->select(" SELECT * FROM events WHERE status IS NULL $filter ORDER BY id DESC LIMIT $start, $itemsForPages ");

        $resultsTotal = $event->select(" SELECT COUNT(*) AS total FROM events WHERE status IS NULL $filter ");

        return [
            "data" => $results,
            "total" => (int)$resultsTotal[0]['total'],
            "pages" => ceil($resultsTotal[0]['total'] / $itemsForPages) + 1,
        ];

    }

    public function getEvents(){

        $event = new Event();

        $result = $event->select("SELECT * FROM events WHERE status IS NULL ");

        foreach($result as $values){

            $array[] = array(
                'title' => $values['name'],
                'start' => $values['date_event_initial'],
                'end' => $values['date_event_final'],
                'color' => $values['color'],
                'url' => "/eventos/update/$values[id]",        
            );

        }

        return $array;

        // return [
        //     [
        //         'title' => 'Evento Teste',
        //         'start' => '2024-09-20T10:00:00',
        //         'end' => '2024-09-20T12:00:00',
        //         'color' => '#ff0000'
        //     ]
        // ];

    }

    public static function quantityEvents($year,$month,$day){
        
        $event = new Event();

        $lastDay = date('Y-m-t', strtotime("$year-$month-01"));

        $filter = " AND (date_event_initial BETWEEN '$year-$month-01 00:00:00' AND '$lastDay 23:59:59'
                    OR date_event_final BETWEEN '$year-$month-01 00:00:00' AND '$lastDay 23:59:59') ";


        $eventsMonth =  $event->numRow("SELECT * FROM events WHERE status IS NULL $filter ORDER BY id DESC ");

        $reference_date ="$year-$month-$day";

        $day_of_week = date('w', strtotime($reference_date));
        
        $days_to_first_day = $day_of_week == 0 ? 0 : $day_of_week - 1;
        
        $days_to_last_day = $day_of_week == 0 ? 6 : 7 - $day_of_week;
        
        $first_day_of_week = date('Y-m-d', strtotime("-$days_to_first_day days", strtotime($reference_date)));
        
        $last_day_of_week = date('Y-m-d', strtotime("+$days_to_last_day days", strtotime($reference_date)));
        
        $filter = " AND (date_event_initial BETWEEN '$first_day_of_week 00:00:00' AND ' $last_day_of_week  23:59:59'
                    OR date_event_final BETWEEN '$first_day_of_week 00:00:00' AND ' $last_day_of_week  23:59:59') ";


        $eventsWeek =  $event->numRow("SELECT * FROM events WHERE status IS NULL $filter ORDER BY id DESC ");

        $filter = " AND (date_event_initial BETWEEN '$reference_date 00:00:00' AND '$reference_date 23:59:59'
                    OR date_event_final BETWEEN '$reference_date 00:00:00' AND '$reference_date 23:59:59') ";

        $eventsDay =  $event->numRow("SELECT * FROM events WHERE status IS NULL $filter ORDER BY id DESC ");

        return [
            'eventsMonth' => $eventsMonth,
            'eventsWeek' => $eventsWeek,
            'eventsDay' => $eventsDay
        ];

    } 
    
}


