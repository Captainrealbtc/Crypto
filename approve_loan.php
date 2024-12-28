<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loan_id = $_POST['loan_id'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Get the loan details
        $stmt = mysqli_prepare($conn, "SELECT user_id, amount FROM loans WHERE loan_id = ? AND status = 'pending'");
        mysqli_stmt_bind_param($stmt, "i", $loan_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_id, $amount);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($user_id && $amount) {
            // Update the loan status to approved
            $stmt = mysqli_prepare($conn, "UPDATE loans SET status = 'approved' WHERE loan_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $loan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Update the user's balance
            $stmt = mysqli_prepare($conn, "UPDATE users SET balance = balance + ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "di", $amount, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Commit the transaction
            mysqli_commit($conn);

            echo json_encode(['status' => 'success', 'message' => 'Loan approved and balance updated.']);
        } else {
            throw new Exception('Loan not found or already processed.');
        }
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    // Close the connection
    mysqli_close($conn);
}
?>