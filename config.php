<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "newluffy";
    try{
        $conn = mysqli_connect($servername,$username,$password,$databasename);
    }catch(Exception){
        $conn="";
    }
?>