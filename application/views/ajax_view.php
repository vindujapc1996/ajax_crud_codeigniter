<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <title>AJAX VIEW</title>
</head>
<body style="background-color:#E2DFD2;"	>
<br>
<div class="col-md-8 text-right">
    <a href="<?php echo base_url('index.php/Employeecontroller/submit'); ?>" class="btn btn-primary">REGISTER</a>
</div>

<div class="container mt-6 border p-6" style="background-color:#FAF9F6; border: 4px solid #000;">
    <center><b style="font-size: 24px;">EMPLOYEE VIEW</b></center>

    <div class="row">

        <div class="col-md-12">
            <br>
            <div class="table-responsive">


            <table class="table" id="employeeTable" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>contact</th>
                    <th>email</th>
                    <th>dob</th>
                    <th>Qualification</th>
                    <th>gender</th>
                    <th>place</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
</div>
        </div>
    </div>
</div>

<!-- Include your scripts at the end of the body -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>  
        

        <script>
    $(document).ready(function () {
        $('#employeeTable').DataTable({
            ajax: {
                url: "<?php echo base_url('index.php/Employeecontroller/get_employee'); ?>",
                dataSrc: 'employees' // Specify the key where the data is located
                
            },
           columns: [
                {data: "id"},
                {data: "name"},
                {data: "contact"},
                {data: "email"},
                {data: "dob"},
                {data: "qualification"},
                {data: "gender"},
                {data: "place"},
                {
                    data: "image",
                     render: function (data, type, JsonResultRow, meta) {
                        var height = 30; // Replace with your preferred height
        var width = 30;  // Replace with your preferred width

        // Build the HTML string with the specified height and width
        return '<img src="<?= base_url('./assets/uploads') ?>/' + data + '" height="' + height + '" width="' + width + '">';

 }



                },

                {
                    data: null,
                    render: function (data, type, row) {
                        // You can customize the actions/buttons here
                        
                        
                        return '<a class="btn btn-primary" href="<?= base_url('index.php/Employeecontroller/edit') ?>/' + row.id + '">Edit</a>' +
                        '<button class="btn btn-danger" onclick="deleteEmployee(' + row.id + ')">Delete</button>';
                    }
                }
            ]
            
        });

    });
    
    function deleteEmployee(id) {
        console.log('Deleting employee with ID:', id);

        if (confirm('Are you sure you want to delete this employee?')) {
            $.ajax({
                url: '<?php echo base_url("index.php/Employeecontroller/delete_employee"); ?>/' + id,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    console.log('Delete response:', response);

                    if (response.success) {
                        alert(response.message);
                        $('#employeeTable').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus, errorThrown);
                }
            });
        }
       

    }



    

    




</script>

</body>
</html>
