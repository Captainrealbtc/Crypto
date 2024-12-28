<?php
session_start();
include 'db.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $referral = isset($_POST['referral']) ? $_POST['referral'] : null;

    // Check if the username already exists
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $error = "Username already exists.";
    } else {
        // Insert the new user
        $sql = "INSERT INTO users (username, email, password, balance, referral_bonus) VALUES (?, ?, ?, 10, 0)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            error_log("Error preparing statement: " . $conn->error);
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            // Get the new user's ID
            $new_user_id = $stmt->insert_id;

            // If there is a referrer, update their referral bonus
            if ($referral) {
                $sql = "UPDATE users SET referral_bonus = referral_bonus + 20 WHERE username = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    error_log("Error preparing statement: " . $conn->error);
                    die("Error preparing statement: " . $conn->error);
                }
                $stmt->bind_param("s", $referral);
                $stmt->execute();
            }

            $_SESSION['user_id'] = $new_user_id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Error registering user.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Crypto Investment</title>
    <link rel="stylesheet" href="css/reg.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<style>/* From Uiverse.io by Userluckytian */
.loading svg polyline{
    fill: none;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.loading svg polyline#back{
    fill: none;
    stroke: #ff4d5033;
}

.loading svg polyline#front{
    fill: none;
    stroke: #00ffff;
    stroke-dasharray: 48, 144;
    stroke-dashoffset: 192;
    animation: dash_682 2s linear infinite;
    animation-delay: 0s;
}

.loading svg polyline#front2{
    fill: none;
    stroke: #00ffff;
    stroke-dasharray: 48, 144;
    stroke-dashoffset: 192;
    animation: dash_682 2s linear infinite;
    animation-delay: 1s;
}

@keyframes dash_682{
    72.5%{
        opacity: 0;
    }
    to{
        stroke-dashoffset: 0;
    }
}
</style>
<body>

<!-- From Uiverse.io by userluckytian -->

<div class="loading">
    <svg height="48px" width="64px">
        <polyline id="back" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
        <polyline id="front" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
        <polyline id="front2" points="0.157 23.954, 14 23.954, 21.843 48, 43 0, 50 24, 64 24"></polyline>
        </svg>
</div>

   <section>
<div class="registration-page">
    <marquee behavior="float" direction="">
    <h1>Welcome To Prime Invest</h1></marquee>
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form action="register_process.php" method="post">
            <br>
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            <br>
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            <br>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            <br>
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            <br>
                <label for="referral" class="form-label">Referral (optional)</label>
                <input type="text" class="form-control" id="referral" name="referral" value="<?php echo isset($_GET['referral']) ? htmlspecialchars($_GET['referral']) : ''; ?>" readonly>
            <br>
            <button type="submit" class="btn btn-primary">Register</button>
            <button ><a href="login.php">Login</a></button>
        </form>
   </section>
    </div>

    <div class="slider">
        <div class="slide">
            <img src="img/Man_bg.png" alt="">
            <div class="slide-text">
                <p>i love it</p>
            </div>
        </div>

        <div class="slider">
        <div class="slide">
            <img src="img/Man_bg.png" alt="">
            <div class="slide-text">
                <p>we love it</p>
            </div>
        </div>

        <div class="slider">
        <div class="slide">
            <img src="img/Man_bg.png" alt="">
            <div class="slide-text">
                <p>they love it</p>
            </div>
        </div>
    </div>
    <!--<footer class="footer">
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
    </footer> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">


    document.querySelector('form').addEventListener('submit', function(event) {
        showLoader();
    });

    function showLoader() {
        document.getElementById('loader').style.display = 'block';
    }

    function hideLoader() {
        document.getElementById('loader').style.display = 'none';
    }


    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        showLoader();

        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'register_process.php', true);
        xhr.onload = function() {
            hideLoader();
            if (xhr.status === 200) {
                // Handle success (e.g., redirect or show a success message)
                window.location.href = 'dashboard.php';
            } else {
                // Handle error
                alert('Error registering user.');
            }
        };
        xhr.send(formData);
    });
</script>

</body>
</html>