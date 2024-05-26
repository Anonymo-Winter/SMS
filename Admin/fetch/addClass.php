<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_POST["sclass"]) || !isset($_POST["dept"]) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"]))) 
        {
            echo "To proceed please fill all mandatory fields!";
        } 
        else 
        {
            $cls = trim($_POST["sclass"]);
            $dept = trim($_POST["dept"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `classes` SET `Sclass`=?,`dept`=? WHERE `id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $cls, $dept,$_POST["id"]);
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
                $sql = "INSERT INTO `classes`(`Sclass`, `dept`) VALUES (?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $cls, $dept);
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
