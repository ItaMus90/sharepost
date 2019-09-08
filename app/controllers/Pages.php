<?php


class Pages extends BaseController {


    public function __construct(){


    }

    public function index(){

        $data = array("title" => "data from index method");
        /*
         * Wrap all the open connection and send query and close
         * in method
         */
        //Start
        /*
        $this->db = $this->db_connect();
        $sql = "SELECT * FROM users WHERE id=?;";
        $a = [];
        $a[] = "i";
        $a[] = [1];
//        $result = $this->db->query($sql);
        $result = $this->db->prepare_statement_query($sql, $a);
        // need to use close
        $this->db->close();
        //End return result
        $data = $result;
        */
        $this->view("pages/index", $data);

    }

    public function about() {

        $this->view("pages/about");

    }

}