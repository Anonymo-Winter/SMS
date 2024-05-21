<?php
    require_once '../include/config.php';
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["sid"]) && isset($_POST["sclass"]))
    {
        $sid = trim($_POST["sid"]);
        $sclass = trim($_POST["sclass"]);
        $sql = "SELECT * FROM students WHERE Sid= '$sid' and Sclass='$sclass'";
        $query = mysqli_query($conn,$sql);
        if($query)
        {
            if(mysqli_num_rows($query) == 0)
            {
                echo 0;
            }
            else{
                echo 1;
            }
        }
        else{
            echo -1;
        }
    }
    else{
        echo -2;
    }
?>