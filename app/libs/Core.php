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

        $this->getUrl();

    }


    public function getUrl(){

        echo $_GET['url'];

    }

}