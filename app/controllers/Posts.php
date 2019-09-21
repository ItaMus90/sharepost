<?php



class Posts extends BaseController {

    protected $post = null;

    public function __construct(){

        //If user not login
        if (!is_logged_in()){

            redirect("users/login");

        }

        $this->post = $this->model("Post");

    }


    public function index(){

        //Get posts
        $posts = $this->post->get_posts();

        $data = array(
            "posts" => $posts
        );

        $this->view("posts/index", $data);

    }




}