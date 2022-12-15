<?php
function loadQuill($escape = false){
    $content_id = trim($_POST['content_id']);
    $conn = mysqli_connect("localhost", "root", '', "quilljs-db");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM content WHERE content_id='$content_id' limit 1";
    $result = mysqli_query($conn, $sql);
    
    if ($result !== false) {
        $row = $result->fetch_row();
        $value = $row[1];

        if($escape){
            echo stripslashes($value);
            
        }
        else{
            echo $value;
        }
        
    }
    
}

if (!empty($_POST['content_id'])){
    $escape = $_POST['escape'];
    loadQuill($escape);
}
