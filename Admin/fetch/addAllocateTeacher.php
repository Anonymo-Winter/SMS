<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["sclass"],$_POST["dept"],$_POST["courseid"],$_POST["tid"]) || empty(trim($_POST["tid"])) ||
            empty(trim($_POST["sclass"])) || empty(trim($_POST["courseid"])) || empty(trim($_POST["dept"])) ) 
        {
            echo "To proceed please fill all mandatory fields!";
        }
        else 
        {
            $tid = htmlspecialchars(trim($_POST["tid"]));
            $sclass = htmlspecialchars(trim($_POST["sclass"]));
            $Course_id = htmlspecialchars(trim($_POST["courseid"]));
            if (isset($_POST["update"])){
                $sql = "UPDATE `allocate_teacher` SET `Sclass`=?,`Course_id`=? WHERE `tid`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $sclass,$Course_id,$tid);
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
                $sql = "INSERT INTO `allocate_teacher`(`tid`, `Sclass`, `Course_id`) VALUES (?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss",$tid,$sclass, $Course_id);
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
