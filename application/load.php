<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QuillJS load</title>
    <!-- Load libaries and configuration -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <div class="p-4 bg-light" style="min-height: 100vh;">

        <div>
            <h1>Quill Load</h1>
        </div>
        <!-- Create the editor container -->
        <div class="bg-white my-2">
            <div style="min-height: 50vh;" id="quill-container"></div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Content Id: </span>
            </div>
            <input type="text" class="form-control" id="content_id" aria-describedby="basic-addon3">
            <div class="ms-1">
                <button class="btn btn-success" onclick="loadQuill()">Load</button>
                <button class="btn btn-success" onclick="loadQuill(true)">Load escaped</button>
            </div>

        </div>

    </div>
</body>

</html>


<script>
    var quill = new Quill('#quill-container', {
        theme: 'snow',
        readOnly: true,
        "modules": {
            "toolbar": false
        }

    });

    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    // Use AJAX to send the current location to the server. Server returns current and nearby locations
    function loadQuill(escape = false) {
        content_id = document.getElementById('content_id').value;
        $.ajax({
            type: 'POST',
            url: 'loading-script.php',
            data: 'content_id=' + content_id + '&escape=' + (escape ? 1 : 0),
            success: function(msg) {
                if (msg) {
                    //Load quill here
                    if (isJsonString(msg)) {
                        quill.setContents(JSON.parse(msg));
                        console.log("msg: " + msg);
                    } else {
                        quill.setText("error");
                    }


                } else {
                    quill.setText("error");
                }
            }
        });
    }
</script>