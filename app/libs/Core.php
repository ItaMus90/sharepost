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
        $this->checkIfFileExists($url);

        //Check for second part of url
        $this->checkIfMethodExists($url);

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


    private function checkIfFileExists(&$path){

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

    private function checkIfMethodExists(&$path){

        if (isset($path[1])){

            //Check to see if method exists in controller
            if (method_exists($this->current_controller, $path[1])){

                $this->current_method = $path[1];

                //Unset index 1
                unset($path[1]);

            }

        }


        //Get params
        $this->params = $path ? array_values($path) : array();

        //Call a callback with array of params array(obj_class, method_class), params of url
        call_user_func_array(array($this->current_controller, $this->current_method), $this->params);


    }

    private function requireController(){

        require_once "../app/controllers/" . $this->current_controller . ".php";

    }

    private function instantiateControllerClass(){

        $this->current_controller = new $this->current_controller;

    }

}