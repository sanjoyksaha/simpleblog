<?php

class Home extends Controller{

    public function __construct()
    {

            $this->postModel = $this->model('Post');

    }

    public function index()
    {

        $posts = $this->postModel->getAllPost();


        $data = [
            'title'         => 'Welcome To Share Posts',
            'description'   => 'Here you can posts your own ideas, feelings, thoughts and anything that you have in your mind and grow up your community.',
            'order'         => 'If you want to join with us than click the button bellow.',
            'posts'         => $posts
        ];

        $this->view('welcome', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App To Share Posts With Other Users And Build Your Community.'
        ];

        $this->view('about', $data);
    }
}