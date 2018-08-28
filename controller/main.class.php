<?php 
include_once 'connection.php';
class Main extends connection {

    public function __construct(){
        parent::__construct();
    }

    public function getLocations(){
        $data = array();

        $sql = $this->conn->query("SELECT * FROM location ORDER BY name ASC");

        if($sql->num_rows > 0){
            for ($data = array(); $row = $sql->fetch_array(MYSQLI_ASSOC); $data[] = $row) ;

        }

     $sql->free();

     return $data;
 }

}
?>
