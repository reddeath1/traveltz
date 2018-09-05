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
        $this->host = 'b8rg15mwxwynuk9q.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
        $this->db = 'traveltz';

        
        if(!preg_match('/(traveltz)/i',$_SERVER['REQUEST_URI']))
        {
            $this->db = 'lgqwqt85l9jnps2m';
            $this->user = 'c86qjllztzm11aex';
            $this->pass = 'f2lvmah9g0pga2d9';
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
