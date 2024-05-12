<?php 
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
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
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Teacher - Dashboard</title>
        
        
    <script src= "https://cdn.jsdelivr.net/npm/sweetalert2@9"> </script> 

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/styles.css">
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    
    <!-- data tables basic,buttons,select -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.1/css/select.bootstrap5.css" />

    <!-- jquery js -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>

    <style>
        .form-select:active,
        .form-select:focus,
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
        }
        .form-select,
        input[type="date"]{
            width:90%;
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
        <main class="container-fluid  p-4 font-monospace">
                <div class="row-md-3 d-flex justify-content-between flex-wrap gap-1">
                        <h3>Dashboard</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php"> Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Take Attendance</span>
                    </nav>
                </div>
                <?php 
                    $teacher_class = "select distinct Sclass from allocate_teacher where tid = '{$_SESSION["id"]}'";
                    $teacher_class_result = mysqli_query($conn,$teacher_class);

                    $teacher_subject = "select distinct Course_id from allocate_teacher where tid = '{$_SESSION["id"]}'";
                    $teacher_subject_result = mysqli_query($conn,$teacher_subject);
                ?>
                <div class="row p-4">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="viewStudent" class="d-flex justify-content-around flex-wrap">
                                    <div class="form-group mb-2" >
                                        <label for="sclass" class="form-label">Class<span class="text-danger fw-bold">*</span> :</label>
                                        <select class="form-select" name="sclass" id="sclass" >
                                            <option value="" selected>--select class--</option>
                                            <?php
                                                while($row = mysqli_fetch_assoc($teacher_class_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['Sclass']?>"> <?php echo $row['Sclass']?> </option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="scourse" class="form-label">Subject<span class="text-danger fw-bold">*</span> :</label>
                                        <select class="form-select" name="scourse" id="scourse" >
                                            <option value="" selected>--select subject--</option>
                                            <?php
                                                while($row = mysqli_fetch_assoc($teacher_subject_result))
                                                {
                                            ?>
                                                <option value="<?php echo $row['Course_id']?>"> <?php echo $row['Course_id']?> </option>";
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="type" class="form-label">Type<span class="text-danger fw-bold">*</span> :</label>
                                        <select class="form-select" name="type" id="type">
                                            <option val="" selected>--select one--</option>
                                            <option value="bydate">By Date</option>
                                            <option value="overall">Over All</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2 dated">
                                        <label for="tdate" class="form-label">Date<span class="text-danger fw-bold">*</span> :</label>
                                        <input type="date" class="form-control" name="tdate" id="tdate" value="<?php echo date("Y-m-d")?>" />
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
<?php 
    $checkattendance = "select * from attendance";
    $checkattendance = mysqli_query($conn,$checkattendance);
?>
                <div class="container-fluid showme">
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
            <?php include "./include/footer.php"?>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script>
    $(".showme").hide();
    $(".dated").hide();
    $(document).ready(function(){  
        $("#type").on("change",function(){
            if($("#type").val() == "bydate")
            {
                $(".dated").show();
                checkexist();
            }
            else if($("#type").val() == "overall"){
                $(".dated").hide();
                checkexist();
            }
            else{
                $(".dated").hide();
            }
        });
        $("#tdate").on("change",function(){
            $(".date").text($("#tdate").val())
            checkexist();
        });
        
        $("#sclass,#scourse,#type").on("change",function(e){
            if($("#scourse").val().trim() != "" && $("#sclass").val().trim() != "" && $("#type option:selected").attr("val") != ""){
                $(".showme").show();
                checkexist();
            }
            else{
                $(".showme").hide();
            }
        });

        function checkexist() {
            $.ajax({
                url: "./fetch/checkAttendanceExistence.php",
                type: "POST",
                data: {
                    date: $("#tdate").val(),
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val()
                },
                success: function (data) {
                    if($("#type").val() == "overall"){
                            loadFull();
                    }
                    else if (data == 1) {
                        if($("#type").val() == "bydate"){
                            loadbyDate();
                        }
                    }
                    else if(data == 0)
                    {
                        $("#showme").show();
                        $("#mytable").html("<div class='text-danger text-center h3'>No attendance has taken on (<span class='text-success'>"+$("#tdate").val()+")</span></div>");
                    }
                },
                error: function () {
                    alert("Error occurred while checking class existence");
                    $(".showme").hide(); 
                }
            });
        }
        function loadExisting(){
            $.ajax({
                url : "./fetch/getAttendanceData.php",
                type:"POST",
                dataType:"json",
                data:{
                    date: $("#tdate").val(),
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val()
                },
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-striped border-info-subtle table-bordered table-hovered rounded'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Name</th><th class='text-center'>Sid</th><th class='text-center'>Class</th><th class='text-center'>status</th></thead><tbody class='text-center'>";
                    data.forEach(function(row1) {
                        var status="<p class='btn btn-danger m-auto'>absent</p>";
                        if(row1.status == 1)
                        {
                            status = "<p class='btn btn-success m-auto' value='1'>present</p>";
                        }
                        tableHTML += "<tr class='align-middle'>";
                        tableHTML += "<td class='text-center'>" + row1.Srollno + "</td>";
                        tableHTML += "<td>" + row1.Sname + "</td>";
                        tableHTML += "<td>" + row1.Sid + "</td>";
                        tableHTML += "<td>" + row1.Sclass + "</td>";
                        tableHTML += "<td id='1'>" + status + "</td>";     
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    initializeDataTable();
                },
                error:function(){
                    alert("error");
                }
            }).done(function(data) {
                    table.rows().every(function() {
                        var rowData = this.data(); 
                        var status = rowData[4];
                        if (status == '<p class="btn btn-success m-auto" value="1">present</p>') {
                            this.select();
                        }
                    });
            }).fail(function() {
                settings("bg-danger-subtle","text-danger","Failed to take attendance");
            });
        }
        function loadFull(){
            $.ajax({
                url : "./fetch/getclassAttendanceData.php",
                type:"POST",
                dataType:"json",
                data:{
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val()
                },
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-striped border-info-subtle table-bordered shadow table-hovered rounded'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Name</th><th class='text-center'>Sid</th><th class='text-center'>Class</th><th class='text-center'>?/57</th></thead><tbody class='text-center'>";
                    data.forEach(function(row1) {
                        var status="<p class='btn btn-danger m-auto'>absent</p>";
                        if(row1.status == 1)
                        {
                            status = "<p class='btn btn-success m-auto' value='1'>present</p>";
                        }
                        tableHTML += "<tr class='align-middle'>";
                        tableHTML += "<td class='text-center'>" + row1.Srollno + "</td>";
                        tableHTML += "<td>" + row1.Sname + "</td>";
                        tableHTML += "<td>" + row1.Sid + "</td>";
                        tableHTML += "<td>" + row1.Sclass + "</td>";
                        tableHTML += "<td class='text-center'>"+row1.attendance_count+"</td>";  
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    initializeDataTable();
                },
                error:function(){
                    alert("errorx");
                }
            })
        }

        function loadbyDate(){
            $.ajax({
                url : "./fetch/getAttendanceData.php",
                type:"POST",
                dataType:"json",
                data:{
                    date: $("#tdate").val(),
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val()
                },
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-striped border-info-subtle table-bordered table-hovered rounded shadow'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Name</th><th class='text-center'>Sid</th><th class='text-center'>Class</th><th class='text-center'>status</th></thead><tbody class='text-center'>";
                    data.forEach(function(row1) {
                        var status="<p class='btn btn-danger m-auto'>absent</p>";
                        if(row1.status == 1)
                        {
                            status = "<p class='btn btn-success m-auto' value='1'>present</p>";
                        }
                        tableHTML += "<tr class='align-middle'>";
                        tableHTML += "<td class='text-center'>" + row1.Srollno + "</td>";
                        tableHTML += "<td>" + row1.Sname + "</td>";
                        tableHTML += "<td>" + row1.Sid + "</td>";
                        tableHTML += "<td>" + row1.Sclass + "</td>";
                        tableHTML += "<td id='1'>" + status + "</td>";     
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    initializeDataTable();
                },
                error:function(){
                    alert("error");
                }
            }).done(function(data) {
                    table.rows().every(function() {
                        var rowData = this.data(); 
                        var status = rowData[4];
                        if (status == '<p class="btn btn-success m-auto" value="1">present</p>') {
                            this.select();
                        }
                    });
            }).fail(function() {
                settings("bg-danger-subtle","text-danger","Failed to take attendance");
            });
        }
        function initializeDataTable() {
            table = $("#dataTable").DataTable({
                        responsive: true, 
                        autoWidth: false,
                        layout: {
                            bottomStart: {
                                buttons: ['print']
                            }
                        },
                        order: [[0, 'asc']],
                        paging:true,
                        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], 
                        language: {
                            lengthMenu: 'Show _MENU_ <button class="btn btn-primary p-2" id="reload">Load <i class="fas fa-rotate"></i></button>', 
                        }
            });
            $("#reload").on("click",function(){
                checkexist();
        })
        }
        
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