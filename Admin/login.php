<?php 
    session_start();
    if (isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true) {
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
    <title>Admin Login</title>
    <?php include "./include/linker.php" ?>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Radio+Canada:wght@400;700&display=swap" rel="stylesheet">
    <style>
       body{
        background-color: #f1f1f1;
       }
       input{
        height:3em;
       }
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 p-5">
    <div class="total d-flex shadow-lg">
        <div class="col-6 left d-none d-md-block p-0">
            <div class="bg-holder"></div>
        </div>
        <div class="col-md-6 p-2 d-flex flex-column align-items-center my-auto">
            <h1 class="logo-title text-center fw-bold text-uppercase mb-5">Admin Login</h1>
            <div class="form">
                <form id="loginForm" novalidate>
                    <div class="mb-3">
                        <label for="uname" class="form-label"><b>Username</b><span class="text-danger">*</span>:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-user fs-4"></i></span>
                            <input type="text" class="form-control" name="uname" id="uname" required/>
                            <div class="invalid-feedback">Please enter a valid name</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="upass" class="form-label"><b>Password</b><span class="text-danger">*</span>:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-lock-alt fs-4"></i></span>
                            <input type="password" class="form-control" name="upass" id="upass" required/>
                            <span class="my-auto" id="show"><i class="bx bx-show fs-5"></i></span>
                            <div class="invalid-feedback">Please enter a valid password</div>
                        </div>
                    </div>
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary fs-5 shadow" id="submit-btn" disabled>Login</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let showPassword = false;
            $("#show").on("click", function() {
                const input = $(this).siblings('input');
                if (showPassword) {
                    input.attr("type", "password");
                    $(this).html('<i class="bx bx-show fs-5"></i>');
                } else {
                    input.attr("type", "text");
                    $(this).html('<i class="bx bx-hide fs-5"></i>');
                }
                showPassword = !showPassword;
            });

            $("#loginForm").on("keyup", function() {
                const uname = $("#uname").val().trim();
                const upass = $("#upass").val().trim();
                $("#submit-btn").prop("disabled", !(uname && upass));
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
                        url: './fetch/fetchuser.php',
                        type: "POST",
                        data: { uname: uname, upass: upass },
                        beforeSend: function() {
                            $("#submit-btn").text("verifying...").prop("disabled", true);
                        },
                        success: function(data) {
                            if (data == 1) {
                                window.location.href = "./index.php";
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Invalid Credentials',
                                    text: 'Please enter a valid username and password!',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                });
                            }
                            $("#submit-btn").text("Login").prop("disabled", false);
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Occurred',
                                text: 'An error occurred while processing your request. Please try again later!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                            $("#submit-btn").text("Login").prop("disabled", false);
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
