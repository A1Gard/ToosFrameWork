<?php

session_start();
//unset($_SESSION['notification']);
require_once './tconfig.php';

if (_DBG_):
    
    echo '<pre>';
    
    echo "server: \n";
    print_r($_SERVER);
    echo "post: \n";
    print_r($_POST);
    echo "get: \n";
    print_r($_GET);
    echo "session: \n";
    print_r($_SESSION);
    echo "cookie: \n";
    print_r($_COOKIE);
    
    echo '</pre>';
    
endif;