<?php 
    require_once "../include/config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $dept = trim($_POST["dept"]);
        if($dept == "")
        {
            echo 0;
        }
        else{
            $sql = "SELECT * FROM classes where dept = '{$dept}'";
            $result = mysqli_query($conn,$sql);
            $str="<option value=''>--select class--</option>";
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $str .= "<option value='$row[Sclass]'>{$row['Sclass']}</option>";
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