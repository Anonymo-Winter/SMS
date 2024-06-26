<?php 
    session_start();
    if(!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    require_once '../config.php';
    if(!$conn){
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
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php  include "./include/sidebar.php" ?> 
        <div id="layoutSidenav_content" class="bg-light-subtle">
            <main class="container p-3 font-monospace">
                <div class="row-md-5 d-flex justify-content-between flex-wrap">
                    <h3 class="fw-bold">Manage Subjects</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Manage Subjects</span>
                    </nav>
                </div>
                <?php 
                    try {
                        if (isset($_GET["action"], $_GET["id"]) && $_GET["action"] == "edit") {
                            $btn = "Update";
                            $formid = "updateSubject";
                            $id1 = $_GET["id"];
                            $sql = "Select * from subjects where id='".$id1."'";
                            $sql = mysqli_query($conn,$sql);
                            if($sql)
                            {
                                $result = mysqli_fetch_array($sql);
                            }
                            else {
                                echo "<script>Swal.fire('We\'re sorry, but we couldn\'t update your information. Please try again.','Something went wrong. Please try again!','warning')</script>";
                            }
                        }
                    }catch (Exception $e) {
                            echo "<script>Swal.fire('We\'re sorry, but we couldn\'t update your information. Please try again.','Something went wrong. Please try again!','error')</script>";
                    }
                ?>
                <div class="row p-3">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="<?php if(!isset($formid)) echo 'addSubject'; else echo 'updateSubject'; ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department<span class="text-danger">*</span> :</label>
                                        <select class="form-select" name="dept" id="dept" >
                                        <option value="" selected>--select one--</option>
                                        <?php 
                                            $dep = "select * from department";
                                            $res_dep = mysqli_query($conn,$dep);
                                            while($dep_row = $res_dep->fetch_assoc())
                                            {
                                        ?>
                                            <option value="<?php echo $dep_row['depId']?>" <?php if(isset($result) && $result['dept']==$dep_row['depId']) echo "selected"?> > <?php echo $dep_row['dept_name']?></option>";
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="courseId" class="form-label">Course Id<span class="fw-bolder text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="courseId" id="courseId" aria-describedby="helpId" placeholder=""  value="<?php if(isset($result)) echo $result['Course_id'];?>"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="courseName" class="form-label">Course Name<span class="fw-bolder text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="courseName" id="courseName" aria-describedby="helpId" placeholder="" value="<?php if(isset($result)) echo $result['Course_name'];?>"/>
                                    </div>
                                    
                                    <div class="text-end">
                                        <input type="submit" value="<?php if(isset($btn)) echo $btn; else echo "Submit" ?>" class="<?php if(isset($btn)) echo "btn btn-warning shadow"; else echo "btn btn-primary shadow" ?>" id="submit-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="row p-2 showme">
                    
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
            <?php include "../include/footer.php"?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        function settings(toast_class,msg_class,msg)
        {
            $(".msg").removeClass("text-danger text-success text-primary text-warning").addClass(msg_class).html(msg);
            $("#liveToast").removeClass("bg-danger-subtle bg-success-subtle bg-primary-subtle bg-warning-subtle").addClass(toast_class);
            liveToast.show();
        }
        $(document).on("click", ".btn-delete", function(e){
            var CourseId = $(this).data("id");
            if(confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    url : './fetch/delete_subject.php',
                    type: 'POST',
                    data: { id: CourseId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                            settings("bg-success-subtle","text-success","successfully deleted!");
                        }
                        else{
                            Swal.fire("Error Occured!","Oops!,Something went wrong. Failed complete the operation. Please try again later","error");
                        }
                        loadTable();
                    },
                    error: function() {
                        Swal.fire("Error Occured!","Oops! Something went wrong. Please try again later","error");
                    }
                });
            }
        });
        
        $("#addSubject").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addSubject.php',
                type : "POST",
                data:{courseId:$("#courseId").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),courseName:$("#courseName").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Data inserted successfully!");
                        $("#addSubject").trigger("reset");
                        loadTable();
                    }
                    else{
                        Swal.fire(
                            "Error occured!",
                            data,
                            "warning"
                        );                    
                    }
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

        $("#updateSubject").on("submit",function(e){
            e.preventDefault();
            $("submit-btn").attr("disabled",false);
            $.ajax({
                url : './fetch/addSubject.php',
                type:"POST",
                beforeSend:function(){
                    $("#submit-btn").val("Updating..");
                    $("#submit-btn").attr("disabled","disabled"); 
                },
                data:{courseId:$("#courseId").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),courseName:$("#courseName").val().toUpperCase(),id:$("#id").val(),update:$("#update").val()},
                success:function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Course updated successfully!");
                        loadTable();
                        window.location.replace("./manageSubject.php");
                    }
                    else{
                        Swal.fire("Error occured!",data,"error");
                    }
                    $("submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                },
                error:function(){
                    Swal.fire("Error occured!","Something went wrong. unable allocate teacher!","error");
                },
                complete:function(){
                    $("#submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                }
            })
        });
        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=subjects",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered table-hover table-striped'><thead class='table-dark'><th class='text-center'>#</th><th class='text-center'>Course Id</th><th class='text-center'>Course Name</th><th class='text-center'>Dept</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.id + "</td>";
                        tableHTML += "<td>" + row.Course_id + "</td>";
                        tableHTML += "<td>" + row.Course_name + "</td>";
                        tableHTML += "<td>" + row.dept_name + "</td>";
                        tableHTML += "<td><a href='./manageSubject.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.id + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' data-id='" + row.id + "'>Delete</button></td>";
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    table = $("#dataTable").DataTable({
                        responsive: true, 
                        autoWidth: false,
                        "createdRow": function(row, data, dataIndex){
                            $(row).find('td:eq(0)').text(dataIndex + 1); 
                            $(row).find('td:eq(0)').addClass("sino");
                        },
                        order: [[1, 'asc']]
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
        loadTable();
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        $(".msg").addClass("text-success fs-5").html("Student deleted successfully.");
        $("#liveToast").addClass("border border-success bg-success-subtle");
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
<?php 
    }
?>