<?php 
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] == "admin"){
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
    <title>Login Panel</title>
    <?php include './include/linker.php' ?>
    <style>
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
        }
        body{
            background-image: url('anime.jpg');
            background-repeat: no-repeat;
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
<script>
    $(document).ready(function(){
        // $('input[type=radio][name=role]').change(function() {
        //     if (this.value === 'teacher') {
        //     $('#teacherForm').show();
        //     $('#studentForm').hide();
        //     } else if (this.value === 'student') {
        //     $('#studentForm').show();
        //     $('#teacherForm').hide();
        //     }
        // }); 
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