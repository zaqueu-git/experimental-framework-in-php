<?php

namespace App\Repositories;

use App\Models\Example;
use PDO;

class ExampleRepository
{
    private $db;
    private $table = "tests";
    private $class = "App\\Models\\Example";

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function delete(Example $example) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $example->id);

        return $stmt->execute();
    } 
    
    public function alter(Example $example) {        
        $stmt = $this->db->prepare("UPDATE {$this->table} SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $example->id);
        $stmt->bindParam(':name', $example->name);

        return $stmt->execute();
    }

    public function create(Example $example) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (name) VALUES (:name)");
        $stmt->bindParam(':name', $example->name);

        return $stmt->execute();
    }

    public function find(Example $example) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $example->id);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->class); 
        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");

        return $stmt->fetchAll(PDO::FETCH_CLASS, "App\\Models\\Example");
    }
}