<!DOCTYPE html>
<html>
<head>
    <title>Product Review Form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Product Review Form</h1>
        <form id="myForm">
            <div class="form-group">
                <label for="text">Enter Your Review</label>
                <textarea class="form-control" id="text" name="text" rows="5" placeholder="Enter your product review here"></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Select Your Rating</label>
                <select class="form-control" id="rating" name="rating">
                    <option value="">Please select a rating</option>
                    <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                    <option value="3">&#9733;&#9733;&#9733;</option>
                    <option value="2">&#9733;&#9733;</option>
                    <option value="1">&#9733;</option>
                </select>
            </div>
        </form>
        <div id="output" class="mt-3"></div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#text, #rating').on('change keyup', function() {
                var formData = $('#myForm').serialize();
                $.ajax({
                    method: "POST",
                    url: "{{asset('run_python.php ')}}",
                    data: formData,
                    success: function(result) {
                        $('#output').html(result);
                    }
                });
            });

        });
    </script>
</body>
</html>
