<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QuillJS save</title>
    <!-- Load libaries and configuration -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Save</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="load.php">Load</a>
            </li>
            
    </div>
</nav>
<body class="container">
    <?php
    if(isset($_GET['success'])){
        echo "<div class='alert alert-success' role='alert'>
        Content saved successfully (content_id: {$_GET['success']})
      </div>";
    }
    ?>
    <form action="saving-script.php" method="POST" onsubmit="getQuill('quill-content');" class="p-4 bg-light" style="min-height: 100vh;">
        <!-- Hidden input to attach quill delta value to -->
        <input hidden id="quill-content" name="description">

        <div>
            <h1>Quill Save</h1>
        </div>

        <!-- Create the editor container -->
        <div class="bg-white">
            <div style="min-height: 50vh;" id="quill-container"></div>
        </div>

        <div class="mb-2 mt-2 ">
            <input type="submit" name="submit" value="Save" class="btn btn-success">
            <input type="submit" name="escapeSubmit" value="Escape Save" class="btn btn-success">
        </div>
    </form>
</body>

</html>


<script>
    function getQuill(givenId) {
        // Set the content value to our hidden input
        document.getElementById(givenId).value = JSON.stringify(quill.getContents());

    }


    var quill = new Quill('#quill-container', {
        theme: 'snow'
    });
</script>