<?php
require_once "../../config.php";
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
                    if (count($data) == 3 && checkid(strtoupper($data[0])) &&  checkstudent($data[0],$data[2],$conn) && checkclass(strtoupper($data[2]),$conn) && checkdept($data[1],$conn)) {
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
                        echo "Oops!,Something went wrong. Failed complete the operation. Please try again later";
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
                echo "Oops!,Something went wrong. Failed complete the operation. Please try again later";
            }
            $conn->commit();
            $conn->close();        }
    } else {
        echo "Oops!,Something went wrong. Failed complete the operation. Please try again later";
    }
}
function checkid($id){
    $idpattern = '/^[S]\d{6}$/';
    return preg_match($idpattern, $id);
}
function checkrollno($rollNo,$class,$conn){
    $idpattern = '/^\d{1,3}$/';
    if(preg_match($idpattern, $rollNo))
    {
        $sql = mysqli_num_rows(mysqli_query($conn,"select * from students where Srollno = '$rollNo' and Sclass='$class'"));
        if($sql == 0)
        {
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}

function checkname($name){
    $namepattern = '/^[a-zA-Z ]+$/';
    return preg_match($namepattern, $name);
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
    }
    else{
        return 0;
    }
}

function checkdept($dept,$conn){
    $stmt = "SELECT * FROM department where depId='$dept'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        if($res->num_rows)
        {
            return 1;
        }
    }
    else{
        return 0;
    }
}
function checkstudent($id,$class,$conn){
    $stmt = "SELECT * FROM students where Sid='$id' and Sclass='$class'";
    $res = mysqli_query($conn,$stmt);
    if($res)
    {
        return $res->num_rows;
    }
    else{
        return 0;
    }
}

?>
