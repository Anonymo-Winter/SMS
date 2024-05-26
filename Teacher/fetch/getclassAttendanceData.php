<?php 
require_once '../../config.php';

if(isset($_GET["action"]) && $_GET["action"] == "individual")
{
    $classId = htmlspecialchars($_POST['class_id']);
    $courseId = htmlspecialchars($_POST['courseid']);
    $query = "SELECT s.*, sum(status) AS attendance_count
                FROM attendance a
                INNER JOIN students s ON s.Sid = a.Sid
                WHERE a.CLass_id = ? AND a.Course_id = ? 
                GROUP BY s.Sid";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $classId, $courseId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $attendanceData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($attendanceData);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
}
else
{
    if (isset($_POST['class_id'], $_POST['courseid'])) {
        $classId = htmlspecialchars($_POST['class_id']);
        $courseId = htmlspecialchars($_POST['courseid']);

        $query = "SELECT s.*, sum(status) AS attendance_count
                FROM attendance a
                INNER JOIN students s ON s.Sid = a.Sid
                WHERE a.Class_id = ? AND a.Course_id = ?
                GROUP BY s.Sid";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $classId, $courseId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $attendanceData = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($attendanceData);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Error: class_id and courseid parameters are required and must be numeric.";
    }
}
?>
