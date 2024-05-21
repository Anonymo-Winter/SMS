<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Teacher - Dashboard</title>
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
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


</head>
<body class="sb-nav-fixed">
    <!-- sidebar -->
    <main class="p-4 font-monospace">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="shadow border border-secondary rounded py-2">
                        <div id="mytable" class="table-responsive">
                            
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-success shadow ms-5" id="attendance-btn" value="Take Attendance">Take Attendance</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include "./include/footer.php"?>
    
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>



<script>
    $(document).ready(function(){   
        var table;

        function loadTable(){
            $.ajax({
                url : "./fetch/fetchStudent.php?action=students",
                type:"POST",
                dataType:"json",
                data:{
                    sclass:"CSE-1A"
                },
                success:function(data){
                    var tableHTML = '<table id="dataTable" class="display table table-bordered table-hover table-striped"><thead class="table-dark"><tr><th class="text-center">Roll No</th><th class="text-center">Name</th><th class="text-center">Sid</th><th class="text-center">Class</th></tr></thead><tbody class="text-center">';
                    data.forEach(function(row) {
                        tableHTML += "<tr>";
                        tableHTML += "<td class='text-center'>" + row.Srollno + "</td>";
                        tableHTML += "<td>" + row.Sname + "</td>";
                        tableHTML += "<td>" + row.Sid + "</td>";
                        tableHTML += "<td>" + row.Sclass + "</td>";
                        tableHTML += "</tr>";
                    });
                    tableHTML += "</tbody></table>";
                    $("#mytable").html(tableHTML);
                    initializeDataTable();
                },
                error:function(){
                    alert("error");
                }
            });
        }
        
        function initializeDataTable() {
            if (table) {
                table.destroy();
            }
            table = $("#dataTable").DataTable({
                        responsive: true, 
                        autoWidth: false,
                        select: true,
                        layout: {
                            bottomStart: {
                                buttons: [
                                    {
                                        text: 'Reset table',
                                        action: function () {
                                            loadTable();
                                        }
                                    }
                                ]
                            }
                        },
                        columnDefs: [
                            {
                                "render": DataTable.render.select(),
                                "targets": 4
                            },
                        ],
                        select: {
                            style: 'multi',
                        },
                        order: [[0, 'asc']],
                    });
        }

        loadTable();
    });
</script>

</body>
</html>
