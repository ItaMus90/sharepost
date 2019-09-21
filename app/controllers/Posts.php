<?php



class Posts extends BaseController {



    public function __construct(){


    }


    public function index(){

        $data = array();

        $this->view("posts/index", $data);

    }

}