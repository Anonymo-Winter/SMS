<?php 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: ./index.php");
        exit;
    }
    require_once './include/config.php';
    if(!$conn)
    {
        header("location: ./index.html");
    }
    else{ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
        }
        body{
            background-image: url('anime.jpg');
            background-repeat: no-repeat;
            /* background-size: cover; */
        }
        .radio-tile-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        }

        .radio-tile-group .input-container {
        position: relative;
        height: 70px;
        width: 70px;
        margin: 0.5rem;
        }

        .radio-tile-group .input-container .radio-button {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        margin: 0;
        cursor: pointer;
        }

        .radio-tile-group .input-container .radio-tile {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        border: 2px solid #079ad9;
        border-radius: 5px;
        padding: 1rem;
        transition: transform 300ms ease;
        }

        .radio-tile-group .input-container .icon svg {
        fill: #079ad9;
        width: 2rem;
        height: 2rem;
        }

        .radio-tile-group .input-container .radio-tile-label {
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #079ad9;
        }

        .radio-tile-group .input-container .radio-button:checked + .radio-tile {
        background-color: #079ad9;
        border: 2px solid #079ad9;
        color: white;
        transform: scale(1.05, 1.05);
        }

        .radio-tile-group .input-container .radio-button:checked + .radio-tile .icon svg {
        fill: white;
        background-color: #079ad9;
        }

        .radio-tile-group .input-container .radio-button:checked + .radio-tile .radio-tile-label {
        color: white;
        background-color: #079ad9;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 p-5">
    <div class="container d-flex justify-content-center">
            <form class="col-md-5 bg-light border border-primary rounded px-3 shadow-lg" id="loginForm" novalidate>
                <h3 class="text-center py-3">Login</h3>
                <div class="container">
                    <label for="role" class="form-label">Select your role<span class="text-danger">*</span> :</label><small id="roleerr" class="ms-3 text-danger">(Please select a role)</small>
                    <div class="radio-tile-group btn-group-toggle" data-toggle="buttons">
                    <div class="input-container bg-light">
                        <input class="radio-button" type="radio" name="userrole" id="role" value="teacher" aria-describedby="roleerr" checked required>
                        <label class="radio-tile btn btn-light" for="walk">
                            <div class="icon walk-icon">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1L6 8.3V13h2V9.6l1.8-.7"></path>
                            </svg>
                            </div>
                            <span class="radio-tile-label">Teacher</span>
                        </label>
                    </div>

                    <!-- Similar structure for other options -->
                    <div class="input-container bg-light">
                    <input class="radio-button" type="radio" name="userrole" id="role" value="student" >
                    <label class="radio-tile btn btn-light" for="walk">
                        <div class="icon walk-icon">
                        <svg fill="#000000" height="24" viewBox="0 0 24 24" width="28" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1L6 8.3V13h2V9.6l1.8-.7"></path>
                        </svg>
                        </div>
                        <span class="radio-tile-label">Student</span>
                    </label>
                    </div>
                    </div>
                </div>

                <div id="teacherForm">
                    <div class="form-group px-3">
                        <div class="mb-3 username">
                            <label for="uname" class="form-label">Username<span class="text-danger">*</span> :</label>
                            <input type="text" name="uname" id="uname" class="form-control" placeholder="Enter username" aria-describedby="unameerr" required/>
                            <small id="unameerr" class="text-danger">*This field is required</small>
                        </div>
                        <div class="mb-3 password">
                            <label for="upass" class="form-label">Password<span class="text-danger">*</span> :</label>
                            <input type="password" name="upass" id="upass" class="form-control" placeholder="Enter Password" aria-describedby="upasserr" required/>
                            <small id="upasserr" class="text-danger">*This field is required</small>
                        </div>
                    </div>
                </div>

                <div class="container mb-3 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="Submit" id="submit-btn" style="cursor:not-allowed">
                </div>
                
            </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#uname").focus();
        $("form small").hide();
        function checkuname(){   
            if($("#uname").val().trim() != "")
            {
                $("#unameerr").hide();
                return true;
            }
            else{
                $("#unameerr").show();  
                // setTimeout(() => {
                // $("#unameerr").hide();  
                // }, 5000);
                return false;
            }
        }
        function checkpass(){
            if($("#upass").val().trim() != "")
            {
                $("#upasserr").hide();  
                return true;
            }
            else{
                $("#upasserr").show();  
                // setTimeout(() => {
                // $("#upasserr").hide();  
                // }, 5000);
                return false;
            }
        }
        // $("#submit-btn").attr("disabled",true);
        $("#loginForm").on("keyup", function(e){
            var x = true;
                $("#uname").on("keyup",function(){
                    if($("#uname").val().trim() != "")
                    {
                        checkuname();
                    }
                });
                $("#upass").on("keyup",function(){
                    if($("#upass").val() != "")
                    {
                        checkpass();
                    }
                });

            if($("#uname").val().trim() != "" && $("#upass").val().trim() != "" && $("input[type=radio]:checked").val())
            {
                $("#submit-btn").css("cursor","pointer");
            }
            else{
                $("#submit-btn").css("cursor","not-allowed");
            }
            // $("#submit-btn").attr("disabled",x);
        });
        $("#loginForm").on("submit", function(e){
            e.preventDefault();
            var x = checkpass();
            var y = checkuname();
            var role = $("#role:checked").val();
            if (x && y ) 
            {
                $.ajax({
                    url:'./fetch/fetchuser.php',
                    type:"POST",
                    data:{uname:$("#uname").val(),upass:$("#upass").val(),role:role},
                    beforeSend:function(){
                        $("#submit-btn").val("verifying...");
                        $("#submit-btn").attr("disabled",true);
                    },
                    success:function(data)
                    {
                        alert(data);
                        if(data == 1)
                        {
                            window.location.href = "./index.php";
                        }
                        else if(data == 0)
                        {
                            alert("Invalid Username or password");
                        }
                    },
                    error:function()
                    {
                        alert("Error Occured!");
                    }
                });
                $("#submit-btn").attr("disabled",false);
                $("#submit-btn").val("Submit");

            }
        })
    });
</script>
</body>
</html>
<?php 
    }
?>