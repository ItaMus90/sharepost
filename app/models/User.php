<?php

class User {

    private $db = null;



    public function __construct(){

        $db = new Db();

        $this->db = $db->connect();

    }


    //Find user by email
    public function find_user_by_email($email){

        $arr = [
            "s", [$email]
        ];

        $sql = "SELECT * FROM users where email=? LIMIT 1;";

        $result = $this->db->prepare_statement_query($sql, $arr);

        return $result->num_rows > 0 ? true : false;

    }


}