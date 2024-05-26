<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["sname"])) || empty(trim($_POST["sid"])) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["srollno"]))) 
        {
            echo "To proceed please fill all mandatory fields!";
        }
        else 
        {
            $name = htmlspecialchars(trim($_POST["sname"]));
            $id = htmlspecialchars(trim($_POST["sid"]));
            $class = htmlspecialchars(trim($_POST["sclass"]));
            $dept = htmlspecialchars(trim($_POST["dept"]));
            $rollno = htmlspecialchars(trim($_POST["srollno"]));
            if(checkrollno($rollno) && checkid($id) && checkname(strtoupper($name))) {
                if (isset($_POST["update"])){
                    $sql = "UPDATE `students` SET `Sname`=?,`Sclass`=?,`Sid`=?,`Srollno`=?,`dept`=? WHERE `Sid`=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $name, $class,$id,$rollno,$dept,$_POST["id"]);
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
                    $sql = "INSERT INTO `students`(`Sid`, `Sname`, `Sclass`,`Srollno`,`dept`) VALUES (?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $id, $name, $class,$rollno,$dept);
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
            else{
                echo "Invalid data. Please try again!";
            }
    }
} else {
    echo "Something went wrong. Please try agian later!";
}

function checkid($id){
    $idpattern = '/^[S]\d{6,10}$/';
    return preg_match($idpattern, $id);
}
function checkrollno($rollNo){
    $idpattern = '/^\d{1,3}$/';
    return preg_match($idpattern, $rollNo);
}

function checkname($name){
    $namepattern = '/^[a-zA-Z ]+$/';
    return preg_match($namepattern, $name);
}

?>
