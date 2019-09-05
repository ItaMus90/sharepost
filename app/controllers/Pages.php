<?php


class Pages extends BaseController {


    public function __construct(){


    }

    public function index(){

        echo "Method Index ";

    }

    public function about($id = array()) {

        echo "Method About ";

    }

}