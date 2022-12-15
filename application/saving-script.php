<?php

function prepareStatement($escape = false)
{
    $sql = "INSERT INTO content (content_description) VALUES (?)";
    $conn = mysqli_connect("localhost", "root", '', "quilljs-db");

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $description);

        // Set parameters
        if ($escape) {
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            echo "true";
        } else {
            $description = $_POST['description'];
            echo "false";
        }


        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            //Get last inserter id
            $last_id = mysqli_insert_id($conn);
            echo "Records inserted successfully.";
            //Set header to index page
            header("Location: index.php?success=$last_id");
        } else {
            echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
        }
    } else {
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
    // Close connection
    mysqli_close($conn);
}

if (isset($_POST['submit'])) {
    prepareStatement();
}
if (isset($_POST['escapeSubmit'])) {
    prepareStatement(true);
}
