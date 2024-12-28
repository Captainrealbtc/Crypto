<?php
session_start();
include 'db.php'; // Ensure this path is correct

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];


// Generate a unique referral link
$referral_link = "http://localhost/register.php?referral=" . urlencode($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral - Crypto Investment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: white;
            text-decoration: none;
            padding: 0 10px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container mt-5">
        <h1>Referral Program</h1>
        <p>Share your referral link with friends and earn rewards!</p>
        <div class="mb-3">
            <label for="referralLink" class="form-label">Your Referral Link</label>
            <input type="text" class="form-control" id="referralLink" value="<?php echo htmlspecialchars($referral_link); ?>" readonly>
        </div>
        <button class="btn btn-primary" onclick="copyToClipboard()">Copy Link</button>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Crypto Investment. All rights reserved.</p>
            <p>
                <a href="index.php">Home</a> |
                <a href="about.php">About</a> |
                <a href="services.php">Services</a> |
                <a href="contact.php">Contact</a> |
                <a href="investment.php">Investment</a> |
                <a href="profile.php">Profile</a> |
                <a href="settings.php">Settings</a> |
                <a href="register.php">Register</a> |
                <a href="login.php">Login</a>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("referralLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Referral link copied to clipboard!");
        }
    </script>
</body>
</html>