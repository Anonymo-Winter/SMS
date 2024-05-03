<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = 0;
        if (empty(trim($_POST["tname"])) || empty(trim($_POST["sclass"])) ||  empty(trim($_POST["crid"])) || empty(trim($_POST["courseid"])) ) 
        {
            $error++;
            echo "Err 404 : Bad Gateways";
        } 
        else 
        {
            $tid = trim($_POST["tid"]);
            $tname = trim($_POST["tname"]);
            $sclass = trim($_POST["sclass"]);
            $Course_id = trim($_POST["courseid"]);
            $Cr_id = trim($_POST["crid"]);
            if (isset($_POST["update"])){
                $sql = "UPDATE `allocate_teacher` SET `tname`=?,`Sclass`=?,`Course_id`=?,`Cr_id`=? WHERE `tid`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $tname, $sclass,$Course_id,$Cr_id,$_POST["tid"]);
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
                $sql = "INSERT INTO `allocate_teacher`(`tid`,`tname`, `Sclass`, `Course_id`,`Cr_id`) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss",$tid,$tname, $sclass, $Course_id,$Cr_id);
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
