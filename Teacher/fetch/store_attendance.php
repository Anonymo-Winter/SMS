<?php 
    require_once '../include/config.php';
    if(isset($_POST["ids"], $_POST["sids"], $_POST["courseid"], $_POST["class_id"])) {
        $ids = $_POST["ids"];
        $sids = $_POST["sids"];
        $course_id = $_POST["courseid"];
        $class_id = $_POST["class_id"];
        $N = sizeof($sids);
        $date = $_POST["date"];
        $existing_attendance_query = "SELECT * FROM attendance WHERE Course_id = '$course_id' AND Class_id = '$class_id' AND attendance_date = '$date'";
        $existing_attendance_result = mysqli_query($conn, $existing_attendance_query);
        $count = mysqli_num_rows($existing_attendance_result);

        if($count == 0) {
            foreach($sids as $sid) {
                $insert_default_query = "INSERT INTO `attendance`(`Sid`, `Course_id`, `Class_id`, `attendance_date`, `status`) 
                                        VALUES ('$sid', '$course_id', '$class_id', '$date', '0')";
                $insert_default_result = mysqli_query($conn, $insert_default_query);
                if(!$insert_default_result) {
                    echo "Error: " . mysqli_error($conn);
                    exit;
                }
            }
        }

        if(count($ids) > 0){
        // Update attendance for selected students to 'present = 1'
            $update_query = "UPDATE `attendance` SET `status`=? WHERE `Sid`=? and attendance_date=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("iss", $check, $sid,$date);
            $good = false;
            for($i = 0; $i < $N; $i++) {
                $check = in_array($sids[$i], $ids) ? 1 : 0;
                $sid = $sids[$i];
                if(!$stmt->execute()) {
                    $good = true;
                    break;
                }
            }
            if(!$good)
            {
                echo 1;
            }
            else{
                echo 0;
            }
        }
    } else {
        echo "Error: Required POST variables are missing.";
    }
?>
