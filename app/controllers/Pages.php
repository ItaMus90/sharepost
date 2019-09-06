<?php


class Pages extends BaseController {


    public function __construct(){


    }

    public function index(){

        $data = array("title" => "data from index method");
        $this->view("pages/index", $data);

    }

    public function about() {

        $this->view("pages/about");

    }

}