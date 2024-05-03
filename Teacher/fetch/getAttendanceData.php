<?php
// getAttendanceData.php

    require_once '../include/config.php';
if (isset($_POST['class_id']) && isset($_POST['date']) && isset($_POST['courseid'])) {
    $classId = $_POST['class_id'];
    $date = $_POST['date'];
    $course_id = $_POST['courseid'];

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
?>
