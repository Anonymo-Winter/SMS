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
        .radio-tile-group {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.radio-tile-group .input-container {
  position: relative;
  height: 120px;
  width: 120px;
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
  transform: scale(1.1, 1.1);
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
<body class="d-flex align-items-center justify-content-center vh-100 p-5 border border-primary">
    <div class="container-fluid  d-flex justify-content-center">
            <form class="col-md-5 border border-info rounded p-3" id="loginForm">
                <div class="row pt-0"> 
                    <h3 class="text-center py-3 bg-secondary">Login</h3>
                </div>
                <div class="container">
  <div class="radio-tile-group btn-group-toggle" data-toggle="buttons">
    <div class="input-container bg-light">
      <input class="radio-button" type="radio" name="role" id="role" value="teacher" autocomplete="off">
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
      <input class="radio-button" type="radio" name="role" id="role" value="student" autocomplete="off">
      <label class="radio-tile btn btn-light" for="walk">
        <div class="icon walk-icon">
        <img style="" class="app-preview__image-origin" srcset="https://img.icons8.com/?size=256&amp;id=23319&amp;format=png 1x, https://img.icons8.com/?size=512&amp;id=23319&amp;format=png 2x" width="100" height="100" alt="Student Male icon" data-v-ac8ca204="">
          <!-- <svg fill="#000000" height="24" viewBox="0 0 24 24" width="28" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 0h24v24H0z" fill="none"></path>
            <path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1L6 8.3V13h2V9.6l1.8-.7"></path>
          </svg> -->
        </div>
        <span class="radio-tile-label">Student</span>
      </label>
    </div>
  </div>
</div>


                <div class="form-group d-flex justify-content-evenly">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="role" value="teacher" checked>
                        <label class="form-check-label" for="teacherRadio">
                            <img src="../../Login System/assets/imgs/valorant.jpg" height=50 width=50>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" id="role" value="student">
                        <label class="form-check-label" for="studentRadio">Student</label>
                    </div>
                </div>

                <div id="teacherForm">
                    <div class="form-group">
                        <div class="mb-3 username">
                            <label for="uname" class="form-label">User Name <span class="text-danger">*</span> :</label>
                            <input type="text" name="uname" id="uname" class="form-control" placeholder="" aria-describedby="unameerr"/>
                            <small id="unameerr" class="text-danger">*This field is required</small>
                        </div>
                        <div class="mb-3 password">
                            <label for="upass" class="form-label">Password <span class="text-danger">*</span> :</label>
                            <input type="password" name="upass" id="upass" class="form-control" placeholder="" aria-describedby="upasserr"/>
                            <small id="upasserr" class="text-danger">*This field is required</small>
                        </div>
                    </div>
                </div>
                <div id="studentForm" style="display: none;">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="mb-3 username">
                                <label for="uname" class="form-label">User Name <span class="text-danger">*</span> :</label>
                                <input type="text" name="uname" id="uname" class="form-control" placeholder="" aria-describedby="unameerr"/>
                                <small id="unameerr" class="text-danger">*This field is required</small>
                            </div>
                        </div>
                    </div>
                </div>



                
                <button type="submit" class="btn btn-primary" value="Submit" id="submit-btn">
                    Submit
                </button>
                
            </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('input[type=radio][name=role]').change(function() {
            if (this.value === 'teacher') {
            $('#teacherForm').show();
            $('#studentForm').hide();
            } else if (this.value === 'student') {
            $('#studentForm').show();
            $('#teacherForm').hide();
            }
        });   

        $("form small").hide();
        $("#uname").focus();
        $("#uname").on("keyup",function(){
            checkuname();
        });
        $("#upass").on("keyup",function(){
            checkpass();
        });
        function checkuname(){   
            if($("#uname").val().trim() != "")
            {
                $("#unameerr").hide();
                return true;
            }
            else{
                $("#unameerr").show();  
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
                return false;
            }
        }
        $("#submit-btn").attr("disabled",true);
        $("#loginForm").on("keyup", function(e){
            var x = true;
            if($("#uname").val().trim() != "" && $("#upass").val().trim() != "")
            {
                x = false;
            }
            else{
                x=true;
            }
            $("#submit-btn").attr("disabled",x);

        });
        $("#loginForm").on("submit", function(e){
            e.preventDefault();
            var x = checkpass();
            var y = checkuname();
            var role = $("#role").val();
            if (x == true && y == true) 
            {
                $.ajax({
                    url:'./fetch/fetchuser.php',
                    type:"POST",
                    data:{uname:$("#uname").val(),upass:$("#upass").val(),role:$("#role").val()},
                    beforeSend:function(){
                        $("#submit-btn").val("verifying...");
                    },
                    success:function(data)
                    {
                        alert(data);
                        // if(data == "true")
                        // {
                        // }
                    }
                });
            }
        })
    });
</script>
</body>
</html>
<?php 
    }
?>