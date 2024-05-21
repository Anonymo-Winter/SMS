<?php 
require_once "../include/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST["uname"]);
    $upass = trim($_POST["upass"]);
    if (empty($uname) && empty($upass)) {
        echo 0;
    } else { 
        $sql = "SELECT * FROM  students WHERE Sid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("s", $uname);    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $result = $result->fetch_assoc();
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["sid"] = $result["Sid"];
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
?>
