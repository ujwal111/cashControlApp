<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "child_control";


    $connect = mysqli_connect($hostname,$username,$password,$databasename);

    if(!$connect){
        die("The database could not be connected");
    }

?>