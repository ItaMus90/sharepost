<?php

    //Load Config
    require_once "config/config.php";


    //Autoload Core Libs
    spl_autoload_register(function($class_name){

        require_once "libs/". $class_name .".php";

    });