<?php 
    require_once '../include/config.php';
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["action"]))
        {
            $action = htmlspecialchars($_GET["action"]);
            $sql = "select * from $action";
            $result = mysqli_query($conn,$sql);
            if($result){
                $data = array();
                while($row = $result->fetch_assoc()){
                    $data[] = $row; 
                }
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