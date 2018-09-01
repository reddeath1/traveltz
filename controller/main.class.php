<?php 
include_once 'connection.php';
class Main extends connection {

    public function __construct(){
        parent::__construct();
    }

    public function getLocations($str = ''){
        $data = array();

        if(!empty($str)){
            $str = "WHERE $str";
        }

        $sql = $this->conn->query("SELECT * FROM location $str ORDER BY name ASC");

        if($sql->num_rows > 0){
            for ($data = array(); $row = $sql->fetch_array(MYSQLI_ASSOC); $data[] = $row) ;

        }

     $sql->free();

     return $data;
 }


    public function encode($data){
        return json_encode($data);
    }

    public function decode($data){
        return json_decode($data);
    }

}
?>
