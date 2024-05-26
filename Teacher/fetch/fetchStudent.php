<?php 
    require_once '../../config.php';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_GET["action"]) && isset($_POST["sclass"]))
        {
            $action = htmlspecialchars($_GET["action"]);
            $sql = "select * from $action where Sclass='{$_POST["sclass"]}' order by Srollno";
            $result = mysqli_query($conn,$sql);
            if($result){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $data[] = $row; 
                }
                // echo $data;
                echo json_encode($data);
            }
            else 
            {
                echo json_encode(array("error" => "Failed to fetch data from the database."));
            }
        }
    }
    else{
        echo json_encode(array("error" => "Err 404 : Bad Gate Ways"));
    }

?>