<?php
    /*
    *
    * Base Controller
    * Loads Models and Views
    *
    */

    class Controller {
        // Load Model
        public function model($model)
        {
            // Require Model
            require_once '../app/models/' . $model . '.php';
            //Instantiate Model
            return new $model();
        }

        //Load View
        public function view($view, $data = [])
        {
            // Check if view file exists or not
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else {
                die('View file does not exists');
            }
        }
    }