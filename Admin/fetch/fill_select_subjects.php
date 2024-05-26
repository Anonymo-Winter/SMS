<?php 
    require_once "../../config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $dept = htmlspecialchars(trim($_POST["dept"]));
        if(empty($dept))
        {
            echo "To proceed please fill all mandatory fields!";
        }
        else{
            $sql = "SELECT * FROM `subjects` where dept = '{$dept}'";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    $str .= "<option value='".htmlspecialchars($row['Course_name'])."'>".htmlspecialchars($row['Course_name'])."</option>";
                }
            }
            else{
                echo "null";
                exit;
            }
            echo $str;
        }
    }
?>