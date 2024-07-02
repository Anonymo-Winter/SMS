<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['id'])){
        require_once '../../config.php';
        $studentId = htmlspecialchars($_POST['id']);
        $sql = "DELETE FROM `teachers` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        if($stmt->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo "Something went wrong. Please try again later!";
    }
?>