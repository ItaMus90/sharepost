<?php

/*
 * App Core Class
 * Create URL & loads core controller
 * URL FORMAT - /controller/method/params
 */

class Core{


    protected $current_controller = 'Pages';
    protected $current_method = 'index';
    protected $params = array();


    public function __construct(){

        $url = $this->getUrl();

        //Look in controllers for first value
        $this->checkIfFileExist($url);

    }


    public function getUrl(){

        if (isset($_GET['url'])){

            //removes / from the right side
            $url = rtrim($_GET['url'], '/');

            //filter the url from unnecessary input
            $url = filter_var($url, FILTER_SANITIZE_URL);

            //separate the url to array
            $url = explode('/', $url);

            return $url;

        }

    }


    private function checkIfFileExist($path){

        $full_path = "../app/controllers/" . ucwords($path[0]) . ".php";

        if (file_exists($full_path)){

            //If exists, set as controller
            $this->current_controller = ucwords($path[0]);

            //Unset 0 index
            unset($path[0]);

        }

        //Require the controller
        $this->requireController();

        //Instantiate controller class
        $this->instantiateControllerClass();

    }

    private function requireController(){

        require_once "../app/controllers/" . $this->current_controller . ".php";

    }

    private function instantiateControllerClass(){

        $this->current_controller = new $this->current_controller;

    }

}