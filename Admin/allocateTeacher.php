<?php 
    require_once './include/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>

    <link href="./css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <style>
        .form-select:active,
        .form-select:focus,
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
        }
        thead th{
            text-align: center;
        }
        .btn-close-danger{
            color:red;
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php  include "./include/sidebar.php" ?>
        <div id="layoutSidenav_content">
            <main class="container p-4 font-monospace">
                <div class="row-md-5 d-flex justify-content-between">
                    <h3 class="fw-bold">Allocate Teachers</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Allocate Teacher</span>
                    </nav>
                </div>
                <?php 
                    if((isset($_GET["action"]) && isset($_GET["id"])) && $_GET["action"]=="edit")
                    {
                        $btn = "Update";
                        $formid = "updateTeacher";
                        $id1 = $_GET["id"];
                        try{
                            $sql1 = "SELECT * FROM teachers where id='$id1'";
                            $sql1 = mysqli_query($conn,$sql1);
                            $result1 = mysqli_fetch_assoc($sql1);
                            $sql = "SELECT * FROM allocate_teacher WHERE id='$id1'";
                            $sql = mysqli_query($conn,$sql);
                            $result = mysqli_fetch_array($sql);
                        }catch(Exception $e){
                            echo "<script>alert('unknown Error !')</script>";
                        }
                    }
                ?>
                <div class="row p-4">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="<?php if(!isset($formid)) echo 'addTeacher'; else echo 'updateTeacher';   ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="tname" class="form-label">Teacher</label>
                                        <select class="form-select" name="tname" id="tname" aria-describedby="tec-msg" required>
                                            <option value="" selected>Select Teacher</option>
                                            <?php
                                                $tec_sql = "Select * from teachers";
                                                $tec_result = mysqli_query($conn,$tec_sql);
                                                while($row = mysqli_fetch_assoc($tec_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['tname']?>" data-id="<?php echo $row["id"]?>" <?php if(isset($result) && $result['id']==$row['id']) echo "selected"?> > <?php echo $row['tname']?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <small class="mb-3 tec-msg text-danger" id="tec-msg"></small> 

                                    </div>
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department</label>
                                        <select class="form-select" name="dept" id="dept" aria-describedby="cls-msg">
                                            <option value="" selected>Select one</option>
                                            <?php
                                                $dep_sql = "Select * from department";
                                                $dep_result = mysqli_query($conn,$dep_sql);
                                                while($row = mysqli_fetch_assoc($dep_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['dept_name']?>" <?php if(isset($result1) && $result1['dept']==$row['dept_name']) echo "selected"?> > <?php echo $row['dept_name']?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <small class="mb-3 cls-msg text-danger" id="cls-msg"></small> 
                                    </div>
                                    <div class="mb-3 class">
                                        <label for="sclass" class="form-label">Class</label>
                                        <select class="form-select" name="sclass" id="sclass" >
                                            <option value="" selected>--select one--</option>
                                            <?php 
                                                $cls_sql = "select * from classes where dept = '$result1[dept]'";
                                                $cls_result = mysqli_query($conn,$cls_sql);
                                                while($row = mysqli_fetch_assoc($cls_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['Sclass']?>" <?php if(isset($result) && $result['Sclass']==$row['Sclass']){ $selected = $row['Sclass']; echo "selected";}?> > <?php echo $row['Sclass']?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="crid" class="form-label">CR Id<span class='text-danger fw-bolder'>*</span></label>
                                        <select class="form-select" name="crid" id="crid" >
                                            <option value="" selected>Select one</option>
                                            <?php 
                                                    $cr_sql = "select * from class_crs where Sclass = '$result[Sclass]'";
                                                    $cr_result = mysqli_query($conn,$cr_sql);
                                                    while($row = mysqli_fetch_assoc($cr_result))
                                                    {
                                            ?>
                                                    <option value="<?php echo $row['Sid']?>" <?php if(isset($result) && $result['Sclass']==$row['Sclass']) echo "selected"?> > <?php echo $row['Sid']?></option>";
                                            <?php
                                                    }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="courseid" class="form-label">Course Name<span class='text-danger fw-bolder'>*</span></label>
                                        <select class="form-select" name="courseid" id="courseid" >
                                            <option value="" selected>Select one</option>
                                            <?php 
                                                    $cor_sql = "select * from subjects where dept = '$result1[dept]'";
                                                    $cor_result = mysqli_query($conn,$cor_sql);
                                                    while($row = mysqli_fetch_assoc($cor_result))
                                                    {
                                            ?>
                                                    <option value="<?php echo $row['Course_name']?>" <?php if(isset($result) && $result['Course_id']==$row['Course_name']) echo "selected"?> > <?php echo $row['Course_name']?></option>";
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
                <div class="row-md-4 px-4">
                    <div class="row p-4 border border-secondary shadow rounded">
                        <form id='file-submit'>
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload CSV File </label>
                                <input type="file" class="form-control" name="file" id="file" aria-describedby="helpId" placeholder="" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container-fluid p-4">
                    <div class="container-fluid shadow border border-secondary rounded py-2">
                        <div id="mytable" class="table table-responsive">
                            <!-- table  -->
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
            <?php include "./include/footer.php"?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        // $(".class").hide();
        $("#tname").on("change",function(){
            var tid = $("#tname option:selected").data("id");
            $.ajax({
                url:"./fetch/teacher_subject.php",
                type:"POST",
                data:{tid:tid},
                success:function(data){
                    if(data == 0)
                    {
                        $(".tec-msg").show().html("<span class='text-center text-danger'>select a teacher</span>");
                        $("#submit-btn").attr("disabled",true);
                    }
                    else if(data == "null")
                    {
                        $(".tec-msg").show().html("<span class='text-center text-danger'>"+deptname+" branch has no classes</span>");
                        $("#submit-btn").attr("disabled",true);
                    }
                    else{
                        $(".tec-msg").html("").hide();
                        $("#courseid").html(data);
                        $("#submit-btn").attr("disabled",false);
                    }
                },
                error:function(){
                    alert("Some error occured while fetching classes!");
                }
            });
        });
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
        $("#sclass").on("change",function(){
           var sclass = $("#sclass").val();
           $.ajax({
                url:'./fetch/fill_select_cr.php',
                type:"POST",
                data:{sclass:sclass},
                success:function(data){
                    $("#crid").html(data);
                },
                error:function(){
                    alert("Some error occured while fetching classes!");
                }
           }) 
        });
        function settings(toast_class,msg_class,msg)
        {
            $(".msg").removeClass("text-danger text-success text-primary text-warning").addClass(msg_class).html(msg);
            $("#liveToast").removeClass("bg-danger-subtle bg-success-subtle bg-primary-subtle bg-warning-subtle").addClass(toast_class);
            liveToast.show();
        }
        $(document).on("click", ".btn-delete", function(e){
            var TeacherId = $(this).data("id");
            if(confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    url : './fetch/delete_allocate_Teacher.php',
                    type: 'POST',
                    data: { id: TeacherId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                            settings("bg-success-subtle","text-success","Teacher deleted successfully!");
                            loadTable();
                        }
                        else{
                            settings("bg-warning-subtle","text-warning","Error Occured while deleting student.");
                        }
                    },
                    error: function() {
                        settings("bg-danger-subtle","text-danger","Error occurred while deleting student.");
                    }
                });
            }
        });
        
        $("#addTeacher").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addAllocateTeacher.php',
                type : "POST",
                data:{tid:$("#tname option:selected").data("id"),tname:$("#tname").val().toUpperCase(),sclass:$("#sclass").val().toUpperCase(),courseid:$("#courseid").val().toUpperCase(),crid:$("#crid").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("Saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    alert(data);
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Teacher allocated succesffully");
                        $("#addTeacher").trigger("reset");
                        loadTable();
                    }
                    else{
                        settings("bg-warning-subtle","text-warning","Invalid Data! Try Again.");
                    }
                },
                error:function(data){
                    settings("bg-danger-subtle","text-danger","Error Occured While Inserting Data ! Data! Try Again.");
                }
            });
            $("#submit-btn").val("Save");
            $("#submit-btn").attr("disabled",false);                    
        });

        $("#updateTeacher").on("submit",function(e){
            e.preventDefault();
            $("submit-btn").attr("disabled",false);
            $.ajax({
                url : './fetch/addAllocateTeacher.php',
                type:"POST",
                beforeSend:function(){
                    $("#submit-btn").val("Updating..");
                    $("#submit-btn").attr("disabled","disabled"); 
                },
                data:{
                    tid:$("#tname option:selected").data("id"),
                    tname:$("#tname").val().toUpperCase(),
                    sclass:$("#sclass").val().toUpperCase(),
                    courseid:$("#courseid").val().toUpperCase(),
                    crid:$("#crid").val().toUpperCase(),
                    id:$("#id").val(),
                    update:$("#update").val()
                },
                success:function(data){
                    alert(data);
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Data updated successfully!");
                        loadTable();
                        window.location.replace("./allocateTeacher.php");
                    }
                    else{
                        settings("bg-warning-subtle","text-warning","Error updating! Try Again.");
                    }
                },
                error:function(){
                    settings("bg-danger-subtle","text-danger","Error updating! Try Again.");
                },
                complete:function(){
                    $("#submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                }
            });
        });
        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=allocate_teacher",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered'><thead class='table-dark'><th class='text-center'>#</th><th class='text-center'>Teacher Name</th><th class='text-center'>Class</th><th class='text-center'>Course</th><th>CR Id</th><th>Date</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.id + "</td>";
                        tableHTML += "<td>" + row.tname + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "<td>" + row.Course_id + "</td>";
                        tableHTML += "<td>" + row.Cr_id + "</td>";
                        tableHTML += "<td>" + row.date + "</td>";
                        tableHTML += "<td><a href='./allocateTeacher.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.id + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' name='student' data-id='" + row.id + "'>Delete</button></td>";
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    $("#dataTable").DataTable({
                        responsive:true,
                        autoWidth:true,
                        pagingType: 'simple_numbers',
                    });
                },
                error:function(){
                    alert("error");
                }
            });
        }
        loadTable();
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
    });
</script>
<script>
    var sidebarToggle = document.getElementById('sidebarToggle');
    sidebarToggle.addEventListener('click', function (event) {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
    });
</script>
</body>
</html>
