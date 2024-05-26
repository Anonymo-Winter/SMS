<?php 
    require_once "../../config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $dept = htmlspecialchars(trim($_POST["dept"]));
        if($dept == "")
        {
            echo "To proceed please fill all mandatory fields!";     
        }
        else{
            $sql = "SELECT * FROM `classes` where dept = '{$dept}'";
            $result = mysqli_query($conn,$sql);
            $str="<option value=''>--select class--</option>";
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $str .= "<option value='".htmlspecialchars($row['Sclass'])."'>".htmlspecialchars($row['Sclass'])."</option>";
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