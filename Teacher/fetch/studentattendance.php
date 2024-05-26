<?php
    require_once '../../config.php';
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["class_id"],$_POST['courseid'],$_POST["sid"]))
    {
        $classId = htmlspecialchars($_POST['class_id']);
        $course_id = htmlspecialchars($_POST['courseid']);
        $sid = htmlspecialchars($_POST["sid"]);
        if(checkstudent($_POST["sid"],$_POST["class_id"],$conn))
        {
            $query = "  SELECT * FROM attendance a INNER JOIN students s ON s.Sid=a.Sid 
                        WHERE Class_id = '$classId' and 
                        Course_id = '$course_id' and a.Sid = '$sid'";

            $result = mysqli_query($conn, $query);
            if ($result) {
                $attendanceData = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $attendanceData[] = $row;
                }
                echo json_encode($attendanceData);
            } 
            else {
                echo json_encode(array("error" => "Failed to get data. Please try again later!"));
            }
        }
        else{
            echo json_encode(array("error" => "Invalid Student ID or Student doesn't belong to provided class"));
        }
    }
    else{
        echo json_encode(array("error" => ""));
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
?>
