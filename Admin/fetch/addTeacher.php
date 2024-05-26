<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["tname"])) || empty(trim($_POST["uname"])) || empty(trim($_POST["tphone"]))
         ||  empty(trim($_POST["password"])) || empty(trim($_POST["dept"])) || empty(trim($_POST["subject"])))
        {
            echo "To proceed please fill all mandatory fields!";
        } 
        else 
        {
            $tname = htmlspecialchars(trim($_POST["tname"]));
            $uname = htmlspecialchars(trim($_POST["uname"]));
            $tphone = htmlspecialchars(trim($_POST["tphone"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            $subject = htmlspecialchars(trim($_POST["subject"]));
            $dept = htmlspecialchars(trim($_POST["dept"]));
            if(checkname(strtoupper($tname)) && checkphone($tphone)) {

                if (isset($_POST["update"])){
                    $sql = "UPDATE `teachers` SET `tname`=?,`user_name`=?,`password`=?,`phone_no`=?,`dept`=?,`subjects`=? WHERE `id`=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssss", $tname, $uname,$password,$tphone,$dept,$subject,$_POST["id"]);
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
                    $sql = "INSERT INTO `teachers`(`tname`, `user_name`, `password`,`phone_no`,`dept`,`subjects`) VALUES (?,?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $tname, $uname, $password,$tphone,$dept,$subject);
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
function checkname($name){
    $namepattern = '/^[a-zA-Z ]+$/';
    return preg_match($namepattern, $name);
}

function checkphone($phone){
    $idpattern = '/^\d{10}$/';
    return preg_match($idpattern, $phone);
}
?>
