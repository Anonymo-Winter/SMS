<?php 
    require_once "../include/config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $dept = trim($_POST["dept"]);
        if(empty($dept))
        {
            echo 0;
        }
        else{
            $sql = "SELECT * FROM subjects where dept = '{$dept}'";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    $str .= "<option value='$row[Course_name]'>{$row['Course_name']}</option>";
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