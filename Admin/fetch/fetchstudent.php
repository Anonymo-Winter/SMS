<?php
require_once '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["action"])) {
        $action = htmlspecialchars($_GET["action"]);

        $allowed_tables = ['students', 'class_crs','classes','teachers','subjects'];
        if (in_array($action, $allowed_tables)) {
            $sql = "SELECT a.*,d.dept_name FROM `$action` a, `department` d WHERE a.dept = d.depId";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $data = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row; 
                }
                echo json_encode($data);
            } else {
                echo json_encode(array("error" => "Failed to fetch data from the database."));
            }
        } else {
            echo json_encode(array("error" => "Something went wrong. Please try again."));
        }
    } else {
        echo json_encode(array("error" => "Something went wrong. Please try again."));
    }
} else {
    echo json_encode(array("error" => "Something went wrong. Please try again."));
}
?>
