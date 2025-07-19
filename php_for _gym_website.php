<?php
    // Database credentials
    $servername = "localhost";
    $username = "your_db_username"; // Replace with your database username
    $password = "your_db_password"; // Replace with your database password
    $dbname = "gym_contact";

    // Create a connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        $conn->select_db($dbname);
    } else {
        echo "<div class='message error'>Error creating database: " . $conn->error . "</div>";
    }

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS contacts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(15),
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
    if ($conn->query($sql) !== TRUE) {
        echo "<div class='message error'>Error creating table: " . $conn->error . "</div>";
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $message = $conn->real_escape_string($_POST['message']);

        // Insert data into the database
        $sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='message success'>Message sent successfully!</div>";
        } else {
            echo "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    }

    // Close the connection
    $conn->close();
    ?>