<?php 
require_once "../../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["upass"]);
    $role = trim($_POST["role"]);

    if (empty($uname) && empty($upass)) {
        echo 0;
    } else { 
        if ($role == "teacher") {
            $sql = "SELECT * FROM  teachers WHERE user_name = ? AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("ss", $uname, $upass);    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $result = $result->fetch_assoc();
                    print_r($result);
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $result["id"];
                    $_SESSION["username"] = $result["tname"];  
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo "Error Occured!";
            }
        } else if ($role == "student") {
            $sql = "SELECT * FROM  students WHERE Sid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("s", $uname);    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $result = $result->fetch_assoc();
                    print_r($result);
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $result["Sid"];
                    $_SESSION["username"] = $result["Sname"];    
                    echo 1;                        
                } else {
                    echo 0;
                }
            } else {
                echo "Error Occured!";
            }
        }
    }
}
?>
