<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["sid"])) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"]))) 
        {
            $error++;
            echo "To proceed please fill all mandatory fields!";
        }
        else 
        {
            if(checkstudent($_POST["sid"],$_POST["sclass"],$conn))
            {
                $id = htmlspecialchars(trim($_POST["sid"]));
                $class = htmlspecialchars(trim($_POST["sclass"]));
                $dept = htmlspecialchars(trim($_POST["dept"]));

                    if (isset($_POST["update"])){
                        $sql = "UPDATE `class_crs` SET `dept`=?,`Sclass`=?,Sid=? WHERE `id`=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ssss", $dept, $class,$id,$_POST["id"]);
                        try{
                            if ($stmt->execute()) {
                                echo 1;
                            } else {
                                echo "Can't update CR";
                            }
                        }catch(Exception $e){
                            echo 'Failed to update CR';
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
                                echo 'Unable to create new CR';
                            }
                        }catch(Exception $e)
                        {
                            echo 'Failed to create new CR';
                        }
                    }
            }
            else{
                echo "Invalid Student ID or Student doesn't belong to provided class";
            }
    }
} 
else {
    echo "Oops something went wrong. Try again later!!";
}

function checkstudent($id,$class,$conn){
    $stmt = "SELECT * FROM students where Sid='$id' and Sclass='$class'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        return $res->num_rows;
    }
    else{
        return 0;
    }
}
