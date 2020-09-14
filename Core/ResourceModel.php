<?php

namespace Mvc\Core;

use Mvc\Core\ResourceModelInterFace;
use Mvc\Config\Database;

class ResourceModel implements ResourceModelInterFace
{

    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $id = $model->getId();
        $title = $model->getTitle();
        $description = $model->getDescription();
        
        if ($id) {
            $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";

            $req = Database::getBdd()->prepare($sql);

            return $req->execute([
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'updated_at' => date('Y-m-d H:i:s')

            ]);

        } else {
            $sql = "INSERT INTO $this->table (title, description, created_at, updated_at) VALUES (:title, :description, :created_at, :updated_at)";

            $req = Database::getBdd()->prepare($sql);

            return $req->execute([
                'title' => $title,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }

    public function delete($model)
    {
        $id = $model->getId();

        if($id){
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'id' => $id
            ]);
        }
    }

    public function getCreatedAt($id){
        $sql =  "SELECT created_at FROM $this->table WHERE id = $id";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()) return $req->fetch()['created_at'];
    }

    public function getAll(){
        $sql =  "SELECT * FROM $this->table";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()) 
        return $req->fetchAll();
    }

    public function showTask($id){
        $sql =  "SELECT * FROM $this->table WHERE id = $id";

        $req = Database::getBdd()->prepare($sql);

        if($req->execute()){
            return  $req->fetch();
        }
    }
}
