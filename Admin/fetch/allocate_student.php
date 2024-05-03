<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["sid"])) || empty(trim($_POST["sclass"])) || empty(trim($_POST["srollno"]))) 
        {
            $error++;
            echo "Err 404 : Bad Gateways";
        } 
        else 
        {
            $rollno = trim($_POST["srollno"]);
            $id = trim($_POST["sid"]);
            $class = trim($_POST["sclass"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `student_class` SET `Sid`=?,`Sclass`=?,Srollno=? WHERE `id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $id, $class,$rollno,$_POST["id"]);
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
                $sql = "INSERT INTO `student_class`(`Sid`, `Srollno`, `Sclass`) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $id, $rollno, $class);
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
