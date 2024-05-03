<?php

    function connection(){

        $host ="localhost";
        $username = "pos";
        $password = "p0z_$1m)L@t05*t";
        $database = "employee_system";
        
        $con = new mysqli($host, $username, $password, $database);
        
        if($con->connect_error){
            
            echo $con->connect_error;
        } else{

        return $con;

        }
    }
