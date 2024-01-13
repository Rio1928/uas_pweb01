<?php
    // Connect to your database (replace these details with your own)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gamedatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $gameTitle = $_POST['title'];
    $developer = $_POST['developer'];

    // Insert data into the database (replace the table and column names)
    $sql = "INSERT INTO games (title, developer) VALUES ('$gameTitle', '$developer')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>