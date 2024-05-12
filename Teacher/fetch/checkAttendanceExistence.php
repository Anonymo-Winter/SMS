<?php

require_once '../include/config.php';

if (isset($_POST['class_id']) && isset($_POST['date']) && isset($_POST['courseid'])
    && !empty(trim($_POST['class_id'])) && !empty(trim($_POST['date'])) && !empty(trim($_POST['courseid']))) {
    $classId = $_POST['class_id'];
    $date = $_POST['date'];
    $course_id = $_POST['courseid'];
    $query = "SELECT * FROM attendance WHERE class_id = '$classId' AND attendance_date = '$date' and Course_id = '$course_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) { 
        echo 0;
    } else {
        echo 1;
    }
} else {
    echo -1;
}
?>
