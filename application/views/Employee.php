<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <title>AJAX CRUD</title>
</head>

<body style="background-color:#E2DFD2;">

    <div class="container mt-4 border p-4" style="background-color:pink;">
        <div class="row">
            <div class="col-md-6">
                <br>
                <form id="Employee" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label><br>
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
                        <select class="form-control" name="place" id="place">
                            <option value="select">select</option>
                            <option value="kozhikode">Kozhikode</option>
                            <option value="kollam">Kollam</option>
                            <option value="kasargod">Kasargod</option>
                        </select>
                    </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label for="qualification">Qualification:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" value="SSLC" id="sslc">
                        <label class="form-check-label" for="sslc">SSLC</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" value="Plus Two"
                            id="plus_two">
                        <label class="form-check-label" for="plus_two">Plus Two</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="qualification[]" value="Degree"
                            id="degree">
                        <label class="form-check-label" for="degree">Degree</label>
                    </div>
                </div>


                <div class="form-group">
                    <label for="email">email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="address">address:</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="form-group">
                    <label for="contact">contact:</label>
                    <input type="text" class="form-control" name="contact" id="contact">
                </div>
                <div class="form-group">
                   <label for="image">Image:</label>
                   <input type="file" class="form-control" name="image" id="image">
                </div>


                <br>
                <br>
                <div class="form-group">
                    <button type="submit" name="submit" value="submit" style="margin-right:93%;" class="btn btn-primary"
                        id="submit">Submit</button>

                </div>
                <br>

            </div>
            </form>

        </div>
    </div>

    <br>
    <div class="col-md-12  ">
        <a href="<?php echo base_url('index.php/Employeecontroller/index'); ?>" class="btn btn-primary">cancel</a>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle form submission
            $('#submit').on('click', function (event) {
                event.preventDefault();

                // Serialize the form data
                var formData = new FormData($('#Employee')[0]);

                // Make an AJAX request
                $.ajax({
                    type: 'POST',
                   dataType: "json",
                    encode: true,
                    processData: false, // Important: prevent jQuery from processing the data
            contentType: false, // Important: let the server handle the data


                    url: "<?php echo base_url('index.php/Employeecontroller/submit') ?>",
                    data: formData,
                    success: function (response) {
                        console.log("success",response);
                         alert(response.message);
                        location.reload();


                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log( textStatus, errorThrown);
                    }
                });
            });
        });
    </script>

</body>

</html>