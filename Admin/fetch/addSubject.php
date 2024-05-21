<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["courseId"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["courseName"]))) 
        {
            echo "To proceed please fill all mandatory fields!";
        } 
        else 
        {
            $courseName = trim($_POST["courseName"]);
            $courseId = trim($_POST["courseId"]);
            $dept = trim($_POST["dept"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `subjects` SET `Course_id`=?,`Course_name`=?,`dept`=? WHERE `id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $courseId, $courseId,$dept,$_POST["id"]);
                try{
                    if ($stmt->execute()) {
                        echo 1;
                    } else {
                        echo "Unable to update. Please try again!";
                    }
                }catch(Exception $e){
                    echo 'Potential issues: duplicate entry or invalid data. please try again';
                }
            }
            else {
                $sql = "INSERT INTO `subjects`(`Course_id`,`Course_name`, `dept`) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $courseId,$courseName,$dept);
                try{
                    if ($stmt->execute()) {
                        echo 1;
                    } else {
                        echo "Something went wrong. Please try again!";
                    }
                }catch(Exception $e)
                {
                    echo 'Potential issues: duplicate entry or invalid data. please try again';
                }
            }
    }
} else {
    echo "Critical error occured!";
}
?>
