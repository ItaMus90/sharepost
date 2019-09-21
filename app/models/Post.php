<?php



class Post {

    private $db = null;


    public function __construct(){

        $db = new Db();

        $this->db = $db->connect();

    }


    public function get_posts(){

        $sql = "SELECT *,p.id,p.created_at FROM posts as p";
        $sql .= " INNER JOIN users as u";
        $sql .= " on p.owner_email = u.email";
        $sql .= " ORDER BY p.created_at DESC";

        $result = $this->db->prepare_statement_query($sql, array(), false);

        return $this->db->get_assoc_arr($result);

    }

}