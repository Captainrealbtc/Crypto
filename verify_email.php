<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Sanitize and validate email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL statement with the correct column name
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $email);
            // Execute the statement
            mysqli_stmt_execute($stmt);
            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Email is registered.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address.']);
    }
    // Close the connection
    mysqli_close($conn);
}
?>