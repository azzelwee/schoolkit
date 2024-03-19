<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['delete'])){

    $id = $_POST['ID'];
    $sql = "DELETE FROM employee_list WHERE id = '$id'";
    $con->query($sql) or die ($con->error);

    if($con){
        $_SESSION['status-delete'] = "Data Deleted Successfully";
        header('Location: employee.php');
    } else{
        echo "Something went wrong";
    }
}