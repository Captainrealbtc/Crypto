<?php
// db.php should contain your database connection code
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert user into the database (example query, adjust as needed)
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        // Redirect back to the registration page with a success flag
        header('Location: dashboard.php?success=1');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>