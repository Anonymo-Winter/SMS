<?php 
    session_start();
    if(!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    require_once '../config.php';
    if(!$conn)
    {
        header("location: ./index.html");
    }
    else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../include/linker.php' ?>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "../include/nav.php" ?>
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
                    try {
                        if (isset($_GET["action"], $_GET["id"]) && $_GET["action"] == "edit") {
                            $btn = "Update";
                            $formid = "updateTeacher";
                            $id1 = $_GET["id"];
                            
                            $sql = "SELECT * FROM allocate_teacher WHERE id='$id1'";
                            $result = mysqli_query($conn, $sql);
                            $result = mysqli_fetch_array($result);
                            
                            if ($result) {
                                $sql1 = "SELECT * FROM teachers WHERE id='" . $result['tid'] . "'";
                                $result1 = mysqli_query($conn, $sql1);
                                $result1 = mysqli_fetch_assoc($result1);
                            } else {
                                echo "<script>Swal.fire('We\'re sorry, but we couldn\'t update your information. Please try again.','Something went wrong. Please try again!','warning')</script>";
                            }
                        }
                    } catch (Exception $e) {
                        echo "<script>Swal.fire('We\'re sorry, but we couldn\'t update your information. Please try again.','Something went wrong. Please try again!','error')</script>";
                    }
                ?>
                <div class="row p-4">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="<?php if(!isset($formid)) echo 'addTeacher'; else echo 'updateTeacher';   ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="tname" class="form-label">Teacher<span class='text-danger fw-bolder'>*</span> :</label>
                                        <select class="form-select" name="tname" id="tname" aria-describedby="tec-msg">
                                            <option value="" selected>--select teacher--</option>
                                            <?php
                                                $tec_sql = "select * from teachers";
                                                try{
                                                    $tec_result = mysqli_query($conn,$tec_sql);
                                                    while($row = mysqli_fetch_assoc($tec_result))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row['tname']?>" data-id="<?php echo $row["id"]?>" <?php if(isset($result) && $result['tid']==$row['id']) echo "selected"?> > <?php echo $row['tname']?></option>";
                                                <?php
                                                    }
                                                }
                                                catch(Exception $e)
                                                {
                                                    echo "<script>Swal.fire('Error occured!','database error','error')</script>";
                                                }
                                            ?>
                                        </select>
                                        <small class="mb-3 text-danger" id="tec-msg">please select a teacher</small> 
                                    </div>

                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department<span class='text-danger fw-bolder'>*</span> :</label>
                                        <select class="form-select" name="dept" id="dept" aria-describedby="cls-msg">
                                            <option value="" selected>--select dept--</option>
                                            <?php
                                                $dep_sql = "Select * from department";
                                                try{
                                                    $dep_result = mysqli_query($conn,$dep_sql);
                                                    while($row = mysqli_fetch_assoc($dep_result))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row['depId']?>" <?php if(isset($result1) && $result1['dept']==$row['depId']) echo "selected"?> > <?php echo $row['dept_name']?></option>";
                                                <?php
                                                    }
                                                }catch(Exception $e)
                                                {
                                                    echo "<script>Swal.fire('Error occured!','database error','error')</script>";
                                                }
                                            ?>
                                        </select>
                                        <small class="mb-3 cls-msg text-danger" id="cls-msg"></small> 
                                    </div>

                                    <div class="mb-3 class">
                                        <label for="sclass" class="form-label">Class<span class='text-danger fw-bolder'>*</span> :</label>
                                        <select class="form-select" name="sclass" id="sclass" >
                                            <option value="" selected>--select one--</option>
                                            <?php 
                                                $cls_sql = "select * from classes where dept = '$result1[dept]'";
                                                try{
                                                    $cls_result = mysqli_query($conn,$cls_sql);
                                                    while($row = mysqli_fetch_assoc($cls_result))
                                                    {
                                                ?>
                                                    <option value="<?php echo $row['Sclass']?>" <?php if(isset($result) && $result['Sclass']==$row['Sclass']){ $selected = $row['Sclass']; echo "selected";}?> > <?php echo $row['Sclass']?></option>";
                                                <?php
                                                    }
                                                }catch(Exception $e)
                                                {
                                                    echo "<script>Swal.fire('Error occured!','database error','error')</script>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3" id="crs_in">
                                        <label for="courseid" class="form-label">Course Name<span class='text-danger fw-bolder'>*</span> :</label>
                                        <select class="form-select" name="courseid" id="courseid">
                                            <option value="">Select one</option>
                                            <?php 
                                                    $cor_sql = "select * from subjects where dept = '$result1[dept]'";
                                                    try{
                                                        $cor_result = mysqli_query($conn,$cor_sql);
                                                        while($row = mysqli_fetch_assoc($cor_result))
                                                        {
                                                ?>
                                                        <option value="<?php echo $row['Course_id']?>" <?php if(isset($result) && $result['Course_id']==$row['Course_id']) echo "selected"?> > <?php echo $row['Course_name']?></option>";
                                                <?php
                                                        }
                                                    }catch(Exception $e)
                                                    {
                                                        echo "<script>Swal.fire('Error occured!','database error','error')</script>";
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
                <div class="container-fluid showme mt-4">
                    <div class="row">
                        <div class="col">
                            <div class="shadow border border-secondary rounded py-2">
                                <div id="mytable" class="table-responsive p-3">
                                    
                                </div>
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
            <?php include "../include/footer.php"?>
        </div>
    </div>
</div>
<script>
    function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata2.php",
                type:"POST",
                data:{action:"allocate_teacher"},
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered'><thead class='table-dark'><th class='text-center'>#</th><th class='text-center'>Teacher Name</th><th class='text-center'>Class</th><th class='text-center'>Course</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center sino'></td>"; 
                        tableHTML += "<td>" + row.tname + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "<td>" + row.Course_id + "</td>";
                        tableHTML += "<td><a href='./allocateTeacher.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.tid + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' name='student' data-id='" + row.id + "'>Delete</button></td>";
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    table = $("#dataTable").DataTable({
                        responsive: true, 
                        autoWidth: false,
                        order: [[0, 'asc']],
                        "createdRow": function(row, data, dataIndex){
                            $(row).find('td:eq(0)').text(dataIndex + 1); 
                            $(row).find('td:eq(0)').addClass("sino");
                        },
                    });
                },
                error:function(){
                    Swal.fire(
                        "Unable to Load table",
                        "Something went wrong. Try again later!",
                        "error"
                    );
                }
            });
        }
        if($("#updateTeacher").length == 0)
        {
            $(".class").hide(); 
            $("#crs_in").hide();
        }
        else{

            $(".class").show(); 
            $("#crs_in").show();
        }
        $("#tec-msg").hide();
        $(document).ready(function(){
        $("form").on("change",function(){
            if($("#tname option:selected").val() !== "" && $("#dept option:selected").val()!== "" && $("#sclass option:selected").val()!== "" && $("#courseid option:selected").val() !== "")
            {
                $("#submit-btn").css("cursor","pointer");
                $("#submit-btn").css("opacity","1");
                $("#submit-btn").attr("disabled",false);
            }
            else{
                $("#submit-btn").css("cursor","not-allowed");
                $("#submit-btn").css("opacity","0.7");
            }
        });
        $("#tname").on("change",function(){
            var tid = $("#tname option:selected").data("id");
            var tidv = $("#tname option:selected").val();
            if(tidv == "")
            {
                $("#tec-msg").show();
                $("#crs_in").hide();
            }
            else{
                $("#tec-msg").hide();
                $("#crs_in").show();
            }
            $.ajax({
                url:"./fetch/teacher_subject.php",
                type:"POST",
                data:{tid:tid},
                success:function(data){
                    if(data == 0)
                    {
                        Swal.fire("Error Occured!","Something went wrong!. please try again","warning");
                    }
                    else if(data == "null")
                    {
                        Swal.fire("Error Occured!","Error while trying to fetch teacher details","error");
                    }
                    else{
                        $("#courseid").html(data);
                    }
                },
                error:function(){
                    Swal.fire(
                        "Error occured!",
                        "Unknown error occured!",
                        "warning"
                    )
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
                    }
                    else if(data == "null")
                    {
                        $(".cls-msg").show().html("<span class='text-center text-danger'>"+deptname+" branch has no classes</span>");
                        $(".class").hide();
                    }
                    else{
                        $(".cls-msg").html("").hide();
                        $("#sclass").html(data);
                    }
                },
                error:function(){
                    Swal.fire(
                        "Error occured!",
                        "Something went wrong. while fetching classes!!",
                        "warning"
                    )
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
                            settings("bg-success-subtle","text-success","successfully deleted!");
                            loadTable();
                        }
                        else{
                            Swal.fire("Error Occured!","Oops!,Something went wrong. Failed complete the operation. Please try again later","error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error Occured!","Oops! Something went wrong. Please try again later","error");
                    }
                });
            }
        });
        
        $("#addTeacher").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addAllocateTeacher.php',
                type : "POST",
                data:{
                    tid:$("#tname option:selected").data("id"),
                    sclass:$("#sclass").val().toUpperCase(),
                    courseid:$("#courseid").val().toUpperCase(),
                    dept:$("#dept").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Teacher allocated succesffully");
                        $("#addTeacher").trigger("reset");
                    }
                    else{
                        Swal.fire(
                            "Error occured!",
                            data,
                            "warning"
                        );
                    }
                    loadTable();
                },
                error:function(data){
                    Swal.fire(
                        "Error occured!",
                        "Something went wrong. unable allocate teacher!",
                        "error"
                    );
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
                    sclass:$("#sclass").val().toUpperCase(),
                    dept:$("#dept").val().toUpperCase(),
                    courseid:$("#courseid").val().toUpperCase(),
                    id:$("#id").val(),
                    update:$("#update").val()
                },
                success:function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Data updated successfully!");
                        loadTable();
                        window.location.replace("./allocateTeacher.php");
                    }
                    else{
                        Swal.fire("Error occured!",data,"error");
                    }
                },
                error:function(){
                    Swal.fire("Error occured!","Something went wrong. unable allocate teacher!","error");
                },
                complete:function(){
                    $("#submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                }
            });
        });
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
<?php } ?>