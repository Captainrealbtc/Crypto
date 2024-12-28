<?php
session_start();
include 'db.php'; // Ensure this path is correct
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Crypto Investment</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php include 'includes/header.php'; ?>
    <style>
        .loader {
            border: 8px solid #f3f3f3; /* Reduced border size */
            border-top: 8px solid #3498db; /* Reduced border size */
            border-radius: 50%;
            width: 60px; /* Reduced width */
            height: 60px; /* Reduced height */ 
            animation: spin 2s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .popup-message {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 1001;
        }
    </style>
</head>
<body>

    <div class="login-page">
        <h1>Login</h1>
        <form id="loginForm" action="login_process.php" method="post" onsubmit="return validateForm()">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit"><i class="bi bi-fingerprint"></i></button>
            <button onclick="location.href='forgot_password.php'">Reset</button>
        </form>
    </div>
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>
    <div class="circle circle3"></div>
    <div class="circle circle4"></div>
    <div class="loader" id="loader"></div>
    <div class="popup-message" id="popupMessage">Processing your request...</div>
    <script src="js/scripts.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            // Show the loading animation
            document.getElementById('loader').style.display = 'block';

            // Show the popup message
            var popupMessage = document.getElementById('popupMessage');
            popupMessage.style.display = 'block';

            // Hide the popup message after 3 seconds
            setTimeout(function() {
                popupMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds = 3 seconds

            // Wait for 8 seconds before redirecting
            setTimeout(function() {
                // Perform the form submission
                document.getElementById('loginForm').submit();
            }, 8000); // 8000 milliseconds = 8 seconds

            // Prevent the default form submission
            event.preventDefault();
        });
    </script>
</body>
<!-- footer section -->
<footer>
<footer class="footer">
    <di class="container">
        
    <footer class="footer">
        <div class="container">
            <ul class="footer">
               
           
        </div>
    </div>
</footer>
<footer class="footer">
        <div class="container">
        <p>&copy; 2024 Prime Invest. All rights reserved.</p>
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
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://wa.me/yourwhatsappnumber" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        
    
            </p>
        </div>
    </footer>
</html>