<?php

namespace Src\Services;

use Src\Models\Type;

class TypeService extends Type{

    public static function listAll($data){
        
        if($data['value'] != ''){
            $filter = " AND name LIKE '%$data[value]%' ";
        }

        if($data['limit'] != ''){
            $filter2 = " LIMIT $data[limit]";
        }

        $type = new Type();

        return $type->select("SELECT * FROM types WHERE status IS NULL $filter ORDER BY id DESC  $filter2");

    }

    public static function load($id){

        $type = new Type();

        return $type->select("SELECT * FROM types WHERE status IS NULL AND id = $id");

    }

    public function save(){

        $type = new Type();

        if (!$this->getName()) {
            return false;
        }
        
        $result = $type->query("INSERT INTO types VALUES(DEFAULT,:name_prod,:created,:updated,NULL) ", array(
            ':name_prod' => $this->getName(),
            ":created" => $this->dateFormat('now',2),
            ":updated" => $this->dateFormat('now',2),
        ));

        return $result;
        
    }

    public function update($id){

        $type = new Type();

        $result = $type->query("UPDATE types SET 
                name = :name_prod,
                updated_at = :updated WHERE id = :id", array(
                ':name_prod' => $this->getName(),
                ":updated" => $this->dateFormat('now',2),
                ":id" => $id
            ));
          
        return $result;

    }

    public function delete($id){

        $type = new Type();

        $result = $type->query(" UPDATE types SET status = NOW() WHERE id = :id", [":id" => $id]);

        return $result;

    }

    public function getPages($page = 1, $itemsForPages = 5,$filter = ''){

        if($this->getId()){
            $filter .= " AND id = ".$this->getId();
        }

        if($this->getName()){
            $filter .= " AND name LIKE '%".$this->getName()."%'";
        }

        $start = ($page - 1) * $itemsForPages;

        $type = new Type();


        $results = $type->select(" SELECT * FROM types WHERE status IS NULL $filter ORDER BY id DESC LIMIT $start, $itemsForPages ");

        $resultsTotal = $type->select(" SELECT COUNT(*) AS total FROM types WHERE status IS NULL $filter ");

        return [
            "data" => $results,
            "total" => (int)$resultsTotal[0]['total'],
            "pages" => ceil($resultsTotal[0]['total'] / $itemsForPages) + 1,
        ];

    }
    
}
