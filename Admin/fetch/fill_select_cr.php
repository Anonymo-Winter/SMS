<?php 
    require_once "../include/config.php";
    $cls = trim($_POST["sclass"]);
    $sql = "SELECT * FROM class_crs where sclass = '{$cls}'";
    $result = mysqli_query($conn,$sql);
    $str="<option value=''>--select CR--</option>";
    if($result->num_rows>0)
    {
        while($row = $result->fetch_assoc())
        {
            $str .= "<option value='$row[Sid]'>{$row['Sid']}</option>";
        }
    }
    else{
        $str .= "<option value=''>No CR Created</option>";
    }
    echo $str;
?>