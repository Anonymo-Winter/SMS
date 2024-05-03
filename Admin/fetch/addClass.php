<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["sclass"])) || empty(trim($_POST["dept"]))) 
        {
            $error++;
            echo "Err 404 : Bad Gateways";
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
                        echo 0;
                    }
                }catch(Exception $e){
                    echo '';
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
