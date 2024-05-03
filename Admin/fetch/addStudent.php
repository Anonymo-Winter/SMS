<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["sname"])) || empty(trim($_POST["sid"])) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["srollno"]))) 
        {
            $error++;
            echo "Err 404 : Bad Gateways";
        } 
        else 
        {
            $name = trim($_POST["sname"]);
            $id = trim($_POST["sid"]);
            $class = trim($_POST["sclass"]);
            $dept = trim($_POST["dept"]);
            $rollno = trim($_POST["srollno"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `students` SET `Sname`=?,`Sclass`=?,`Sid`=?,`Srollno`=?,`dept`=? WHERE `Sid`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $name, $class,$id,$rollno,$dept,$_POST["id"]);
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
                $sql = "INSERT INTO `students`(`Sid`, `Sname`, `Sclass`,`Srollno`,`dept`) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $id, $name, $class,$rollno,$dept);
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
