<?php

    session_start();

    // Flash Message Helper
    // Example -  flash('register_success', 'Your registration successfully completed')
    // Display in view - echo flash('register_success) 
    function flash($name = '', $message = '', $class = "alert alert-success")
    {
        if(!empty($name)) {
            if(!empty($message) && empty($_SESSION[$name])) {
                if(!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                
                if(!empty($_SESSION[$name . '_class'])) {
                    unset($_SESSION[$name . '_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif(empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="'.$class.'" id="msg-flash" role="alert"><strong>'.$_SESSION[$name].'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    function isLoggedIn()
    {
        if(isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }