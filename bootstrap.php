<?php

use M4ciej\CinemaManagement\Base\Connection;
require __DIR__ . '/vendor/autoload.php';
require_once 'config.php';
/*spl_autoload_register(function ($class_name) {
        //class directories
        $directories = array(
            '/Entity/',
            '/Repository/',
            '/Base/'
        );
       
        //for each directory
        foreach($directories as $directory)
        {
            //see if the file exsists
            if(file_exists(__DIR__.$directory.$class_name . '.php'))
            {
                require_once(__DIR__.$directory.$class_name . '.php');
                //only require the class once, so quit after to save effort (if you got more, then name them something else
                return;
            }           
        }
    });*/
$conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
$conn->set_charset("UTF8");
$connection=new Connection($conn);
M4ciej\CinemaManagement\Repository\CinemaRepository::SetConnection($connection);