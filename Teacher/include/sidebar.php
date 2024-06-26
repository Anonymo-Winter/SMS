<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="./index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Students</div>
                            <a class="nav-link" href="takeAttendance.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-edit"></i></div>
                                Take Attendance
                            </a> 
                            <a class="nav-link" href="viewClassAttendane.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                View Class Attendance
                            </a> 
                            <a class="nav-link" href="viewStudentAttendance.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-day"></i></div>
                                 Student Attendance
                            </a>          
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo htmlspecialchars($_SESSION["username"])?>
                    </div>
                </nav>
            </div>