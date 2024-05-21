<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="./index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Status</div>
                            <a class="nav-link" href="viewStudentAttendance.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                 Student Attendance
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) echo $_SESSION["username"]?>
                    </div>
                </nav>
            </div>