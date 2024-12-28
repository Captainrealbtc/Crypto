<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Sanitize and validate email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE email = ?");
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $email);
            // Execute the statement
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
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