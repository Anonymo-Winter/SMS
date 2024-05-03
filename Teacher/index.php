<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>

    <link href="./css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <style>
        .form-control:active,
        .form-control:focus{
            outline:none;
            box-shadow:none;
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
                <div class="row-md-4 d-flex justify-content-between">
                    <h3>Dashboard</h3>
                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="index.php">Main</a>
                        <span class="breadcrumb-item active" aria-current="page">Dashboard</span>
                    </nav>
                </div>
                <div class="row mb-3">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card p-2 shadow border  border-secondary-subtle">
                            <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs text-muted font-weight-bold text-uppercase text-muted mb-1">Students</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">16</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
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
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">3</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard fa-2x text-primary"></i>
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
                                <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Class Arms</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">4</div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-code-branch fa-2x text-success"></i>
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
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">3</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard fa-2x text-danger"></i>
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
                                <div class="text-xs font-weight-bold text-uppercase text-muted mb-1">Attendance Taken</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">34/52</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard fa-2x text-warning"></i>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    var sidebarToggle = document.getElementById('sidebarToggle');
    sidebarToggle.addEventListener('click', function (event) {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
    });
</script>
</body>
</html>
</script>
