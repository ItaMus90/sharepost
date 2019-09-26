<?php


class Pages extends BaseController {


    public function __construct(){


    }

    public function index(){

        if (is_logged_in()){

            redirect("posts");

        }

        $data = array(
            "title" => "SharePosts",
            "body"  => "Simple social network"
        );

        $this->view("pages/index", $data);

    }

    public function about() {

        $this->view("pages/about");

    }

}