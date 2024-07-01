<?php 
    session_start();
    if(!isset($_SESSION["teacher_loggedin"]) || $_SESSION["teacher_loggedin"] !== true){
    
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
    <?php include "./include/linker.php";?>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php  include "./include/sidebar.php" ?>
        <div id="layoutSidenav_content" id="content">
        <main class="container-fluid p-4 font-monospace">
                <div class="row-md-3 d-flex justify-content-between flex-wrap gap-1">
                        <h3 class="bold">Dashboard</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php"> Main</a>
                        <span class="breadcrumb-item active" aria-current="page">View Student Attendance</span>
                    </nav>
                </div>
                <?php 
                    $stmt = $conn->prepare("SELECT DISTINCT Sclass FROM allocate_teacher WHERE tid = ?");
                    $stmt->bind_param("s", $_SESSION["teacher_id"]);
                    $stmt->execute();
                    $teacher_class_result = $stmt->get_result();
                    $stmt->close();

                    $stmt = $conn->prepare("SELECT DISTINCT s.Course_id, s.* FROM allocate_teacher a JOIN subjects s ON s.Course_id = a.Course_id WHERE a.tid = ?");
                    $stmt->bind_param("s", $_SESSION["teacher_id"]);
                    $stmt->execute();
                    $teacher_subject_result = $stmt->get_result();
                    $stmt->close();
                ?>

                <div class="row p-2">
                    <div class="card shadow border border-secondary">
                        <div class="card-body">
                            <form id="viewStudent" class="needs-validation" novalidate>
                                <div class="row row-cols-1 row-cols-md-2 g-3">
                                    <div class="col">
                                        <label for="sclass" class="form-label">Class<span class="text-danger fw-bold">*</span>:</label>
                                        <select class="form-select" name="sclass" id="sclass" required>
                                            <option value="" selected>--select class--</option>
                                            <?php while($row = mysqli_fetch_assoc($teacher_class_result)) { ?>
                                                <option value="<?php echo $row['Sclass']?>"><?php echo $row['Sclass']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="Sid" class="form-label">Student Id<span class="text-danger fw-bold">*</span>:</label>
                                        <input class="form-control" name="Sid" id="Sid" placeholder="eg: s2XXXXXX" required>
                                    </div>
                                    <div class="col">
                                        <label for="scourse" class="form-label">Subject<span class="text-danger fw-bold">*</span>:</label>
                                        <select class="form-select" name="scourse" id="scourse" required>
                                            <option value="" selected>--select subject--</option>
                                            <?php while($row = mysqli_fetch_assoc($teacher_subject_result)) { ?>
                                                <option value="<?php echo $row['Course_id']?>"><?php echo $row['Course_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="type" class="form-label">Type<span class="text-danger fw-bold">*</span>:</label>
                                        <select class="form-select" name="type" id="type" required>
                                            <option value="" selected>--select one--</option>
                                            <option value="bydate">By Date</option>
                                            <option value="overall">Over All</option>
                                        </select>
                                    </div>
                                    <div class="col dated">
                                        <label for="tdate" class="form-label">Date<span class="text-danger fw-bold">*</span>:</label>
                                        <input type="date" class="form-control" name="tdate" id="tdate" value="<?php echo date("Y-m-d")?>" required>
                                    </div>
                                </div>
                                <div class="col d-flex pt-3">
                                    <input type="submit" name="form-btn" id="form-btn" class="btn btn-primary mx-auto" >
                                </div>
                            </form>
                        </div>
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
            <?php include "../include/footer.php"?>
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
            }
            else if($("#type").val() == "overall"){
                $(".dated").hide();
            }
            else{
                $(".dated").hide();
            }
        });
        $("#tdate").on("change",function(){
            $(".date").text($("#tdate").val())
        });
        $("#viewStudent").on("submit",function(e){
            e.preventDefault();
            if($("#scourse").val().trim() != "" && $("#sclass").val().trim() != ""  && $("#Sid").val().trim() != ""  && $("#type").val().trim() != ""){
                checkexist();
            }
            else{
                Swal.fire( 
                            'Error', 
                            'To proceed, please fill in all required fields', 
                            'error' 
                        ); 
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
                    alert(data);
                    if($("#type").val() == "overall"){
                            loadFull();
                    }else{
                        if (data == 1) {
                            if($("#type").val() == "bydate"){
                                loadbyDate();
                            }
                        }
                        else if(data == 0)
                        {
                            $(".showme").show();
                            $("#mytable").html("<div class='text-danger text-center h3'>No attendance has taken on (<span class='text-success'>"+$("#tdate").val()+")</span></div>");
                        }
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
                url : "./fetch/studentattendance.php",
                type:"POST",
                dataType:"json",
                data:{
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val(),
                    sid: $("#Sid").val(),
                },
                success:function(data){
                    if(data.error)
                    {
                        Swal.fire("Error occured",data.error,"warning");
                        $(".showme").hide();
                    }
                    else{
                        $(".showme").show();
                        var tableHTML = "<table id='dataTable' class='display table table-striped border-info-subtle table-bordered shadow table-hovered rounded'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Name</th><th class='text-center'>Sid</th><th class='text-center'>Class</th><th class='text-center'>Date</th><th>Status</th></thead><tbody class='text-center'>";
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
                            tableHTML += "<td class='text-center'>"+row1.attendance_date+"</td>";  
                            tableHTML += "<td>" + status + "</td>";
                            tableHTML += "</tr>";
                        });
                        tableHTML += "</tbody></table>";
                        $("#mytable").html(tableHTML);
                        initializeDataTable();
                    }
                },
                error:function(){
                    alert("error");
                }
            })
        }
        function loadbyDate(){
            $.ajax({
                url : "./fetch/getAttendanceData.php?action=individual",
                type:"POST",
                dataType:"json",
                data:{
                    date: $("#tdate").val(),
                    courseid: $("#scourse").val(),
                    class_id: $("#sclass").val(),
                    sid:$("#Sid").val()
                },
                success:function(data){
                    if(data.error)
                    {
                        Swal.fire("Error occured",data.error,"warning");
                        $(".showme").hide();
                    }
                    else{
                        $(".showme").show();
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
                    }
                },
                error:function(){
                    Swal.fire("Error occured","Something went wrong. Please try again later!","warning");
                }
            })
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
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })

})()
</script>
</body>
</html>
<?php 
    }
?>