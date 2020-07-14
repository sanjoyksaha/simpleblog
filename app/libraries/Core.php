<?php
    /*
    *
    * App Core Class
    * Create URL & loads core controller
    * URL FORMAT - /controller/method/params
    *
    */

    class Core {
        protected $currentController = 'Home';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            // print_r($this->getUrl());

            // $url = ($this->getUrl() == null) ? '0' : $this->getUrl();

            $url = $this->getUrl();

            // Look in controllers for controller
            if(isset($url[0])){
                if(file_exists('../app/controllers/'. ucwords($url[0]). '.php')){
                    // If exists set as controller
                    $this->currentController = ucwords($url[0]);
                    // Unset 0 Index
                    unset($url[0]);
                }
            }

            // Require the controller
            require_once '../app/controllers/'. $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check second part of the url
            if(isset($url[1])){
                // Check to if the method is exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Get params
            $this->params =$url ? array_values($url) : [];

            // Call a callback with an array
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

        public function getUrl()
        {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }