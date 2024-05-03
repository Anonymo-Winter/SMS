<?php 
    require_once "../include/config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $tid = trim($_POST["tid"]);
        if(empty(trim($tid)))
        {
            echo 0;
        }
        else{
            $str = "";
            $sql = "SELECT * FROM teachers where id = '{$tid}'";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    $subjects = explode(",",$row['subjects']);
                    for($i=0; $i < sizeof($subjects); $i++)
                    {
                        $str .= "<option value='$subjects[$i]'>{$subjects[$i]}</option>";
                    }
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