<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate the form data (you can add more validation if needed)
    if (empty($username) || empty($password) || empty($email)) {
        echo 'Please fill in all the fields.';
    } else {
        // Database connection configuration
        $servername = 'localhost';
        $username_db = 'id20817683_username';
        $password_db = 'Password1@';
        $dbname = 'id20817683_database';

        // Create a new database connection
        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare the SQL statement to insert the user data into the database
        $stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $password, $email);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Signup successful
            // Redirect to the success page
            header('Location: index.php');
            exit();
        } else {
            echo 'Error: ' . $stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
