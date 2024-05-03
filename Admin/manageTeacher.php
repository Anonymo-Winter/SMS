<?php 
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
    <title>Manage Teacher</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>

    <link href="./css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet">


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
                    <h3 class="fw-bold">Manage Teachers</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Manage Teachers</span>
                    </nav>
                </div>
                <?php 
                    if((isset($_GET["action"]) && isset($_GET["id"])) && $_GET["action"]=="edit")
                    {
                        $btn = "Update";
                        $formid = "updateTeacher";
                        $id1 = $_GET["id"];
                        try{
                            $sql = "SELECT * from teachers where id='{$id1}'";
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
                                        <label for="tname" class="form-label">Name<span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="tname" id="tname" value="<?php if(isset($result['tname'])) echo $result['tname'];?>" aria-describedby="nameerr" required/>
                                        <small id="nameerr" class="text-danger ms-2 d-none"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="uname" class="form-label">UserName <span class="text-danger">*</span> :</label>
                                        <input type="text" class="form-control" name="uname" id="uname" value="<?php if(isset($result['user_name'])) echo $result['user_name'];?>" aria-describedby="iderr" required>
                                        <small id="iderr" class="text-danger d-none"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="passwd" class="form-label">Password</label>
                                        <input type="text" class="form-control" name="passwd" id="passwd" value="<?php if(isset($result['password'])) echo $result['password'];?>" aria-describedby="iderr" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tphone" class="form-label">Phone <span class="text-danger">*</span> :</label>
                                        <input type="tel" class="form-control" name="tphone" id="tphone" value="<?php if(isset($result['phone_no'])) echo $result['phone_no'];?>" aria-describedby="iderr" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dept" class="form-label">Department</label>
                                        <select class="form-select" name="dept" id="dept" required>
                                            <option value="" selected>--select department--</option>
                                            <?php
                                                $dep_sql = "Select * from department";
                                                $dep_result = mysqli_query($conn,$dep_sql);
                                                while($row = mysqli_fetch_assoc($dep_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['dept_name']?>" <?php if(isset($result) && $result['dept']==$row['dept_name']) echo "selected"?> > <?php echo $row['dept_name']?></option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 cls-msg"></div>
                                    <div class="mb-3 class">
                                        <label for="subjects" class="form-label">Subjects</label>
                                        <select class="form-select" name="subjects" id="subjects" multiple required>
                                            <?php 
                                                $dep_sql = "select * from subjects where dept = '$result[dept]'";
                                                $dep_result = mysqli_query($conn,$dep_sql);
                                                while($row = mysqli_fetch_assoc($dep_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['Course_name']?>" <?php if(isset($result) && (stripos($result['subjects'],$row['Course_name'])!== false)) echo "selected"?> > <?php echo $row['Course_name']?></option>";
                                                <!-- <option value="fine" selected>Option1</option> -->
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
                                <label for="csv_file" class="form-label">Upload CSV File </label>
                                <input type="file" class="form-control" name="csv_file" id="csv_file" aria-describedby="helpId" placeholder="" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<script>
    $(document).ready(function(){

        $('#subjects').select2();
        
        // $(".class").hide();

        $("#dept").on("change",function(){
           var deptname = $("#dept").val();
           $(".class").show();
           $.ajax({
                url:'./fetch/fill_select_subjects.php',
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
                        $(".cls-msg").show().html("<span class='text-center text-danger'>"+deptname+" branch has no active Subjects</span>");
                        $(".class").hide();
                        $("#submit-btn").attr("disabled",true);
                    }
                    else{
                        $(".cls-msg").html("").hide();
                        $("#subjects").html(data);
                        $("#submit-btn").attr("disabled",false);
                    }
                },
                error:function(){
                    alert("Some error occured while fetching Subjects!");
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
            if(confirm("Are you sure you want to delete this Teacher?")) {
                $.ajax({
                    url : './fetch/delete_Teacher.php',
                    type: 'POST',
                    data: { id: TeacherId ,action:"delete"},
                    success: function(response) {
                        if(response == 1){
                            settings("bg-success-subtle","text-success","Teacher deleted successfully!");
                            loadTable();
                        }
                        else{
                            settings("bg-warning-subtle","text-warning","Error Occured while deleting teacher.");
                        }
                    },
                    error: function() {
                        settings("bg-danger-subtle","text-danger","Error occurred while deleting teacher.");
                    }
                });
            }
        });
        
        $("#addTeacher").on("submit",function(e){
            e.preventDefault();
            var selectedOpt = [];
            $("#subjects option:selected").each(function(){
                selectedOpt.push($(this).val());
            });
            $.ajax({
                url : './fetch/addTeacher.php',
                type : "POST",
                data:{
                        tname:$("#tname").val().toUpperCase(),
                        uname:$("#uname").val().toUpperCase(),
                        tphone:$("#tphone").val().toUpperCase(),
                        password:$("#passwd").val().toUpperCase(),
                        dept:$("#dept").val().toUpperCase(),
                        subject:selectedOpt.toString()
                    },
                beforeSend : function(){
                    $("#submit-btn").val("Saving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Teacher added succesffully");
                        $("#addTeacher").trigger("reset");
                        $("#subjects").val([]).trigger('change');
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
            var selectedOpt = [];
            $("#subjects option:selected").each(function(){
                selectedOpt.push($(this).val());
            });
            $("submit-btn").attr("disabled",false);
            $.ajax({
                url : './fetch/addTeacher.php',
                type:"POST",
                beforeSend:function(){
                    $("#submit-btn").val("Updating..");
                    $("#submit-btn").attr("disabled","disabled"); 
                },
                data:{
                        tname:$("#tname").val().toUpperCase(),
                        uname:$("#uname").val().toUpperCase(),
                        tphone:$("#tphone").val().toUpperCase(),
                        password:$("#passwd").val().toUpperCase(),
                        dept:$("#dept").val().toUpperCase(),
                        subject:selectedOpt.toString(),
                        id:$("#id").val(),
                        update:$("#update").val()
                    },
                success:function(data){
                    if(data == 1){
                        settings("bg-success-subtle","text-success","Teacher data updated successfully!");
                        loadTable();
                        window.location.replace("./manageTeacher.php");
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
                    $("#submit-btn").val("Updatex");
                }
            });
           
        });

        function loadTable(){
            $.ajax({
                url : "./fetch/fetchdata.php?action=teachers",
                type:"GET",
                dataType:"json",
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered'><thead class='table-dark'><th class='text-center'>#</th><th class='text-center'>Teacher Name</th><th class='text-center'>Username</th><th class='text-center'>Password</th><th class='text-center'>dept</th><th class='text-center'>subjects</th><th class='text-center'>Edit</th><th class='text-center'>Delete</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.id + "</td>";
                        tableHTML += "<td>" + row.tname + "</td>";
                        tableHTML += "<td>" + row.user_name + "</td>";
                        tableHTML += "<td>" + row.password + "</td>";
                        tableHTML += "<td>" + row.dept + "</td>";
                        tableHTML += "<td>" + row.subjects + "</td>";
                        tableHTML += "<td><a href='./manageTeacher.php?action=edit&id="+row.id+"' class='btn btn-primary btn-sm btn-edit' data-id='" + row.id + "'>Edit</a></td>";
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
<!-- <script src="./script.js"></script> -->
</body>
</html>
<?php 
    }
?>