<?php
    require_once '../../config.php';
    if(isset($_GET["action"]) && $_GET["action"] == "individual")
    {
        $classId = htmlspecialchars($_POST['class_id']);
        $date = htmlspecialchars($_POST['date']);
        $course_id = htmlspecialchars($_POST['courseid']);
        $sid = htmlspecialchars($_POST["sid"]);
        if(checkstudent($sid,$classId,$conn))
        {
            $query = "SELECT * FROM attendance a INNER JOIN students s ON s.Sid=a.Sid 
                        WHERE Class_id = '$classId' AND attendance_date = '$date' and 
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
        if (isset($_POST['class_id']) && isset($_POST['date']) && isset($_POST['courseid'])) {
            $classId = htmlspecialchars($_POST['class_id']);
            $date = htmlspecialchars($_POST['date']);
            $course_id = htmlspecialchars($_POST['courseid']);

            $query = "SELECT * FROM attendance a INNER JOIN students s ON s.Sid=a.Sid WHERE Class_id = '$classId' AND attendance_date = '$date' and Course_id = '$course_id'";

            $result = mysqli_query($conn, $query);
            if ($result) {
                $attendanceData = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $attendanceData[] = $row;
                }
                echo json_encode($attendanceData);
            } else {
                echo "Error: ";
            }
        } else {
            echo "Error: classId and date parameters are required.";
        }
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
