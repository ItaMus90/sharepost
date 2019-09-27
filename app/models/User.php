<?php

class User {

    private $db = null;



    public function __construct(){

        $db = new Db();

        $this->db = $db->connect();

    }


    //Login user
    public function login($email = "", $password = ""){

        if (empty($email) || empty($password))
            return false;

        $arr = [
            "s", [$email]
        ];

        $sql = "SELECT * FROM users WHERE email=? LIMIT 1";

        $result = $this->db->prepare_statement_query($sql, $arr);

        if ($result->num_rows > 0) {

            $user = $this->db->get_assoc_arr($result);

            $hashed_password = $user[0]["password"];

            if (password_verify($password, $hashed_password)){

                return $user[0];

            }else{

                return false;
            }

        }


        return false;

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

    //Find user by id
    public function find_user_by_id($id = ""){

        if (empty($id))
            return false;

        $arr = [
            "s", [$id]
        ];

        $sql = "SELECT * FROM users where id=? LIMIT 1;";

        $result = $this->db->prepare_statement_query($sql, $arr);

        if ($result->num_rows > 0){

            return $result;

        }

        return  false;
    }


    //Register user
    public function register($data = array()){

        if (!key($data) || empty($data))
            return false;

        $user_id = md5($data["email"] . $data["password"] . time() . microtime());
        $current_date = date('Y-m-d H:i:s');

        //Insert query
        $sql = "INSERT INTO users(id, name, email, password, created_at)";
        $sql .= " VALUES(?,?,?,?,?)";

        //Bimd params
        $bind_params = [
            "sssss",
            [
                $user_id,
                $data["name"],
                $data["email"],
                $data["password"],
                $current_date
            ]
        ];

        //from insert nothing back i
        //if the query failed i get die("SQL statement failed");
        $this->db->prepare_statement_query($sql, $bind_params);

    }


}