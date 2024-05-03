<?php 
require_once "../include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["upass"]);
    $role = trim($_POST["role"]);

    if ($uname == "" && $upass == "") {
        echo 0;
    } else { 
        if ($role == "teacher") {
            $sql = "SELECT * FROM  teachers WHERE user_name = ? AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("ss", $uname, $upass);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                print_r($result);
                if ($result->num_rows > 0) {
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                    header("location: welcome.php");
                } else {
                    echo "false";
                }
            } else {
                echo -1;
            }
        } else if ($role == "student") {
            $sql = "SELECT * FROM  students WHERE Sid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("s", $uname); // Assuming Sid is the username
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            } else {
                echo -1;
            }
        } else {
            echo -2;
        }
    }
}
?>