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
    <title>Teacher - SMS</title>

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
            <main class="container p-3">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Dashboard</h3>
                        <nav class="breadcrumb">
                            <a class="text-primary breadcrumb-item " href="index.php">Main</a>
                            <span class="breadcrumb-item active" aria-current="page">View Students</span>
                        </nav>
                    </div>
                </div>
                <?php 
                    $teacher_class = "select * from allocate_teacher where id = 3";
                    $teacher_class_result = mysqli_query($conn,$teacher_class); 
                ?>
                <div class="row p-4">
                        <div class="card shadow border border-secondary">
                            <div class="card-body">
                                <form id="viewStudent"?>
                                    <div class="mb-3">
                                        <label for="sclass" class="form-label">Class <span class="text-danger fw-bold">*</span> :</label>
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
                                    <div class="text-end">
                                        <input type="submit" value="<?php if(isset($btn)) echo $btn; else echo "Submit" ?>" class="<?php if(isset($btn)) echo "btn btn-warning shadow"; else echo "btn btn-primary shadow" ?>" id="submit-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
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
                <div class="row p-4">
                    <div class="container-fluid shadow border border-secondary rounded py-2">
                        <div id="mytable" class="table table-responsive">
                            <!-- table  -->
                        </div>
                    </div>
                </div>

            </main>
            <?php include "./include/footer.php"?>
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
        $("#viewStudent").on("submit",function(e){
            e.preventDefault();
            $.ajax({
                url : './fetch/fetchStudent.php?action=students',
                type : "POST",
                data:{sclass:$("#sclass").val().toUpperCase()},
                beforeSend : function(){
                    $("#submit-btn").val("retrieving..");
                    $("#submit-btn").attr("disabled","disabled");
                },
                success : function(data){
                        loadTable();
                },
                error:function(){
                    settings("bg-danger-subtle","text-danger","Couldn't find data");
                }
            });
            $("#submit-btn").val("Save");
            $("#submit-btn").attr("disabled",false);                    
        });
        function loadTable(){
            $.ajax({
                url : "./fetch/fetchStudent.php?action=students",
                type:"POST",
                dataType:"json",
                data:{sclass:$("#sclass").val()},
                success:function(data){
                    var tableHTML = "<table id='dataTable' class='display table table-bordered'><thead class='table-dark'><th class='text-center'>Roll No</th><th class='text-center'>Name</th><th class='text-center'>Sid</th><th class='text-center'>Class</th></thead><tbody class='text-center'>";
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td>" + row.Srollno + "</td>";
                        tableHTML += "<td>" + row.Sname + "</td>";
                        tableHTML += "<td>" + row.Sid + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
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
