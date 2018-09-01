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

    public function get_av_result($obj){
        $params = $this->decode($obj);

        $d = $params->d;
        $from = $params->from;
        $to = $params->to;
        $sort = $params->sort;
        $filter = $params->filter;
        $limit = $params->limit;

        $params = array('table'=>'bus','routine'=>'table_name','table2'=>'table_name','alias'=>'r','alias1'=>'t',
            'alias2'=>'u',
            'field'=>array('*'),
            'foreign'=>array('r.t_id'=>'t.id'),'foreign1'=>array('r.t_id'=>'u.t_id'),
            'args'=>array(),'like'=>"f.features LIKE %$filter%",
            'align'=>'ORDER BY t.id','limit'=>$limit,
            'state'=>'AAL');

        $data = $this->get($this->encode($params));
    }

    public function encode($data){
        return json_encode($data);
    }

    public function decode($data){
        return json_decode($data);
    }

    /**
     * make no entry to no body
     * @param $pass
     * @return string
     */
    public function Hash($pass) {
        $salt = 'abcdefghijklmnopqrstuvxywz1234567890()-_.$%@!&*\/';
        $sal = substr(sha1(md5("$pass$salt")), 0, 20);
        $hash = hash('sha512',$sal);
        $hash = sha1(substr($hash,0,20));
        $hash = substr($hash,0,25);
        return $hash;
    }

    /**
     * serialize inputs
     * @param $data
     * @return string
     */
    public function input_sanitizer($data){
        $cleaner = array();
        if(is_array($data)){
            foreach ($data as $key => $value){
                return $cleaner[$key] = $this->input_sanitizer($value);
            }
        }else{
            if(get_magic_quotes_gpc()){
                $data = trim(stripcslashes($data));
            }

            $data = strip_tags($data);
            $data = htmlentities($data);
            return $data = trim($data);
        }
    }


    /**
     * @e.g $data = array('table'=>'table_name','table1'=>'table_name','table2'=>'table_name','alias'=>'r','alias1'=>'t',
    'alias2'=>'u',
    'field'=>array('*'),
    'foreign'=>array('r.t_id'=>'t.id'),'foreign1'=>array('r.t_id'=>'u.t_id'),
    'args'=>array('r.t_id'=>$id),
     * 'like'=>''
    'align'=>'ORDER BY t.id','limit'=>$limit,
    'state'=>'AAL');
     * @param $obj
     * @return bool|mysqli_result
     */
    public function get($obj) {

        $data = $this->decode($obj);

        /**
         * eg.
         * alias username as u
         */
        $alias = $data->alias;
        $a1 = $data->alias1;
        $a2 = $data->alias2;
        /**
         * Tables to get data
         */
        $tb = $data->table;
        $tb1 = $data->table1;
        $tb2 = $data->table2;
        /**
         * Fields to fetch
         */
        $rows = $data->field;
        /**
         * foreign key's
         */
        $fn = $data->foreign;
        $fn1 = $data->foreign1;
        /**
         * data equals to
         */
        $arg = $data->args;
        /**
         * Order
         */
        $align = $data->align;
        /**
         * result limits
         */
        $limit = $data->limit;
        /**
         * How result is represented
         */
        $state = $data->state;
        $like = $data->like;

        $av = '';
        $av1 = '';
        $av2 = '';
        $av3 = '';

        $status = array();

        if(!empty($alias)) {
            $alias = " $tb as $alias LEFT JOIN ";
        }else if(!empty($tb)) {
            $av1 = $tb;
        }

        if(!empty($a1) && !empty($tb1)) {
            $a1 = " $tb1 as $a1";
        }


        if(!empty($a2) && !empty($tb2)) {
            $a2 = " LEFT JOIN $tb2 as $a2";
        }


        if(!empty($rows) && count($rows) > 0) {
            foreach($rows as $values){
                $av .= $values. ',';
            }

            $av = chop($av, ',');
        }

        if(!empty($fn)) {
            if(count($fn) > 0) {
                foreach($fn as $key => $value){
                    $av1 .= " ON($key = $value)";
                }

                $av1 = $alias." $a1 ".$av1;
            }
        }

        if(!empty($fn1) && count($fn1) > 0) {
            foreach($fn1 as $key => $value){
                $av2 = " ON( $key = $value)";
            }
            $av2 = $a2. '' .$av2;
        }

        if(!empty($arg) && count($arg) > 0) {
            foreach($arg as $key => $value){
                $av3 .= "$key = '$value' AND ";
            }

            $av3 = ' WHERE ' .chop($av3, ' AND ');
        }

        $like = (!empty($like)) ? $like : '';

        if(!empty($limit)){
            $limit = " LIMIT $limit ";
        }


        $sql = $this->con->query("SELECT $av FROM $av1 $av2  $av3 $like $align $limit");


        if(@$sql->num_rows > 0) {
            if(!empty($state)) {
                while ($row = $sql->fetch_array(MYSQLI_ASSOC)){
                    $status[] = $row;
                }
            }else {
                $status =  true;
            }
        }else {
            $status = false;
        }



        return $status;
    }

    /**
     * @param $obj
     * @return bool|mysqli_result
     */
    public function set($obj) {
        $data = $this->decode($obj);
        $rows = $data->field;
        $arg = $data->args;
        $tb = $data->table;
        $values = '';
        $value1 = '';
        $where = '';
        $state = false;

        if(!empty($rows) && count($rows)) {
            foreach($rows as $key => $value){
                $values .= $key." = '".$this->con->real_escape_string($value)."', ";
            }

            $values = chop($values,', ');
        }

        if(!empty($arg) && count($arg)) {
            foreach($arg as $key => $value){
                $value1 .= $key." = '".$this->con->real_escape_string($value)."' AND ";
            }

            $where = ' WHERE ' .chop($value1,' AND ');
        }

        $sql = $this->con->query("INSERT INTO $tb SET $values $where");
        if($sql){
            $state = true;
            $sql->close();
        }

        return $state;

    }

    /**
     * @param $obj
     * @return bool|mysqli_result
     */
    public function update($obj){
        $data = $this->decode($obj);
        $tb = $data->table;
        $rows = $data->args;
        $arg = $data->field;
        $upsts = '';
        $upst = '';


        if(count($rows) > 0) {

            foreach($rows as $key => $value){
                $upsts .= "$key = '".$this->con->real_escape_string($value)."' AND ";
            }

            $infos = chop($upsts," AND ");

        }

        if(count($arg) > 0) {
            foreach($arg as $key => $value){
                $upst .= "$key = '".$this->con->real_escape_string($value)."' , ";
            }

            $extr = chop($upst, ' , ');
        }

        return $this->con->query("UPDATE $tb SET $extr WHERE $infos LIMIT 1");
    }

}
?>
