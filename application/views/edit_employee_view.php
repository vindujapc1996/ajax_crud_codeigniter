<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
    <title>Edit Employee</title>
</head>
<body>
    
    <div class="container mx-auto " style="background-color:#FAF9F6; border: 4px solid #000;max-width: 600px;">

        <center><b style="font-size: 24px;">Edit Employee</b></center>
        <br>

        <form id="editEmployeeForm" action="<?= base_url('index.php/Employeecontroller/update_employee'); ?>" method="POST" enctype="multipart/form-data">
            <!-- Hidden field for employee ID -->
            <center>
            <input type="hidden" name="id" value="<?= $employee->id; ?>">

            <!-- Fields -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="<?= $employee->name; ?>" required>
            </div>
            <br>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" name="gender" required>
                    <option value="male" <?= ($employee->gender == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?= ($employee->gender == 'female') ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?= ($employee->gender == 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
<br>
            <div class="form-group">
                <label for="place">Place:</label>
                <input type="text" class="form-control" name="place" value="<?= $employee->place; ?>" required>
            </div>
            <br>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" name="dob" value="<?= $employee->dob; ?>" required>
            </div>
<br>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" name="contact" value="<?= $employee->contact; ?>" required>
            </div>
<br>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?= $employee->email; ?>" required>
            </div>
<br>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" value="<?= $employee->address; ?>" required>
            </div>
<br>
            <div class="form-group">
                <?php $employee->qualification=explode(',',$employee->qualification); ?>
                <label for="qualification">Qualification:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="SSLC" id="sslc" <?= in_array('SSLC', $employee->qualification) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="sslc">SSLC</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="Plus Two" id="plus_two" <?= in_array('Plus Two', $employee->qualification) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="plus_two">Plus Two</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="Degree" id="degree" <?= in_array('Degree', $employee->qualification) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="degree">Degree</label>
                </div>
            </div>
<br>
            <!-- <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" id="image">
            </div> -->
            <div class="form-group">
    <label for="image">Image:</label>
    <input type="file" class="form-control" name="image" id="image">
    <?php if ($employee->image): ?>
        <p>Current Image:</p>
        <img src="<?= base_url('assets/uploads/' . $employee->image); ?>" alt="Current Image" style="max-width: 200px;">
    <?php endif; ?>
</div>
<br>
            <!-- Update button -->
            <button type="button" class="btn btn-primary" onclick="updateEmployee(<?= $employee->id; ?>)">Update</button>
            </center>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <!-- //         function updateEmployee() {
        //     // Serialize the form data
        //     var formData = $('#editEmployeeForm').serialize();

        //     // Perform AJAX request
        //     $.ajax({
        //         type: 'POST',
        //         url: $('#editEmployeeForm').attr('action'),
        //         data: formData,
        //         success: function(response) {
        //             alert('Employee updated successfully!');
        //         window.location.href = '<?= base_url('index.php/Employeecontroller/index'); ?>';

        //             // Add any other logic you need after successful update
        //         },
        //         error: function(error) {
        //             console.error('Error:', error);
        //         }
        //     });
        // } --> 
 
        <script>
    $(document).ready(function() {
        $('#editEmployeeForm').submit(function(event) {
            event.preventDefault();
            updateEmployee();
        });
    });

    function updateEmployee() {
        //var formData = $('#editEmployeeForm').serialize();
        var formData = new FormData($('#editEmployeeForm')[0]);

        formData.append('id', <?= $employee->id; ?>);  // Append employee ID to FormData
    formData.append('image_updated', $('#image').val() ? 1 : 0);  // Set the image_updated flag
  // Correct variable name
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '<?= base_url("index.php/Employeecontroller/update_employee"); ?>',
            data: formData,
            dataType: 'json', // Expect JSON response
            contentType: false, // Ensure that content type is set to false
        processData: false, // Ensure that processData is set to false

            success: function(response) {
                if (response.success) {
                    alert('Employee updated successfully!');
                    window.location.href = '<?= base_url('index.php/Employeecontroller/index'); ?>';
                } else {
                    alert('Error updating employee: ' + response.message);
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
    
</script>   
 

  <!-- <script>
        $(document).ready(function() {
            $('#editEmployeeForm').submit(function(event) {
                event.preventDefault();
                updateEmployee();
            });

            function updateEmployee() {
                // Serialize the form data
                var formData = $('#editEmployeeForm').serialize();

                // Perform AJAX request
                $.ajax({
                    type: 'POST',
                    url: $('#editEmployeeForm').attr('action'),
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            // Redirect to the employee list page
                            window.location.href = '<?= base_url("index.php/EmployeeController/index"); ?>';
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
 -->

    <!-- Add your scripts here if needed -->
      </script>

</body>
</html>
