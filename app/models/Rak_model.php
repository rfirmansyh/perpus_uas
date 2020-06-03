<?php 

class Rak_model {

    private $table = 'rak';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

}