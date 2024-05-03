<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['id'])){
        require_once '../include/config.php';
        $id = $_POST['id'];
        $sql = "DELETE FROM Subjects WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        if($stmt->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        echo "Course ID not provided";
    }
?>