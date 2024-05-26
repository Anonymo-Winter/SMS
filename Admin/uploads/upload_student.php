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
                    if (count($data) == 5 && checkrollno($data[0],strtoupper($data[4]),$conn) && checkid(strtoupper($data[1])) && checkname(strtoupper($data[2])) && checkclass(strtoupper($data[4]),$conn) && checkdept($data[3],$conn)) {
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
                $check = $conn->prepare("SELECT * FROM students WHERE Sid = ?");
                $stmt = $conn->prepare("INSERT INTO students (Srollno,Sid, Sname, dept,Sclass) VALUES (?, ?, ?, ?, ?);");
                $good=false;
                foreach ($rowsToInsert as $row) {
                    $check->bind_param("s", $row[1]);
                    if ($check->execute()){
                        $check->store_result();
                        if ($check->num_rows() == 0) {
                            $stmt->bind_param("sssss", $row[0], $row[1], $row[2],$row[3],$row[4]);
                            if (!$stmt->execute()) {
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
            }
            catch(Exception){
                echo "error";
            }
            $conn->commit();
            $stmt->close();
            $check->close();
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
?>
