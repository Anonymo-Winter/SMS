<?php 
    require_once "../../config.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = htmlspecialchars(trim($_POST["uname"]));
        $upass = htmlspecialchars(trim(($_POST["upass"])));
        if (empty($uname) && empty($upass)){
            echo 0;
        } else{
            $sql = "SELECT * FROM  `teachers` WHERE user_name = ? AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("ss", $uname, $upass);    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $result = $result->fetch_assoc();
                    session_start();
                    $_SESSION["teacher_loggedin"] = true;
                    $_SESSION["username"] = htmlspecialchars($result["tname"]);    
                    $_SESSION["teacher_id"] = htmlspecialchars($result["id"]); 
                    echo 1;
                } else {
                    echo 'Failed to fetch data. try again later!';
                }
            } else {
                echo "Something went wrong. Please try again later!";
            }
        }
    }
?>
