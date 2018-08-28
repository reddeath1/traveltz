<?php

class connection{
    public $conn;
    private $user;
    private $pass;
    private $host;
    private $db;

    public function __construct(){
        $this->user = 'root';
        $this->pass = '';
        $this->host = 'localhost';
        $this->db = 'traveltz';
        $this->conn = $this->connect();
    }

    private function connect(){
        $sql = new mysqli($this->host,$this->user,$this->pass,$this->db);

        ($sql->connect_errno) ? $sql = $sql->connect_error : $sql = $sql;

        return $sql;
    }
}

?>