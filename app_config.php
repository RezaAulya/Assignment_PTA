<?php 
    header('Access-Control-Allow-Origin: *'); 
	
    $cekUrL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    
    // Localhost
    if (strpos($cekUrL, '127.0.0.1') !== false) {
        // DB Config
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'testedmodo');
        $base_url="http://127.0.0.1/Assignment/";
    }else if(strpos($cekUrL, 'localhost') !== false) {
        // DB Config
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_DATABASE', 'testedmodo');
        $base_url="http://localhost/Assignment/"; 
    }else{ 
        // SERVER SIDE
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'Aditya!@#4');
        define('DB_DATABASE', 'testedmodo');
        $base_url="http://apaini-as.cloud.revoluz.io/Assignment/";
    }



    $app_name="E-Assignment";
    $app_version="1.0.0";
    $cpr='Copyright © ' . date("Y") ;
    

    //  VALIDATE SIDEMENU ACTIVE 
    $pwd = str_replace('/Assignment','',$_SERVER['REQUEST_URI']) . '/';

    // SOSMED
    $app_fb="";
    $app_tw="";
    $app_ig="";
    $app_yt="";
    
?>