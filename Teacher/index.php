<?php 
session_start();
if (!isset($_SESSION["teacher_loggedin"]) || $_SESSION["teacher_loggedin"] !== true) {
    header("location: ./login.php");
    exit;
}

require_once '../config.php';
if (!$conn) {
    header("location: ./index.html");
    exit;
}

try {
    $stmt = $conn->prepare("SELECT COUNT(*) as total_students FROM students s, allocate_teacher a WHERE a.Sclass = s.Sclass AND tid = ?");
    $stmt->bind_param("s", $_SESSION["teacher_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $students = $result->fetch_assoc()["total_students"];
    $stmt->close();

    $stmt = $conn->prepare("SELECT COUNT(*) as total_teachers FROM teachers");
    $stmt->execute();
    $result = $stmt->get_result();
    $teachers = $result->fetch_assoc()["total_teachers"];
    $stmt->close();

    $stmt = $conn->prepare("SELECT COUNT(DISTINCT Sclass) as total_classes FROM allocate_teacher WHERE tid = ?");
    $stmt->bind_param("s", $_SESSION["teacher_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $classes = $result->fetch_assoc()["total_classes"];
    $stmt->close();

    $stmt = $conn->prepare("SELECT COUNT(DISTINCT Course_id) as total_subjects FROM allocate_teacher WHERE tid = ?");
    $stmt->bind_param("s", $_SESSION["teacher_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $subjects = $result->fetch_assoc()["total_subjects"];
    $stmt->close();
} catch (Exception $e) {
    echo "<script>Swal.fire('We\'re sorry, but we couldn\'t update your information. Please try again.','Something went wrong. Please try again!','error')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/linker.php"; ?>
</head>
<body class="sb-nav-fixed">
    <?php include "./include/nav.php"; ?>

    <div id="layoutSidenav" class="sb-sidenav-toggled">
        <?php include "./include/sidebar.php"; ?> 
        <div id="layoutSidenav_content">
            <main class="container p-4 font-monospace">
                <div class="row-md-4 d-flex justify-content-between flex-wrap">
                    <h3 class="fw-bold">Dashboard</h3>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Dashboard</span>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border border-secondary-subtle">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs text-muted font-weight-bold text-uppercase mb-1">Students</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $students; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Classes Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border border-secondary-subtle">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Classes</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $classes; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chalkboard fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border border-secondary-subtle">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Subjects</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $subjects; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-graduation-cap fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include "../include/footer.php"; ?>
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
