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

    public function add_post($data = array()){

        if (!key($data) || empty($data))
            return false;

        $user = $this->get_user_by_id($data["user_id"]);

        if (!$user)
            return false;


        $post_id = md5($data["title"] . $data["body"] . $data["user_id"] . time() . microtime());
        $current_date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO posts(id, owner_email, title, body, created_at)"
             . " VALUES(?,?,?,?,?)";

        $bind_params = [
            "sssss",
            [
                $post_id,
                $user[0]["email"],
                $data["title"],
                $data["body"],
                $current_date

            ]
        ];

        //from insert nothing back i
        //if the query failed i get die("SQL statement failed");
        $is_success = $this->db->prepare_statement_query($sql, $bind_params);

        //if is_success is empty string this mean the insert success else false

        return $is_success == "" ? true : false;

    }

    protected function get_user_by_id($user_id = ""){

        if (empty($user_id))
            return false;
        require_once "User.php";
        $user = new User();

        $result = $user->find_user_by_id($user_id);

        if (!$result){

            return false;

        }

        return $this->db->get_assoc_arr($result);

    }
}