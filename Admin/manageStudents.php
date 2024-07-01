<?php 
    session_start();
    if(!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    include '../config.php';
    if(!$conn){
        header("location: ./index.html");
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './include/linker.php' ?>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php  include "./include/sidebar.php" ?>
        <div id="layoutSidenav_content" id="content">
            <main class="container p-4 font-monospace">
                <div class="row-md-5 d-flex justify-content-between flex-wrap">
                    <h3 class="fw-bold">Manage Students</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Manage Students</span>
                    </nav>
                </div>
                <?php 
                    if((isset($_GET["action"]) && isset($_GET["id"])) && $_GET["action"]=="edit")
                    {
                        $btn = "Update";
                        $formid = "updateStudent";
                        $id1 = htmlspecialchars($_GET["id"]);
                        try{
                            $sql = "Select * from students where Sid='$id1'";
                            $sql = mysqli_query($conn,$sql);
                            $result = mysqli_fetch_array($sql);
                        }catch(Exception $e){
                            echo "<script>alert('unknown Error !')</script>";
                        }
                    }
                ?>
                <div class="row p-2 pb-3">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="<?php if(!isset($formid)) echo 'addStudent'; else echo 'updateStudent';   ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="sname" class="form-label">Name<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="sname" id="sname" value="<?php if(isset($result['Sname'])) echo htmlspecialchars($result['Sname']);?>" aria-describedby="nameerr" required/>
                                        <small id="nameerr" class="text-danger ms-2 d-none"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sid" class="form-label">Id<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="sid" id="sid" value="<?php if(isset($result['Sid'])) echo htmlspecialchars($result['Sid']);?>" aria-describedby="iderr" required>
                                        <small id="iderr" class="text-danger d-none"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="srollno" class="form-label">Roll No<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="srollno" id="srollno" value="<?php if(isset($result['Srollno'])) echo htmlspecialchars($result['Srollno']);?>" aria-describedby="iderr" required>
                                        <small id="iderr" class="text-danger d-none"></small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department</label>
                                        <select class="form-select" name="dept" id="dept" >
                                            <option value="" selected>--select department--</option>
                                            <?php
                                                $dep_sql1 = "SELECT * FROM `classes` where Sclass='{$result['Sclass']}'";
                                                $dep_sql1 = mysqli_query($conn,$dep_sql1);
                                                $dep_sql1 = mysqli_fetch_assoc($dep_sql1);
                                                $dep_sql = "Select * from department";
                                                $dep_result = mysqli_query($conn,$dep_sql);
                                                while($row = mysqli_fetch_assoc($dep_result))
                                                {
                                            ?>
                                                <option value="<?php echo htmlspecialchars($row['depId'])?>" <?php if(isset($result) && $dep_sql1['dept']==$row['depId']) echo "selected"?> > <?php echo htmlspecialchars($row['dept_name'])?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <small class="mb-3 cls-msg"></small>
                                    <div class="mb-3 class">
                                        <label for="sclass" class="form-label">Class</label>
                                        <select class="form-select" name="sclass" id="sclass" >
                                            <option value="" selected>--select department</option>
                                            <?php 
                                                $dep_sql = "select * from classes where dept = '$result[dept]'";
                                                $dep_result = mysqli_query($conn,$dep_sql);
                                                while($row = mysqli_fetch_assoc($dep_result))
                                                {
                                            ?>
                                                <option value="<?php echo htmlspecialchars($row['Sclass'])?>" <?php if(isset($result) && $result['Sclass']==$row['Sclass']) echo "selected"?> > <?php echo htmlspecialchars($row['Sclass'])?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <input type="submit" value="<?php if(isset($btn)) echo $btn; else echo "Submit" ?>" class="<?php if(isset($btn)) echo "btn btn-warning shadow"; else echo "btn btn-primary shadow" ?>" id="submit-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="row-md-4 px-2">
                    <div class="row p-4 border border-secondary shadow rounded">
                        <form id="uploadForm">
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload CSV File </label>
                                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="rollno,id,name,department no.,class name">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </button>
                                <input type="file" name="file" class="form-control" id="file" aria-describedby="helpId"/>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" id="form-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row-md-4 showme  mt-3">
                    
                        <div class="col">
                            <div class="shadow border border-secondary rounded py-2">
                                <div id="mytable" class="table-responsive p-3">
                                    
                                </div>
                            </div>

                    </div>
                </div>
            </main>

<!-- Toast -->
<div class="col-md-5">
    <div class="toast-container position-fixed bottom-0 end-0 m-5">
        <div id="liveToast" class="toast  align-items-center" role="alert" aria-live="assertive" aria-atomic="true" >
            <div class="d-flex">
                <div class="toast-body msg fw-bold text-nowrap">
                </div>
                <button type="button" class="btn me-2 m-auto" data-bs-dismiss="toast" aria-label="Close" >
                <i class="icon text-secondary fa-solid fa-xmark fs-2"></i>
            </button>
            </div>
        </div>
    </div>
</div>
            <?php include "../include/footer.php"; ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData();
            var fileInput = $('#file')[0].files[0];
            formData.append('file', fileInput);
            $.ajax({
                url: './uploads/upload_student.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $("#form-submit").val("Saving..");
                    $("#form-submit").attr("disabled","disabled");
                },
                success: function(response) {
                    if(response == "success")
                    {
                        Swal.fire( 
                            'Success', 
                            'Data Submitted', 
                            'success'
                        ); 
                        $("#uploadForm").trigger("reset");
                    }
                    else if(response == "error")
                    {
                        Swal.fire( 
                            'Error', 
                            'Error occured', 
                            'warning' 
                        );
                    }
                    else if(response == -1)
                    {
                        Swal.fire( 
                            'Error', 
                            'Invalid File', 
                            'error' 
                        );
                    }
                    else
                    {
                        Swal.fire( 
                            'Error', 
                            response,
                            'error' 
                        );
                    }
                    loadTable();
                },
                error: function() {
                    alert('Error uploading file');
                },
                complete:function(){
                        $("#form-submit").val("Submit");
                        $("#form-submit").attr("disabled",false);
                    }
            });
        });
        if($("#updateStudent").length == 0)
        {
            $(".class").hide();
        }
        else{
            $(".class").show();
        }
        $("#dept").on("change",function(){
           var deptname = $("#dept").val();
           $(".class").show();
           $.ajax({
                url:'./fetch/fill_select.php',
                type:"POST",
                data:{dept:deptname},
                success:function(data){
                    if(data == 0)
                    {
                        $(".cls-msg").show().html("<span class='text-center text-danger'>select a branch</span>");
                        $(".class").hide();
                        $("#submit-btn").attr("disabled",true);
                    }
                    else if(data == "null")
                    {
                        $(".cls-msg").show().html("<span class='text-center text-danger'>"+deptname+" branch has no classes</span>");
                        $(".class").hide();
                        $("#submit-btn").attr("disabled",true);
                    }
                    else{
                        $(".cls-msg").html("").hide();
                        $("#sclass").html(data);
                        $("#submit-btn").attr("disabled",false);
                    }
                },
                error:function(){
                    alert("Some error occured while fetching classes!");
                }
           }) 
        });
        function settings(toast_class,msg_class,msg){
            $(".msg").removeClass("text-danger text-success text-primary text-warning").addClass(msg_class).html(msg);
            $("#liveToast").removeClass("bg-danger-subtle bg-success-subtle bg-primary-subtle bg-warning-subtle").addClass(toast_class);
            liveToast.show();
        }
        $(document).on("click", ".btn-delete", function(e){
            var studentId = $(this).data("id");
            if(confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    url : './fetch/delete_student.php',
                    type: 'POST',
                    data: { id: studentId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                        //     // Swal.fire( 
                        //     // 'Success', 
                        //     // 'student added successdully', 
                        //     // 'success' 
                        //     // );
                            settings("bg-success-subtle","text-success","Students deleted successfully!");
                            loadTable();
                        }
                        else{
                            settings("bg-warning-subtle","text-warning","Error Occured while deleting student");
                        }
                    },
                    error: function() {
                        settings("bg-danger-subtle","text-danger","Error occurred!");
                    }
                });
            }
        });
        $("#addStudent").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addStudent.php',
                type : "POST",
                data:{sname:$("#sname").val().toUpperCase(),sid:$("#sid").val().toUpperCase(),sclass:$("#sclass").val().toUpperCase(),srollno:$("#srollno").val().toUpperCase(),dept:$("#dept").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Student created succesffully");
                        $("#addStudent").trigger("reset");
                        loadTable();
                    }
                    else{
                        Swal.fire("Error occured!",data,"warning");
                    }
                },
                error:function(data){
                    Swal.fire(
                        "Error occured!",
                        "Something went wrong.Please try again later!",
                        "error"
                    );                }
            });
            $("#submit-btn").val("Submit");
            $("#submit-btn").attr("disabled",false);                    
        });

        $("#updateStudent").on("submit",function(e){
            e.preventDefault();
            $("submit-btn").attr("disabled",false);
            $.ajax({
                url : './fetch/addStudent.php',
                type:"POST",
                beforeSend:function(){
                    $("#submit-btn").val("Updating..");
                    $("#submit-btn").attr("disabled","disabled"); 
                },
                data:{sname:$("#sname").val().toUpperCase(),sid:$("#sid").val().toUpperCase(),sclass:$("#sclass").val().toUpperCase(),srollno:$("#srollno").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),id:$("#id").val(),update:$("#update").val()},
                success:function(data){
                    if(data == 1){
                        Swal.fire( 
                            'Success', 
                            'student updated successfully', 
                            'success' 
                        );
                        setTimeout(() => {
                        window.location.replace("./manageStudents.php");
                        }, 3500);
                    }
                    else{
                        Swal.fire(
                            "Invalid data!",
                            "please ensure the data is correct",
                            "error"
                        );
                    }
                },
                error:function(){
                    Swal.fire(
                            "Error occured!",
                            "error Updating student",
                            "error"
                        );        
                },
                complete:function(){
                    $("#submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                }
            });
        });
        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=students",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered table-hover table-striped'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Id</th><th class='text-center'>Name</th><th class='text-center'>class</th><th class='text-center'>dept</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.Srollno + "</td>";
                        tableHTML += "<td>" + row.Sid + "</td>";
                        tableHTML += "<td>" + row.Sname + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "<td>" + row.dept_name + "</td>";
                        tableHTML += "<td><a href='./manageStudents.php?action=edit&id="+row.Sid+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.Sid + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' name='student' data-id='" + row.Sid + "'>Delete</button></td>";
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    table = $("#dataTable").DataTable({
                        responsive: true,
                        autoWidth: false,
                        order: [[3,'asc'],[0,'asc']],
                    });
                },
                error:function(){
                    Swal.fire( 
                            'Error', 
                            'Error loading table',
                            'error' 
                        );
                }
            });
        }
        loadTable();
    });
</script>
<script>
    var sidebarToggle = document.getElementById('sidebarToggle');
    sidebarToggle.addEventListener('click', function (event) {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
    });
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
</body>
</html>
<?php 
    }
?>
