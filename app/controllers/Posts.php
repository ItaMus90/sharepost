<?php



class Posts extends BaseController {



    public function __construct(){

        //If user not login
        if (!is_logged_in()){

            redirect("users/login");

        }

    }


    public function index(){

        $data = array();

        $this->view("posts/index", $data);

    }




}