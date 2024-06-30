<?php   
    $conn = mysqli_connect("localhost","root","","newluffy");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $pass = $_POST["pass"];
        if(password_verify($pass,"$2y$10$6AOcie2D16IYXD2/CCymzOr9ksrecwNnh8N1aOA.uLh7YvoUOqjWK"))
        {
            echo "success";
        }
        else{
            echo "wrong";
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="pass" id="pass">
        <input type="submit" value="submit">
    </form>

</body>
</html>