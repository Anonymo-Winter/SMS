<?php 
    session_start();
    if (isset($_SESSION["teacher_loggedin"]) && $_SESSION["teacher_loggedin"] === true) {
        header("location: ./index.php");
        exit;
    }
    require_once '../config.php';
    if (!$conn) {
        header("location: ./index.html");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <?php include "../include/linker.php" ?>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 p-5">
    <div class="total d-flex justify-content-center shadow-lg bg-light rounded">
        <div class="col left p-0">
            <div class="col left bg-holder"></div>
        </div>
        <div class="col pt-4 pb-4 d-flex flex-column align-items-center my-auto">
            <h1 class="logo-title text-center fw-bold text-uppercase mb-5">Teacher Login</h1>
            <div class="form">
                <form id="loginForm" novalidate>
                    <div class="mb-3">
                        <label for="uname" class="form-label"><b>User Name</b><span class="text-danger">*</span> :</label>
                        <div class="input-group">
                            <span class="input-group-text" id="group-icon"><i class="bx bx-envelope fs-5"></i></span>
                            <input type="text" class="form-control" name="uname" id="uname" aria-describedby="unameerr" required/>
                            <div class="invalid-feedback text-danger d-none" id="unameerr">Please enter a valid name</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="upass" class="form-label"><b>Password</b><span class="text-danger">*</span> :</label>
                        <div class="input-group">
                            <span class="input-group-text" id="group-icon"><i class="bx bx-lock-alt fs-5"></i></span>
                            <input type="password" class="form-control" name="upass" id="upass" aria-describedby="upasserr" required/>
                            <span class="bg-light" id="show"><i class="bx bx-show fs-6"></i></span>
                            <div class="invalid-feedback text-danger d-none" id="upasserr">Please enter a valid password</div>
                        </div>
                    </div>
                    <div class="row text-center px-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4 fs-5 shadow" id="submit-btn" value="Login" disabled>Login</button>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
        let showPassword = true;
        $("#show").on("click", function() {
            const input = $(this).siblings('input');
            if (showPassword) {
                input.attr("type", "text");
                $(this).html('<i class="bx bx-hide"></i>');
            } else {
                input.attr("type", "password");
                $(this).html('<i class="bx bx-show"></i>');
            }
            showPassword = !showPassword;
        });

        $("#loginForm").on("keyup", function() {
            const uname = $("#uname").val().trim();
            const upass = $("#upass").val().trim();
            $("#submit-btn").prop("disabled", !(uname && upass)).css("cursor", uname && upass ? "pointer" : "not-allowed").css("opacity", uname && upass ? "1" : "0.6");
        });

   
                    
               
        $("#loginForm").on("submit", function(e) {
            e.preventDefault();
            const uname = $("#uname").val().trim();
            const upass = $("#upass").val().trim();
            let valid = true;

            if (!uname) {
                $("#uname").addClass("is-invalid");
                valid = false;
            } else {
                $("#uname").removeClass("is-invalid");
            }

            if (!upass) {
                $("#upass").addClass("is-invalid");
                valid = false;
            } else {
                $("#upass").removeClass("is-invalid");
            }

            if (valid) {
                $.ajax({
                    url: './fetch/fetchuser2.php',
                    type: "POST",
                    data: { uname: uname, upass: upass },
                    beforeSend: function() {
                        $("#submit-btn").val("verifying...").prop("disabled", true);
                    },
                    success: function(data) {
                        if (data == 1) {
                            window.location.href = "./index.php";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Credentials',
                                text: 'Please enter valid username and password!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        }
                        $("#submit-btn").val("Login").prop("disabled", false);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Occurred',
                            text: 'An error occurred while processing your request. Please try again later!',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                        $("#submit-btn").val("Login").prop("disabled", false);
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
<?php 
}
?>
