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

    //add post
    public function add(){

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Sanitize POST
            //FILTER_SANITIZE_STRING Remove all HTML tags from a post
            //filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //htmlspecialchars

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array(
                "title"     => trim($_POST["title"]),
                "body"      => trim($_POST["body"]),
                "user_id"   => $_SESSION["user_id"],
                "title_err" => "",
                "body_err"  => ""
            );

            //Validate Title
            if (empty($data["title"])){

                $data["title_err"] = "Please enter title";

            }


            //Validate Body
            if (empty($data["body"])){

                $data["body_err"] = "Please enter body text";

            }


            //Make sure no error
            if (empty($data["title_err"]) && empty($data["body_err"])){

                //Validated
                if ($this->post->add_post($data)){

                    flash("post_message", "Post Added");

                    redirect("posts");


                }else {

                    die("Something went wrong");

                }

            }else {

                //Load the view with error
                $this->view("posts/add", $data);

            }


        }else {

            $data = array(
                "title" => '',
                "body" => ''
            );

            $this->view('posts/add', $data);

        }

    }

    //edit post
    public function edit($id = ""){

        if (empty($id))
            return false;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Sanitize POST
            //FILTER_SANITIZE_STRING Remove all HTML tags from a post
            //filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            //htmlspecialchars

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = array(
                "title"     => trim($_POST["title"]),
                "body"      => trim($_POST["body"]),
                "id"        => $id,
                "user_id"   => $_SESSION["user_id"],
                "title_err" => "",
                "body_err"  => ""
            );

            //Validate Title
            if (empty($data["title"])){

                $data["title_err"] = "Please enter title";

            }


            //Validate Body
            if (empty($data["body"])){

                $data["body_err"] = "Please enter body text";

            }


            //Make sure no error
            if (empty($data["title_err"]) && empty($data["body_err"])){

                //Validated
                if ($this->post->update_post($data)){

                    flash("post_message", "Post Updated");

                    redirect("posts");


                }else {

                    die("Something went wrong");

                }

            }else {

                //Load the view with error
                $this->view("posts/edit", $data);

            }


        }else {

            //Get existing post from model
            $post = $this->post->get_post_by_id($id);

            if ($post){

                //Check for owner
                if ($post[0]["user_id"] != $_SESSION["user_id"]){

                    redirect("posts");

                }else{

                    $data = array(
                        "id" => $id,
                        "title" => $post[0]["title"],
                        "body" => $post[0]["body"]
                    );

                    $this->view('posts/edit', $data);


                }

            }else{

                redirect("posts");

            }

        }

    }

    //delete post
    public function delete($id = ""){

        if (empty($id))
            return false;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Get existing post from model
            $post = $this->post->get_post_by_id($id);

            //Check for owner
            if ($post[0]["user_id"] != $_SESSION["user_id"]){

                redirect("posts");

            }

            if ($this->post->delete_post($id)){

                flash("post_message", "Post Removed");
                redirect("posts");

            }else{

                die("Something went wrong");

            }

        }else{

            redirect("posts");

        }

    }

    public function show($id){

        $post = $this->post->get_post_by_id($id);
        $data = array();

        if (!$post){

            $data = [
                "post" => ""
            ];

        }else{

            $data = [
                "post" => $post
            ];

        }

        $this->view("posts/show", $data);

    }

}