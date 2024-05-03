<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "luffy";
    $conn = mysqli_connect($servername,$username,$password,$databasename) or die("Connection Failed ". mysqli_connect_error($conn));
?>