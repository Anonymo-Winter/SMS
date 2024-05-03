<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "luffy";
    try{
        $conn = mysqli_connect($servername,$username,$password,$databasename);
    }catch(Exception){
        $conn="";
    }
    // if(!$conn){
        // die("Connection Failed".mysqli_connect_error($conn));
    // }
    // else{
    //     echo "success";
    // }
?>