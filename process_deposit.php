<?php
session_start();
include 'db.php'; // Ensure this path is correct

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $plan = $_POST['plan'];

    // Validate the amount
    if ($amount <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid deposit amount.']);
        exit();
    }

    // Insert the deposit record into the database
    $sql = "INSERT INTO deposits (user_id, amount, payment_method, status) VALUES (?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Error processing deposit.']);
        exit();
    }
    $stmt->bind_param("ids", $user_id, $amount, $payment_method);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Deposit successful.']);
    } else {
        error_log("Error executing statement: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Error processing deposit.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>