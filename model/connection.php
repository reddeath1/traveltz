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

        
        if(!preg_match('/(traveltz)/i',$_SERVER['REQUEST_URI']))
        {
            $this->db = 'klmexpre_database';
            $this->user = 'klmexpre_dbuser';
            $this->pass = '8T88n3PLopK2';
        }

        $this->conn = $this->connect();
    }

    private function connect(){
        
        $sql = new mysqli($this->host,$this->user,$this->pass,$this->db);

        ($sql->connect_errno) ? $sql = $sql->connect_error : $sql = $sql;

        return $sql;
    }
}

?>