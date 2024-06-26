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
    <?php include "../include/linker.php"?>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php  include "./include/sidebar.php" ?> 
        <div id="layoutSidenav_content" class="bg-light-subtle">
            <main class="container p-4 font-monospace">
                    <div class="row-md-5 d-flex justify-content-between flex-wrap">
                        <h3 class="fw-bold">Manage Class Leaders</h3>
                        <nav class="breadcrumb">
                            <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                            <span class="breadcrumb-item active" aria-current="page">Manage Class Leaders</span>
                        </nav>
                    </div>
                <?php 
                    try{
                        if((isset($_GET["action"]) && isset($_GET["id"])) && $_GET["action"]=="edit")
                        {
                            $btn = "Update";
                            $formid = "updateCr";
                            $id1 = $_GET["id"];
                                $sql = "Select * from class_crs where id='".$id1."'";
                                $sql = mysqli_query($conn,$sql);
                                $result = mysqli_fetch_array($sql);
                        }
                    }catch(Exception $e){
                            echo "<script>Swal.fire('Error occured!','database error','error')</script>";
                        }
                ?>
                <div class="row p-2 mb-3">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="<?php if(!isset($formid)) echo 'addCr'; else echo 'updateCr'; ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="sid" class="form-label">Student ID<span class="text-danger fw-bolder">*</span> :</label>
                                        <input type="text" class="form-control" name="sid" id="sid" value="<?php if(isset($result['Sid'])) echo htmlspecialchars($result['Sid']);?>" aria-describedby="nameerr" required/>
                                        <small id="nameerr" class="text-danger ms-2 d-none"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department</label>
                                        <select class="form-select" name="dept" id="dept" >
                                        <option value="" selected>--select department--</option>
                                        <?php 
                                            $dep = "select * from department";
                                            $res_dep = mysqli_query($conn,$dep);
                                            while($dep_row = $res_dep->fetch_assoc())
                                            {
                                        ?>
                                            <option value="<?php echo htmlspecialchars($dep_row['depId']);?>" <?php if(isset($result) && $result['dept']==$dep_row['depId']) echo "selected";?> > <?php echo htmlspecialchars($dep_row['dept_name']);?></option>";
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 cls-msg"></div>
                                    <div class="mb-3 class">
                                        <label for="sclass" class="form-label">Class Name<span class="text-danger fw-bolder">*</span> :</label>
                                        <select class="form-select" name="sclass" id="sclass" >
                                            <option value="">--select class--</option>
                                            <?php 
                                                if(isset($_GET["action"]) && $_GET["action"]=="edit")
                                                {
                                                    $cls = "select * from classes where dept = '$result[dept]'";
                                                    $res_cls = mysqli_query($conn,$cls);
                                                    while($cls_row = $res_cls->fetch_assoc())
                                                    {
                                            ?>
                                                    <option value="<?php echo htmlspecialchars($cls_row['Sclass']);?>" <?php if(isset($result) && $result['Sclass']==$cls_row['Sclass']) echo "selected"; ?> > <?php echo htmlspecialchars($cls_row['Sclass'])?></option>";
                                            <?php
                                                }}
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
                <div class="row-md-4 p-2">
                    <div class="row p-4 border border-secondary shadow rounded">
                        <form id="uploadForm">
                            <div class="mb-3">
                                <label for="file" class="form-label me-0">Upload CSV File </label>
                                <button type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="id,,department no.,class name">
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
                <div class="container-fluid p-2">
                    <div class="row shadow border border-secondary rounded p-2">
                        <div id="mytable" class="table table-responsive">
                            <!-- table  -->
                        </div>
                    </div>
                </div>
            </main>
<!-- Toast -->
<div class="col-md-5">
    <div class="toast-container position-fixed bottom-0 end-0 m-5">
        <div id="liveToast" class="container-fluid toast  align-items-center" role="alert" aria-live="assertive" aria-atomic="true" >
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
            <?php include '../include/footer.php'?>
        </div>
    </div>
</div>
<script>
   
    $(document).ready(function(){
        if($("#updateCr").length == 0){
            $(".class").hide();
        }
        else{
            $(".class").show();
        }
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData();
            var fileInput = $('#file')[0].files[0];
            formData.append('file', fileInput);
            $.ajax({
                url: './uploads/upload_cr.php',
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
                        loadTable();
                    }
                    else
                    {
                        Swal.fire( 
                            'Error', 
                            response,
                            'error' 
                        );
                    }
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
        $("#dept").on("change",function(){
           var deptname = $("#dept").val();
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
                        $(".class").show();
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
            if(confirm("Are you sure you want to remove this CR?")) {
                $.ajax({
                    url : './fetch/delete_cr.php',
                    type: 'POST',
                    data: { id: studentId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                            settings("bg-success-subtle","text-success","<i class='fas fa-circle-check mx-2'></i>CR deleted successfully!");
                            loadTable();
                        }
                        else{
                            settings("bg-warning-subtle","text-warning","<i class='fas fa-circle-exclamation mx-2'></i>Error Occured while deleting CR.");
                        }
                    },
                    error: function() {
                        settings("bg-danger-subtle","text-danger","<i class='fas fa-circle-exclamation mx-2'></i>Error occurred while deleting student.");
                    }
                });
            }
        });
        
        $("#addCr").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addCr.php',
                type : "POST",
                data:{sid:$("#sid").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),sclass:$("#sclass").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("Saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","<i class='fas fa-circle-check mx-2'></i>CR Data Inserted Successfully!");
                        $("#addCr").trigger("reset");
                        loadTable();
                    }
                    else{
                        Swal.fire(
                            "Error",
                            data,
                            "error"
                        )
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

        $("#updateCr").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addCr.php',
                type : "POST",
                data:{sid:$("#sid").val().toUpperCase(),sclass:$("#sclass").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),id:$("#id").val(),update:$("#update").val()},
                beforeSend : function(){
                    $("#submit-btn").val("Saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","<i class='fas fa-circle-check mx-2'></i>CR Data Inserted Successfully!");
                        $("#addCr").trigger("reset");
                        window.location.replace("./manageLeader.php");
                    }
                    else{
                        Swal.fire("Error occured!",data,"error");
                    }
                },
                error:function(data){
                    Swal.fire("Error occured!","Something went wrong. unable allocate teacher!","error");
                }
            });
            $("#submit-btn").val("Save");
            $("#submit-btn").attr("disabled",false);                    
        });       

        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=class_crs",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered table-hover table-striped'><thead class='table-dark text-center'><th class='text-center'>#</th><th class='text-center'>CR Id</th><th class='text-center'>Class</th><th class='text-center'>Dept</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.id + "</td>";
                        tableHTML += "<td>" + row.Sid + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "<td>" + row.dept_name + "</td>";
                        tableHTML += "<td><a href='./manageLeader.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.id + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' data-id='" + row.id + "'>Delete</button></td>";
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
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>
</body>
</html>
<?php 
    }
?>