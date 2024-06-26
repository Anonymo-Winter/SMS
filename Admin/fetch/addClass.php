<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_POST["sclass"]) || !isset($_POST["dept"]) || !isset($_POST["year"]) || empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["year"]))) 
        {
            echo "To proceed please fill all mandatory fields!";
        } 
        else 
        {
            $cls = trim($_POST["sclass"]);
            $dept = trim($_POST["dept"]);
            $year = trim($_POST["year"]);
            
            if (isset($_POST["update"])){
                $sql = "UPDATE `classes` SET `Sclass`=?,`dept`=?,year=? WHERE `id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $cls, $dept,$year,$_POST["id"]);
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
                $sql = "INSERT INTO `classes`(`Sclass`, `dept`,`year`) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $cls, $dept,$year);
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
