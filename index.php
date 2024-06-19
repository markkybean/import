<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Text File</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- jQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Custom JavaScript -->
    <script type="text/javascript" src="import.js"></script>
    
</head>

<body class="bg-success p-2 bg-opacity-25">

    <div class="container bg-success p-2 bg-opacity-75">

        <div class="container mt-5">
            <h2>File Upload</h2>
            <!-- Form for file upload -->
            <form name='myform' id='myform' method='POST' enctype="multipart/form-data" action="import.php">
                <div class="mb-3">
                    <label for="txtfile" class="form-label">Select file to upload:</label>
                    <input type="file" name="txtfile" id="txtfile" accept=".txt" class="form-control">
                </div>
                <input type='submit' class="btn btn-primary" value='Import'/>
            </form>
        </div>

    </div>

    <!-- PHP to display uploaded file contents -->
    <?php
    include "display.php";
    ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
