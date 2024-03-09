<?php

    function connection(){

        $host ="localhost";
        $username = "root";
        $password = "12345";
        $database = "employee_system";
        
        $con = new mysqli($host, $username, $password, $database);
        
        if($con->connect_error){
            echo $con->connect_error;
        } else{

        return $con;

        }
    }
