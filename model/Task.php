<?php
class Task{
    private $conn;
    public $id;
    public $task;
    public $is_completed;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
       $query = "SELECT * FROM tasks";
       return $this->conn->query($query); 
    }

    public function exists(){
        $safe = $this->conn->real_escape_string($this->task);
        $query = "SELECT id FROM tasks WHERE task = '" . $safe . "' LIMIT 1";
        $result = $this->conn->query($query);
        return $result && $result->num_rows > 0;
    }

    public function create(){
        if($this->exists()){
            return "duplicate";
        }

        $safe = $this->conn->real_escape_string($this->task);
        $query = "INSERT INTO tasks(task) VALUES('" . $safe . "')";
        return $this->conn->query($query); 
    }

    public function update($is_completed){
        $query = "UPDATE tasks SET is_completed = $is_completed WHERE id = " . $this->id;
        return $this->conn->query($query); 
    }

    public function delete(){
        $query = "DELETE FROM tasks WHERE id = " . $this->id;
        return $this->conn->query($query);
    }
}
