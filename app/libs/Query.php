<?php


class Query{

    private $conn;
    private $stmt;
    public $is_connected = true;
    public $is_fetch_assoc = true;
    public $error;
    public $errno;

    protected function bind($param, $value, $type = null){


        if (is_null($type)){

            switch (true){

                case is_integer($value):

                    $type = "i";
                    break;

                case is_bool($value):

                    $type = "b";
                    break;

                case is_double($value):

                    $type = "d";
                    break;

                case is_null($value):

                    $type = null;
                    break;

                default:

                    $type = "s";

            }

        }



    }


    public function __construct($host, $username, $password, $scheme, $port = 3306){

        //Use this @ for ignored error
        $conn = @mysqli_connect($host, $username, $password, $scheme, $port);

        if (!$conn || $conn === null){

            $this->is_connected = false;
            $this->error = mysqli_connect_error();
            $this->errno = mysqli_connect_errno();

        }else {

            $this->is_connected = true;
            @mysqli_set_charset($conn, "utf8");
            $this->conn = $conn;

        }

    }

    /*
     * $sql need to be with placeholders ?
     * example
     * SELECT * FROM users WHERE user_id = ?
     *
     * $assoc_key = array()
     * need to be key and values of the value and type
     * 0 => "ss"
     * 1 => ["dani" ,"di"]
     */
    public function prepare_statement_query($sql, $arr_type_values = array()){

        $results = false;

        //Create a prepared statement
        $this->stmt = mysqli_stmt_init($this->conn);

        //Prepare the prepared statement
        if (!mysqli_stmt_prepare($this->stmt, $sql)){

            die("SQL statement failed");

        }else {

            //$values = "'".implode("','", $arr_type_values[1])."'";

            //Bind parameters to the placeholders
            if (!isset($arr_type_values[0]) || !isset($arr_type_values[1])){

                //missing values in array
                return false;

            }else{

                mysqli_stmt_bind_param($this->stmt, $arr_type_values[0], ...$arr_type_values[1]);

            }

            //Run parameters inside database
            mysqli_stmt_execute($this->stmt);

            $results = mysqli_stmt_get_result($this->stmt);

        }

        return $results;

    }

    //get asoc array from mysqli_stmt_get_result
    public function get_assoc_arr($result){

        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    public function query($sql , $assoc_key = array()){


        $return_type = ($this->is_fetch_assoc ? MYSQLI_ASSOC : MYSQLI_NUM);

        $conn = $this->conn;

        $is_array = false;

        if (is_array($sql)){

            $sql = implode(";", $sql);
            $is_array = true;

        }


        $out = array();

        if (mysqli_multi_query($conn, $sql)){

            $sql_id = 0;

            do{

                $list = array();

                if ($result = mysqli_store_result($conn)){

                    //select

                    if (isset($assoc_key[$sql_id]) && $assoc_key[$sql_id] != ""){


                        while ($row = mysqli_fetch_array($result, $return_type)){

                            $list[$row[$assoc_key[$sql_id]]] = $row;

                        }

                    }else {

                        while ($row = mysqli_fetch_array($result, $return_type)){

                            $list[] = $row;

                        }

                    }

                    $out[] = $list;

                    mysqli_free_result($result);

                }

                $sql_id++;

            }while(mysqli_more_results($conn) && mysqli_next_result($conn));

        }else {

            throw new Exception(mysqli_error($conn), mysqli_errno($conn));

        }



        if (!$is_array){

            if (is_array($out)){

                if (isset($out[0])){

                    $out = $out[0];

                }

            }

        }

        return $out;

    }


    public function q($sql, $assoc_key = array()){

        return $this->conn->query($sql, $assoc_key);

    }


    public function escape_string($str){

        $esacped_str = $this->conn->real_escape_string($str);

        return $esacped_str;

    }


    public function close(){

        @mysqli_close($this->conn);
        $this->is_connected = false;

    }


    public function get_error_num(){

        return mysqli_errno($this->conn);

    }


    public function get_error_desc(){

        return mysqli_error($this->conn);

    }

    public function get_last_insert_id(){

        return mysqli_insert_id($this->conn);

    }

    public function get_last_affected_rows(){

        return mysqli_affected_rows($this->conn);

    }
}