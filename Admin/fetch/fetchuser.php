<?php 
    require_once "../../config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = htmlspecialchars(trim($_POST["uname"]));
        $upass = htmlspecialchars(trim($_POST["upass"]));
        if (empty($uname) || empty($upass)) {
            echo 0;
        } else {
            $sql = "SELECT * FROM `admin` WHERE username = ?";
            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) {
                echo "Failed to prepare statement!";
                exit;
            }
            $stmt->bind_param("s", $uname);    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    // Verify the password 
                    if (password_verify($upass,$row["password"])) {
                        session_start();
                        $_SESSION["admin_loggedin"] = true;
                        $_SESSION["admin_username"] = "Admin";    
                        echo 1;
                    } else {
                        echo 'Invalid username or password!';
                    }
                } else {
                    echo 'Invalid username or password!';
                }
            } else {
                echo "Something went wrong. Please try again later!";
            }
        }
    }
?>
