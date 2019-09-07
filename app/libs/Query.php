<?php


class Query{

    private $conn;
    public $is_connected = true;
    public $is_fetch_assoc = true;
    public $error;
    public $errno;

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