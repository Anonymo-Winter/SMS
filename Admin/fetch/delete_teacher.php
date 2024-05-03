<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['id'])){
        require_once '../include/config.php';
        $studentId = $_POST['id'];
        $sql = "DELETE FROM teachers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $studentId);
        if($stmt->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo "Student ID not provided";
    }
?>