<?php
require_once "../include/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadFile = $_FILES["file"]["tmp_name"];
        $uploadFileName = $_FILES["file"]["name"];
        $fileExtension = pathinfo($uploadFileName, PATHINFO_EXTENSION);
        if ($fileExtension != 'csv') {
            die("Error: Uploaded file is not a CSV.");
        } else {
            $count=0;
            $csvFile = $uploadFile;
            $rowsToInsert = array();
            $err = array();
            $errors = false;
            if (($handle = fopen($csvFile, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $count+=1;
                    if (count($data) == 5 && checkid(strtoupper($data[0])) &&  checkstudent($data[0],$data[1],$data[2],$conn) && checkclass(strtoupper($data[2]),$conn) && checkdept($data[1],$conn)) {
                        $rowsToInsert[] = $data;
                    } else {
                        $err[] = implode(",",$data);
                        $errors = true;
                    }
                }
                fclose($handle);
            }
            if (!empty($err)) {
                echo "The following lines had parsing errors:";
                foreach ($err as $e) {
                    echo "\n$e";
                }
            }
            try { 
                $conn->begin_transaction();
                $check = $conn->prepare("SELECT * FROM class_crs WHERE Sid = ?");
                $stmt = $conn->prepare("INSERT INTO class_crs (Sid, dept,Sclass) VALUES (?, ?, ?);");
                $good=false;
                foreach ($rowsToInsert as $row) {
                    $check->bind_param("s", $row[0]);
                    if ($check->execute()){
                        $check->store_result();
                        if ($check->num_rows() == 0) {
                            $stmt->bind_param("sss", $row[0], $row[1], $row[2]);
                            if ($stmt->execute()) {
                            } else {
                                echo "Error inserting record: " .$stmt->error;
                                $good=false;
                            }
                        }
                    } else {
                        echo "Error Occured!";
                    }
                }
                if(!$good && $errors==false)
                {
                    echo "success";
                }
                $stmt->close();
                $check->close();

            }
            catch(Exception){
                echo "error";
            }
            $conn->commit();
            $conn->close();
        }
    } else {
        echo "Invalid File!";
    }
}

function checkid($id){
    $idpattern = '/^[S]\d{6}$/';
    return preg_match($idpattern, $id);
}

function checkclass($class,$conn){
    $stmt = "SELECT * FROM classes where Sclass='$class'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        if($res->num_rows)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    else{
        return 0;
    }
}
function checkstudent($Sid,$dept,$class,$conn){
    $stmt = "SELECT * FROM students where Sclass='$class' and dept = '$dept' and Sid='$Sid'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        if($res->num_rows)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    else{
        return 0;
    }
}
function checkdept($dept,$conn){
    $stmt = "SELECT * FROM department where dept_name='$dept'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        if($res->num_rows)
        {
            return 1;
        }
        else{
            return 0;
        }
    }
    else{
        return 0;
    }
}
?>
