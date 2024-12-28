<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];
$withdrawal_method = $_POST['withdrawal_method']; // Get the selected withdrawal method


// 1. Validate the withdrawal amount (e.g., not negative, not exceeding balance)
$sql = "SELECT balance FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($amount > $user['balance'] || $amount <= 0) {
    $_SESSION['message'] = "Invalid withdrawal amount.";
    header("Location: dashboard.php"); // Create this withdraw.php file
    exit();
}


// 2. Deduct the amount from the user's balance in the database
$new_balance = $user['balance'] - $amount;
$sql = "UPDATE users SET balance = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $new_balance, $user_id);


if ($stmt->execute()) {
    // 3. Record the transaction in the transactions table
    $description = "Withdrawal via " . $withdrawal_method; // Include the withdrawal method in the description
    $sql = "INSERT INTO transactions (user_id, date, description, amount) VALUES (?, NOW(), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $_SESSION['message'] = "Withdrawal successful!";

} else {
    $_SESSION['message'] = "Error processing withdrawal.";
}

// ... other code ...

// 3. Record the transaction in the transactions table
$description = "Withdrawal via " . $withdrawal_method; 
$withdrawal_amount = -$amount; // Store the negated amount in a variable

$sql = "INSERT INTO transactions (user_id, date, description, amount) VALUES (?, NOW(), ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isd", $user_id, $description, $withdrawal_amount); // Use the variable here
$stmt->execute();

// ... rest of the code ...


header("Location: dashboard.php"); // Redirect back to the withdrawal page
exit();
?>