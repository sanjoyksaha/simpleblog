<?php

    class Posts extends Controller {
        private $postModel;
        private $userModel;

        public function __construct()
        {
            if(!isLoggedIn()) {
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');

        }

        public function index()
        {
            $posts = $this->postModel->getAllPost();
            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index', $data);
        }

        public function create()
        {
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'user_id'        => $_SESSION['user_id'],
                    'title'          => trim($_POST['title']),
                    'body'           => trim($_POST['body']),
                    'image'          => $_FILES['image']['name'],
                    'tmp_img_name'   => $_FILES['image']['tmp_name'],
                    'err_title'      => '',
                    'err_body'       => '',
                    'err_image'       => '',
                    'image_unique_name' => '',
                ];

                $image = explode(".", $data['image']);
                $image_extension = end($image);
                $data['image_unique_name'] = md5(time().$data['image']).".".$image_extension;

                // Validate title
                if(empty($data['title'])) {
                    $data['err_title'] = "Post Title is empty";
                }

                // Validate body
                if(empty($data['body'])) {
                    $data['err_body'] = "Post Body is empty";
                }

                // Validate Image
                if(empty($data['image'])) {
                    $data['err_image'] = "Image is empty";
                }

                // Validate image extension
                if(in_array($image_extension, ['jpeg', 'jpg', 'png', 'bmp', 'gif']) == false) {
                    $data['err_image'] = "Invalid Image Format";
                }

                // Make Sure No Errors
                if(empty($data['err_title']) && empty($data['err_body']) && empty($data['err_image'])) {

                    if($this->postModel->createPost($data)) {
                        move_uploaded_file($data['tmp_img_name'], '../public/images/posts/'.$data['image_unique_name']);
                        flash('post_message', 'Post Created Successfully.');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }

                } else {
                    // Load view with errors
                    $this->view('posts/create', $data);
                }

            } else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];

                return $this->view('posts/create', $data);
            }
        }

        public function show($id)
        {
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->findUserById($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];

            return $this->view('posts/show', $data);
        }

        public function edit($id)
        {
            // Check for owner
            $post = $this->postModel->getPostById($id);

            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Sanitize Post Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init Data
                $data = [
                    'id'                => $id,
                    'title'             => trim($_POST['title']),
                    'body'              => trim($_POST['body']),
                    'user_id'           => $_SESSION['user_id'],
                    'image'             => $_FILES['image']['name'],
                    'tmp_img_name'      => $_FILES['image']['tmp_name'],
                    'err_title'         => '',
                    'err_body'          => '',
                    'err_image'         => '',
                    'image_unique_name' => ''
                ];

                $image = explode(".", $data['image']);
                $image_extension = end($image);
                $data['image_unique_name'] = md5(time().$data['image']).".".$image_extension;

                // Validate title
                if(empty($data['title'])) {
                    $data['err_title'] = "Post Title is empty";
                }

                // Validate body
                if(empty($data['body'])) {
                    $data['err_body'] = "Post Body is empty";
                }

                // Make Sure No Errors
                if(empty($data['err_title']) && empty($data['err_body'])) {

                    if(!empty($data['image'])) {

                        // Validate image extension
                        if(in_array($image_extension, ['jpeg', 'jpg', 'png', 'bmp', 'gif']) == false) {
                            $data['err_image'] = "Invalid Image Format";
                        }

                        if(empty($data['err_image'])) {

                            if(file_exists("../public/images/posts/".$post->image)) {
                                unlink("../public/images/posts/".$post->image);
                            }

                            if($this->postModel->updatePost($data)) {
                                move_uploaded_file($data['tmp_img_name'], '../public/images/posts/'.$data['image_unique_name']);
                                flash('post_message', 'Post Updated Successfully.');
                                return $this->show($id);
                            } else {
                                die('Something went wrong');
                            }
                        } else {
                            // Load view with errors
                            $this->view('posts/edit', $data);
                        }
                    } else {
                        $data['image_unique_name'] = $post->image;
                        $this->postModel->updatePost($data);
                        flash('post_message', 'Post Updated Successfully.');
                        return $this->show($id);
                    }

                } else {
                    // Load view with errors
                    $this->view('posts/edit', $data);
                }

            } else {
                // Check for owner
                $post = $this->postModel->getPostById($id);

                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts');
                }

                $data = [
                    'id'    => $id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'image' => $post->image
                ];

                return $this->view('posts/edit', $data);
            }
        }

        public function delete($id)
        {
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                // Check for owner
                $post = $this->postModel->getPostById($id);

                if($post->user_id != $_SESSION['user_id']) {
                    redirect('posts');
                }

                if($this->postModel->deletePost($id)) {

                    if(file_exists("../public/images/posts/".$post->image)) {
                        unlink("../public/images/posts/".$post->image);
                    }

                    flash('post_message', 'Post Deleted Successfully.');
                    redirect('posts');

                } else {
                    die("Something went wrong");
                }

            } else {
                redirect('posts');
            }
        }

        public function my_post()
        {
//            // Check for owner
//            $post = $this->postModel->getPostById($id);
//
//            if($post->user_id != $_SESSION['user_id']) {
//                redirect('posts');
//            }

            $userPosts = $this->postModel->postByUser($_SESSION['user_id']);

            $data = [
               'userPosts' => $userPosts
            ];

            $this->view('posts/user_posts', $data);
        }

    }