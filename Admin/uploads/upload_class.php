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
                    if (count($data) == 3 && checkrollno($data[0]) && checkclassname(strtoupper($data[1])) && checkdept($data[2],$conn)) {
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
                $check = $conn->prepare("SELECT * FROM classes WHERE Sclass = ?");
                $stmt = $conn->prepare("INSERT INTO classes (id, Sclass, dept) VALUES (?, ?, ?);");
                $good=false;
                foreach ($rowsToInsert as $row) {
                    $check->bind_param("s", $row[1]);
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
function checkrollno($rollNo){
    $idpattern = '/^\d{1,3}$/';
    return preg_match($idpattern, $rollNo);
}

function checkclassname($name){
    $namepattern = '/^[a-zA-Z0-9_-]+$/';
    return preg_match($namepattern, $name);
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
        else{
            return 0;
        }
    }
    else{
        return 0;
    }
}
?>
