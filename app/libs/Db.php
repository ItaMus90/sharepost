<?php

/*
 * DB Class
 * Connect to database
 * Create prepared statement
 * Bind values
 * Returns rows and results
 */

class Db {

    private $db_host = DB_HOST;
    private $db_username = DB_USERNAME;
    private $db_password = DB_PASSWORD;
    private $db_scheme = DB_SCHEME;



    public function connect(){

        $q = new Query($this->db_host, $this->db_username, $this->db_password, $this->db_scheme);

        return $q;

    }

}

