<?php
session_start();
include 'db.php'; // Ensure this path is correct

header('Content-Type: application/json');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the request method is POST and the file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['verification_image'])) {
    $target_dir = "uploads/payment_verification/uploads";
    $target_file = $target_dir . basename($_FILES['verification_image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['verification_image']['tmp_name']);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['verification_image']['size'] > 5000000) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file is too large.']);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(['success' => false, 'message' => 'Sorry, your file was not uploaded.']);
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES['verification_image']['tmp_name'], $target_file)) {
            // Insert the verification record into the database
            $sql = "INSERT INTO deposit_verifications (user_id, image_path, status) VALUES (?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                error_log("Error preparing statement: " . $conn->error);
                echo json_encode(['success' => false, 'message' => 'Error processing verification.']);
                exit();
            }
            $stmt->bind_param("is", $user_id, $target_file);
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Deposit submitted for confirmation.']);
            } else {
                error_log("Error executing statement: " . $stmt->error);
                echo json_encode(['success' => false, 'message' => 'Error processing verification.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Sorry, there was an error uploading your file.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No file was uploaded.']);
}
?>