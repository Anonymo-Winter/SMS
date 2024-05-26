<?php 
    require_once "../../config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $tid = htmlspecialchars(trim($_POST["tid"]));
        if(empty(trim($tid)))
        {
            echo "To proceed please fill all mandatory fields!";
        }
        else{
            $str = "";
            $sql = "SELECT * FROM `teachers` where id = '{$tid}'";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $subjects = explode(",",$row['subjects']);
                    for($i=0; $i < sizeof($subjects); $i++)
                    {
                        $sql1 = "select Course_id from subjects where Course_name = '$subjects[$i]'";
                        $sql1 = mysqli_fetch_assoc(mysqli_query($conn,$sql1));
                        $str .= "<option value='$sql1[Course_id]'>{$subjects[$i]}</option>";
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