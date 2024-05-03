<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["courseId"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["courseName"]))) 
        {
            $error++;
            echo "Err 404 : Bad Gateways";
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
                        echo 0;
                    }
                }catch(Exception $e){
                    echo '';
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
                        echo 0;
                    }
                }catch(Exception $e)
                {
                    echo 0;
                }
            }
    }
} else {
    echo "Err 404 : Bad Gateways";
}
?>
