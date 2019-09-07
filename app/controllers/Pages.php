<?php


class Pages extends BaseController {


    public function __construct(){


    }

    public function index(){

        //$data = array("title" => "data from index method");
        $this->db = $this->db_connect();
        $sql = "SELECT * FROM users";

        $result = $this->db->query($sql);
        $data = $result;
        $this->view("pages/index", $data);

    }

    public function about() {

        $this->view("pages/about");

    }

}