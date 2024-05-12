<?php 
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    require_once './include/config.php';
    if(!$conn){
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
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <script src= "https://cdn.jsdelivr.net/npm/sweetalert2@9"> </script>
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
        <div id="layoutSidenav_content" class="bg-light-subtle">
            <main class="container p-4 font-monospace">
                <div class="row-md-5 d-flex justify-content-between">
                    <h3 class="fw-bold">Manage Classes</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Manage Classes</span>
                    </nav>
                </div>
                <?php 
                    if((isset($_GET["action"]) && isset($_GET["id"])) && $_GET["action"]=="edit")
                    {
                        $btn = "Update";
                        $formid = "updateClass";
                        $id1 = $_GET["id"];
                        try{
                            $sql = "Select * from classes where id='".$id1."'";
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
                                <form id="<?php if(!isset($formid)) echo 'addClass'; else echo 'updateClass'; ?>">
                                    <?php if(isset($formid)) echo "<input name='update' value='update' id='update' hidden> <input name='id' id='id' value='$id1' hidden>";?>
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department</label>
                                        <select class="form-select" name="dept" id="dept" aria-describedby="deperr">
                                        <option value="" selected>--select one--</option>
                                        <?php 
                                            $dep = "select dept_name from department";
                                            $res_dep = mysqli_query($conn,$dep);
                                            while($dep_row = $res_dep->fetch_assoc())
                                            {
                                        ?>
                                            <option value="<?php echo $dep_row['dept_name']?>" <?php if(isset($result) && $result['dept']==$dep_row['dept_name']) echo "selected"?> > <?php echo $dep_row['dept_name']?></option>";
                                        <?php
                                            }
                                        ?>
                                        </select>
                                        <small id="deperr" class="text-danger"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sclass" class="form-label">Class Name<span class="text-danger fw-bolder">*</span> :</label>
                                        <input type="text" class="form-control" name="sclass" id="sclass" value="<?php if(isset($result['Sclass'])) echo $result['Sclass'];?>" aria-describedby="nameerr" required/>
                                        <small id="nameerr" class="text-danger ms-2 d-none"></small>
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
                        <form id="uploadForm">
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload CSV File </label>
                                <input type="file" name="file" class="form-control" id="file" aria-describedby="helpId"/>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" id="form-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="container-fluid p-4">
                    <div class="row shadow border border-secondary rounded py-2">
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
            <?php include "./include/footer.php";?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData();
            var fileInput = $('#file')[0].files[0];
            formData.append('file', fileInput);
            $.ajax({
                url: './uploads/upload_class.php',
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
                        loadTable();
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
            if($("#dept").val().trim() == "")
            {
                $("#deperr").show().text("select a dept");
            }
            else{
                $("#deperr").hide();
            }
        })
        function settings(toast_class,msg_class,msg)
        {
            $(".msg").removeClass("text-danger text-success text-primary text-warning").addClass(msg_class).html(msg);
            $("#liveToast").removeClass("bg-danger-subtle bg-success-subtle bg-primary-subtle bg-warning-subtle").addClass(toast_class);
            liveToast.show();
        }
        $(document).on("click", ".btn-delete", function(e){
            var studentId = $(this).data("id");
            if(confirm("Are you sure you want to delete this student?")) {
                $.ajax({
                    url : './fetch/delete_class.php',
                    type: 'POST',
                    data: { id: studentId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                            settings("bg-success-subtle","text-success","Students deleted successfully!");
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
        
        $("#addClass").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/addClass.php',
                type : "POST",
                data:{sclass:$("#sclass").val().toUpperCase(),dept:$("#dept").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("Saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Data Inserted Successfully!");
                        $("#addClass").trigger("reset");
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

        $("#updateClass").on("submit",function(e){
            e.preventDefault();
            $("submit-btn").attr("disabled",false);
            $.ajax({
                url : './fetch/addClass.php',
                type:"POST",
                beforeSend:function(){
                    $("#submit-btn").val("Updating..");
                    $("#submit-btn").attr("disabled","disabled"); 
                },
                data:{sclass:$("#sclass").val().toUpperCase(),dept:$("#dept").val().toUpperCase(),id:$("#id").val(),update:$("#update").val()},
                success:function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Class added successfully!");
                        loadTable();
                        window.location.replace("./manageClass.php");
                    }
                    else{
                        settings("bg-warning-subtle","text-warning","Error updating! Try Again.");
                    }
                    $("submit-btn").attr("disabled",false);
                    $("#submit-btn").val("Update");
                },
                error:function(){
                    settings("bg-danger-subtle","text-danger","Error updating! Try Again.");
                }
            })
        });

        // $("#file-submit").on("submit",function(e){
        //     e.preventDefault();
        //     var fromData = new FormData();
        //     formData.append('file',$('#csv_file')[0].files[0]);
        //     $.ajax({
        //         url: 'upload_student.php',
        //         type:"POST",
        //         data : formData,
        //         success:function(data){
        //             alert(data);
        //         },
        //         error:function()
        //         {
        //             alert("error confirmed");
        //         }
        //     });
        // });

        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=classes",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered'><thead class='table-dark'><th class='text-center'>#</th><th class='text-center'>Class</th><th class='text-center'>Dept</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.id + "</td>";
                        // tableHTML += "<td class='text-center'>" + "<div class='form-check'>\
                        // <input class='form-check-input' type='checkbox' value="+row.id+" id='flexCheckDefault'>\
                        // <label class='form-check-label' for='flexCheckDefault'>"++"row.id
                        // </label></div>" + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "<td>" + row.dept + "</td>";
                        tableHTML += "<td><a href='./manageClass.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.id + "'>Edit</a></td>";
                        tableHTML += "<td><button class='btn btn-danger btn-sm btn-delete' data-id='" + row.id + "'>Delete</button></td>";
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
<!-- <script src="./script.js"></script> -->
</body>
</html>
<?php 
    }
?>