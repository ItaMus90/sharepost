<?php


class Users extends  BaseController {




    public function __construct(){



    }


    public function register(){

        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Process Form

        }else {

            //Init data
            $data = array(
                "name"                 => "",
                "email"                => "",
                "password"             => "",
                "confirm_password"     => "",
                "name_err"             => "",
                "email_err"            => "",
                "password_err"         => "",
                "confirm_password_err" => ""
            );


            //Load Views
            $this->view('users/register', $data);

        }

    }

    public function login(){

        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Process Form

        }else {

            //Init data
            $data = array(
                "email"                => "",
                "password"             => "",
                "email_err"            => "",
                "password_err"         => "",
            );


            //Load Views
            $this->view('users/login', $data);

        }

    }

}