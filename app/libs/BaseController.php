<?php


/*
 * Base Controller
 * Loads the Models and Views
 */

class BaseController {

    //Load Modal
    public function model($model){

        //Require model file
        require_once "../app/models/" . $model . ".php";

        //Instantiate model
        return new $model();

    }


    //Load View
    public function view($view, $data = array()){

        $path =  "../app/views/" . $view . ".php";

        //Check for the view file
        if (file_exists($path)){

            require_once $path;

        }else {

            //View doesn't exist
            die("View doesn't exist");

        }

    }

}