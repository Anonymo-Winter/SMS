<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Classes & Students</div> 
                            <a href="manageStudents.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fas fa-user"></i></div> Manage Students</a>
                            <a href="manageLeader.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>Manage CRs</a>
                        <div class="sb-sidenav-menu-heading">Classes</div>
                            <a href="manageClass.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fas fa-chalkboard"></i></div> Manage Classes</a>
                        <div class="sb-sidenav-menu-heading">Teachers</div>
                            <a href="manageTeacher.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fas fa-chalkboard-user"></i></div>Manage Teachers</a>
                            <a href="allocateTeacher.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fas fa-person-chalkboard"></i></div>Allocate Teachers</a>
                        <div class="sb-sidenav-menu-heading">Subjects</div>
                            <a href="manageSubject.php" class="nav-link"><div class="sb-nav-link-icon"><i class="fa fa-book" aria-hidden="true"></i></div>Manage Subjects</a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php if(isset($_SESSION["username"])) echo htmlspecialchars($_SESSION["username"]);?>
                </div>
            </nav>
        </div>