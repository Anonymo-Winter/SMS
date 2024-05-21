<?php
require_once '../include/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        $allowed_tables = ['Students', 'class_crs','classes','teachers','allocate_teacher']; 
        if (in_array($action, $allowed_tables)) {
            $sql = "select a.*,d.dept_name,t.tname from `$action` a,`classes` c,`department` d,`teachers` t where t.id =a.tid and c.dept = d.depId and a.`Sclass`=c.`Sclass`";
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
            echo json_encode(array("error" => "Invalid table name."));
        }
    } else {
        echo json_encode(array("error" => "No action specified."));
    }
} else {
    echo json_encode(array("error" => "502 Bad Gateway"));
}
?>
