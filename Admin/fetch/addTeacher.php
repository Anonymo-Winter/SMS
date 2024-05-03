<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["tname"])) || empty(trim($_POST["uname"])) || empty(trim($_POST["tphone"]))
         ||  empty(trim($_POST["password"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["subject"])))
        {
            echo "please fields are required";
        } 
        else 
        {
            $tname = trim($_POST["tname"]);
            $uname = trim($_POST["uname"]);
            $tphone = trim($_POST["tphone"]);
            $password = trim($_POST["password"]);
            $subject = $_POST["subject"];
            $dept = trim($_POST["dept"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `teachers` SET `tname`=?,`user_name`=?,`password`=?,`phone_no`=?,`dept`=?,`subjects`=? WHERE `id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssss", $tname, $uname,$password,$tphone,$dept,$subject,$_POST["id"]);
                try{
                    if ($stmt->execute()) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }catch(Exception $e){
                    echo '';
                }
            }
            else {
                $sql = "INSERT INTO `teachers`(`tname`, `user_name`, `password`,`phone_no`,`dept`,`subjects`) VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $tname, $uname, $password,$tphone,$dept,$subject);
                try{
                    if ($stmt->execute()) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                }catch(Exception $e)
                {
                    echo 0;
                }
            }
    }
} else {
    echo "Err 404 : Bad Gatewals";
}
?>
