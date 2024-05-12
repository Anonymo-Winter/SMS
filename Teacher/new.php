<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        .dataTables_length {
            display: none; /* Hide the label and dropdown */
        }

        .custom-buttons {
            margin-left: 20px; /* Adjust margin as needed */
        }
    </style>
</head>
<body>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
        </tr>
        <!-- Other rows -->
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();

    // Add custom button next to page length control
    $('.dataTables_length').append('<button class="custom-buttons" id="reloadTable">Reload Table</button>');

    // Handle click event for custom button
    $('#reloadTable').on('click', function() {
        $('#example').DataTable().ajax.reload();
    });
});
</script>

</body>
</html>
