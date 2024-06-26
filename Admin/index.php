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
    <?php include "./include/linker.php" ?>
</head>
<body class="sb-nav-fixed">
    <!-- navbar -->
    <?php  include "./include/nav.php" ?>
    <!-- sidebar -->
    <div id="layoutSidenav" class="sb-sidenav-toggled">

        <?php  include "./include/sidebar.php" ?> 
        <?php 
            try{
                $students = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total_students FROM students"));
                $students = $students["total_students"];

                $teachers = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total_teachers FROM teachers"));
                $teachers = $teachers["total_teachers"];

                $classes = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total_classes FROM classes"));
                $classes = $classes["total_classes"];

                $department = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total_dept FROM department"));
                $department = $department["total_dept"];
                
                $subjects = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total_subjects FROM subjects"));
                $subjects = $subjects["total_subjects"];
                
                
                
            }catch(Exception $e)
            {
                echo "<script>Swal.fire('We\'re sorry, but we couldn\'t fetch data. Please try again.','Something went wrong. Please try again!','warning')</script>";
            }
        ?>
        <div id="layoutSidenav_content" id="content">
            <main class="container p-4 font-monospace">
                <div class="row-md-5 d-flex justify-content-between flex-wrap">
                    <h3 class="fw-bold">Dashboard</h3>
                    <nav class="breadcrumb">
                        <a class="nav-link text-primary breadcrumb-item" href="./index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Primary details</span>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border border-secondary-subtle">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs text-muted font-weight-bold text-uppercase text-muted mb-1">Students</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $students;?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info" ></i>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
            <!-- Class Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card p-2 shadow border border-secondary-subtle">
                        <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Classes</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $classes;?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard fa-2x text-success" ></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- Class Arm Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card p-2 shadow border  border-secondary-subtle shadow border">
                        <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">departments</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $department ?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-code-branch fa-2x text-danger"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <!-- Teachers Card  -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card p-2 shadow border  border-secondary-subtle">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Class Teachers</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $teachers;?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- subjects card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card p-2 shadow border  border-secondary-subtle">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Subjects</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $subjects;?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-graduation-cap fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                        <!-- Terms Card  -->
                <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border  border-secondary-subtle">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Terms</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">2</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-th fa-2x text-warning"></i>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "../include/footer.php"?>
        </div>
    </div>
</div>
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