<?php

    //Simple page redirect


    function redirect($page, $replace = true ,$http_code = 301){

        header("location: " . URL_ROOT . DS . $page, $replace, $http_code);

    }