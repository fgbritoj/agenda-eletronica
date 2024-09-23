<?php

namespace Src\Models;

class Event extends Model{

    private $id;
    private $name;
    private $color;
    private $comments;
    private $theme_fk;
    private $type_fk;
    private $date_event_initial;
    private $date_event_final;
    private $created_at;
    private $updated_at;
    private $status;

  
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
        
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getColor(){
        return $this->color;
    }

    public function setColor($color){
        $this->color = $color;
        return $this;
    }

    public function getComments(){
        return $this->comments;
    }

    public function setComments($comments){
        $this->comments = $comments;
        return $this;
    }

    public function getTheme(){
        return $this->theme_fk;
    }

    public function setTheme($theme_fk){
        $this->theme_fk = $theme_fk;
        return $this;
    }

    public function getType(){
        return $this->type_fk;
    }

    public function setType($type_fk){
        $this->type_fk = $type_fk;
        return $this;
    }

    public function getDate_Event_Initial(){
        return $this->date_event_initial;
    }

    public function setDate_Event_Initial($date_event_initial){
        $this->date_event_initial = $date_event_initial;
        return $this;
    }

    public function getDate_Event_Final(){
        return $this->date_event_final;
    }

    public function setDate_Event_Final($date_event_final){
        $this->date_event_final = $date_event_final;
        return $this;
    }

    public function getCreatedAt(){
        return $this->created_at;
    }

    public function setCreatedAt($created_at){
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAt(){
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at){
        $this->updated_at = $updated_at;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
        return $this;
    }
    

}


