<!-- Edit.php view file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Edit Employee</title>
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Employee</h2>
        <form id="editEmployeeForm">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name">
            </div>

            <div class="form-group">
                <label>Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" name="dob" id="dob">
            </div>

            <div class="form-group">
                <label for="place">Place:</label>
                <input type="text" class="form-control" name="place" id="place">
            </div>

            <div class="form-group">
                <label for="qualification">Qualification:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="SSLC" id="sslc">
                    <label class="form-check-label" for="sslc">SSLC</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="Plus Two" id="plus_two">
                    <label class="form-check-label" for="plus_two">Plus Two</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="qualification[]" value="Degree" id="degree">
                    <label class="form-check-label" for="degree">Degree</label>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>

            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" name="contact" id="contact">
            </div>

            <!-- Update button -->
            <button type="button" class="btn btn-primary" onclick="updateEmployee()">Update</button>
        </form>

        <!-- Cancel button -->
        <a href="<?php echo base_url('index.php/Employeecontroller/index'); ?>" class="btn btn-secondary">Cancel</a>
    </div>

    <!-- Include your scripts at the end of the body -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function updateEmployee() {
            // AJAX code to update employee details
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/Employeecontroller/update_employee"); ?>',
                data: $('#editEmployeeForm').serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        // Redirect to the employee view or perform other actions as needed
                        window.location.href = '<?php echo base_url("index.php/Employeecontroller/index"); ?>';
                    } else {
                        alert(response.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus, errorThrown);
                }
            });
        }
    </script>
</body>
</html>
