<?php

    // Simple function for redirect url

    function redirect($page)
    {
        header('location: '. ROOT_URL . '/' . $page);
    }
