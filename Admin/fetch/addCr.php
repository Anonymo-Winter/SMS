<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["sid"])) || !checkstudent($_POST["sid"],$conn) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"]))) 
        {
            $error++;
            echo "Invalid Data!";
        } 
        else 
        {
            $id = trim($_POST["sid"]);
            $class = trim($_POST["sclass"]);
            $dept = trim($_POST["dept"]);
            if(checkid($id,$class,$dept,$conn))
            {
                if (isset($_POST["update"])){
                    $sql = "UPDATE `class_crs` SET `dept`=?,`Sclass`=?,Sid=? WHERE `id`=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $dept, $class,$id,$_POST["id"]);
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
                    $sql = "INSERT INTO `class_crs`(`dept`, `Sid`, `Sclass`) VALUES (?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $dept, $id, $class);
                    try{
                        if ($stmt->execute()){
                            echo 1;
                        } else {
                            echo "here is error";
                        }
                    }catch(Exception $e)
                    {
                        echo 0;
                    }
                }
            }
            else{
                echo "Invalid Student ID";
            }
    }
} else {
    echo "Err 404 : Bad Gatewys";
}
function checkstudent($id,$conn){
    $stmt = "SELECT * FROM students where Sid='$id'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        return $res->num_rows;
    }
    else{
        return 0;
    }
}

function checkid($id,$class,$dept,$conn){
    $stmt = "SELECT * FROM students where Sid='$id' and dept = '$dept' and Sclass='$class'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        if($res->num_rows == 1)
        {
            return 1;
        }
    }
    else{
        return 0;
    }
}
?>
