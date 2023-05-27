<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the form data (you can add more validation if needed)
    if (empty($username) || empty($password)) {
        echo 'Please fill in both username and password.';
    } else {
        // Database connection configuration
        $servername = 'localhost';
        $username_db = 'username';
        $password_db = 'Password1@';
        $dbname = 'database';

        // Create a new database connection
        $conn = new mysqli($servername, $username_db, $password_db, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare the SQL statement to retrieve the user from the database
        $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->bind_param('ss', $username, $password);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows === 1) {
            // User is authenticated, perform login action

            // Redirect to the welcome page
            header('Location: index.php');
            exit();
        } else {
            // Invalid credentials
            echo 'Invalid username or password.';
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
}
?>
