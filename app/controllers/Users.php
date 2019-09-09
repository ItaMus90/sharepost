<?php


class Users extends  BaseController {




    public function __construct(){



    }


    public function register(){

        //Check for POST
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Process Form

            //FILTER_SANITIZE_STRING Remove all HTML tags from a post
            //filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //htmlspecialchars


            //Init data
            $data = array(
                "name"                 => trim($_POST["name"]),
                "email"                => trim($_POST["email"]),
                "password"             => trim($_POST["password"]),
                "confirm_password"     => trim($_POST["confirm_password"]),
                "name_err"             => "",
                "email_err"            => "",
                "password_err"         => "",
                "confirm_password_err" => ""
            );

            //Validate Email
            if (empty($data["email"])){

                $data["email_err"] = "Please enter valid email";

            }

            //Validate Name
            if (empty($data["name"])){

                $data["name_err"] = "Please enter name";

            }

            //Validate Password
            if (empty($data["password"])){

                $data["password_err"] = "Please enter password";

            }else if (strlen($data["password"]) < 6){

                $data["password_err"] = "Password must be at least 6 characters";

            }

            //Validate Confirm Password
            if (empty($data["confirm_password"])){

                $data["confirm_password_err"] = "Please enter password";

            }else {

                if ($data["password"] != $data["confirm_password"]){

                    $data["confirm_password_err"] = "Passwords do not match";

                }

            }

            //Make sure errors are empty
            if (empty($data["name_err"]) && empty($data["email_err"]) && empty($data["password_err"]) && empty($data["confirm_password_err"])){

                //Validate
                die("Success");

            }else{

                $this->view("users/register", $data);

            }



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

            //FILTER_SANITIZE_STRING Remove all HTML tags from a post
            //filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //htmlspecialchars


            //Init data
            $data = array(
                "email"                => trim($_POST["email"]),
                "password"             => trim($_POST["password"]),
                "email_err"            => "",
                "password_err"         => "",
            );

            //Validate Email
            if (empty($data["email"])){

                $data["email_err"] = "Please enter valid email";

            }


            //Validate Password
            if (empty($data["password"])){

                $data["password_err"] = "Please enter password";

            }else if (strlen($data["password"]) < 6){

                $data["password_err"] = "Password must be at least 6 characters";

            }



            //Make sure errors are empty
            if (empty($data["email_err"]) && empty($data["password_err"])){

                //Validate
                die("Success");

            }else{

                $this->view("users/login", $data);

            }


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