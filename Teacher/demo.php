<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <style>
        #studentTable_wrapper {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<table id="studentTable" class="display">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Select</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>Class 10</td>
            <td><input type="checkbox" name="studentId" value="1"></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Smith</td>
            <td>Class 11</td>
            <td><input type="checkbox" name="studentId" value="2"></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Michael Johnson</td>
            <td>Class 12</td>
            <td><input type="checkbox" name="studentId" value="3"></td>
        </tr>
    </tbody>
</table>
<button id="checkButton">Check Selected IDs</button>
<script>
    $(document).ready(function() {

        $('#studentTable').DataTable();
        $('#checkButton').on('click', function() {
            var selectedIds = [];
            $('input[name="studentId"]:checked').each(function() {
                selectedIds.push($(this).val());
            });
            alert('Selected Student IDs: ' + selectedIds);
        });
    });
</script>

</body>
</html>
