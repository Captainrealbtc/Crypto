<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; // Ensure this path is correct

// Check if the connection is established
if (!isset($conn)) {
    die("Database connection failed.");
}
$user_id = $_SESSION['user_id'];


// Generate a unique referral link
$referral_link = "http://localhost/register.php?referral=" . urlencode($user_id);

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    error_log("Error preparing statement: " . $conn->error);
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    error_log("Error executing statement: " . $stmt->error);
    die("Error executing statement: " . $stmt->error);
}
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if (!$user) {
    die("User not found.");
}

// Add default values to handle undefined keys
$balance = isset($user['balance']) ? $user['balance'] : 10;
$investment = isset($user['investment']) ? $user['investment'] : 0;
$deposit = isset($user['deposit']) ? $user['deposit'] : 0;
$referral_bonus = isset($user['referral_bonus']) ? $user['referral_bonus'] : 0;
$total_investment = isset($user['total_investment']) ? $user['total_investment'] : 0;
$current_value = isset($user['current_value']) ? $user['current_value'] : 0;

// Fetch recent transactions
$sql = "SELECT date, description, amount FROM transactions WHERE user_id = ? ORDER BY date DESC LIMIT 10";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    error_log("Error preparing statement: " . $conn->error);
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    error_log("Error executing statement: " . $stmt->error);
    die("Error executing statement: " . $stmt->error);
}
$recent_transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch testimonials
$sql = "SELECT image, name, text FROM testimonials LIMIT 10";
$result = $conn->query($sql);
if ($result === false) {
    error_log("Error executing query: " . $conn->error);
    die("Error executing query: " . $conn->error);
}
$testimonials = $result->fetch_all(MYSQLI_ASSOC);

// Insert initial testimonials data
$sql = "INSERT INTO testimonials (image, name, text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("sss", $image, $name, $text);

// Example testimonials data
$testimonials = [
    ['img/1.jpg', 'John Doe', 'This platform is amazing!'],
    ['img/2.jpg', 'Jane Smith', 'I love using this service.'],
];

// Fetch deposit and withdrawal messages
$sql = "SELECT name, country, type FROM messages ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);
if ($result === false) {
    error_log("Error executing query: " . $conn->error);
    die("Error executing query: " . $conn->error);
}
$deposit_withdrawal_messages = $result->fetch_all(MYSQLI_ASSOC);

// Insert initial deposit and withdrawal messages data
$sql = "INSERT INTO messages (name, country, type) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("sss", $name, $country, $type);


// Fetch deposit and withdrawal messages with amounts
$sql = "SELECT name, country, type, amount FROM messages ORDER BY id DESC LIMIT 10"; // Add amount to the query
$result = $conn->query($sql);
// ... (error handling)

// Example messages data

$messages = [
    ['Alice', 'USA', 'deposit', '$700' ],
    ['Bob', 'Canada', 'withdrawal'],
    ['Charlse', 'UK', 'deposit', '$7000'],
    ['Paul', 'USA', 'deposit'],
    ['Marryam', 'Dubai', 'withdrawal'],
    ['Sayabonga', 'South Africa', 'withdrawal', '$6000'],
    ['Frank', 'Ukrain', 'deposit'],
    ['Marley', 'Mozambique', 'withdrawal'],
    ['Ruth', 'Nigeria', 'withdrawal'],
    ['Peter', 'Uganda', 'deposit', '$200'],
    ['Agent', 'Panama', 'withdrawal'],
    ['Charlie', 'Botswana', 'deposit', '$5000'],
];

foreach ($messages as $message) {
    list($name, $country, $type) = $message;
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <title>Dashboard - Crypto Investment</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            
        }
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
            display: flex;
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
       /* Style for the popup messages */
       .message-popup {
            position: fixed;
            top: 20px; /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
            z-index: 1000; /* Ensure it's on top */
            display: none; /* Initially hidden */
            opacity: 0; /* Initially transparent */
            transition: opacity 0.5s ease-in-out; /* Smooth fade-in/out */
        }

        .message-popup.show {
            display: block;
            opacity: 1;
        }
        {
            color: white;
              text-decoration: none;
            padding: 14px 20px;
            display: block;
        }
        .navbar .nav-list li a:hover {
            background-color: #ddd;
            color: black;
        }*/
        .profile-picture {
            position: relative;
            display: inline-block;
        }
        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            cursor: pointer;
        }
        .profile-picture input[type="file"] {
            display: none;
        }
        .dashboard-buttons {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            color: red;
        }
        .dashboard-buttons button {
            padding: 10px 20px;
            font-size: 19px;
            cursor: pointer;
            border-radius: 20px;
               
        }
    .dashboard-buttons {

    }
      .card-header {
    background-color: #040f1b;
    
    padding:0%;
    border-top-left-radius: px;
    border-top-right-radius: px;
    display: flex;
    align-items: center
}

#popup-content{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

#popup{
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    width: 80%;
    max-width: 400px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.popup-content {
    margin-bottom: 20px;

}

.popup-content img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
    
    </style>
</head>
<body>
    <?php include 'includes/header1.php'; ?>
    

    
          
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!
        <p>This is your dashboard.</p>

        <!-- User Profile Section -->
        <div class="profile-picture">
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" id="profileImage">
            <form id="profilePictureForm" action="update_profile_picture.php" method="post" enctype="multipart/form-data">
                <input type="file" name="profile_picture" id="profilePictureInput">
            </form>
        </div>

        <!-- Investment Summary Section -->
        <div class="investment-summary">
            <h2>Investment Summary</h2>
            <p><strong>Total Investment:</strong> $<?php echo number_format($total_investment, 2); ?></p>
            <p><strong>Current Value:</strong> $<?php echo number_format($current_value, 2); ?></p>
        </div>

        <!-- popup with pix -->
<div id="popup-container" style="display:none;">
    <di id="popup">
        <div class="popup-content">
            <img src="img/1.jpg" alt="">
            <p>message</p>
        </div>
        <div class="popup-content">
            <img src="img/2.jpg" alt="">
            <p>message</p>
        </div>
        <div class="popup-content">
            <img src="img/3.jpg" alt="">
            <p>message</p>
        </div>
</div>
        <!-- Dashboard Cards Section -->
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <h2>Balance <i class="bi bi-cash-coin"></i></h2>
                </div>
                <div class="card-body">
                    <p><i>The amount withdrawable</i></p>
                    <strong><p>$<?php echo number_format($balance, 2); ?></p></strong>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Investment <i class="bi bi-credit-card-2-front"></i></h2>
                </div>
                <div class="card-body">
                    <p><i>Invested total amount</i></p>
                    <strong><p>$<?php echo number_format($investment, 2); ?></p></strong>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                   
                    <h2>Deposit <i class="bi bi-bank2"></i></h2>
                    
                </div>
                <div class="card-body">
                    <p><i>Deposited amount</i></p>
                    <strong><p>$<?php echo number_format($deposit, 2); ?></p></strong>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>Referral Bonus <i class="bi bi-people"></i></h2>
                </div>
                <div class="card-body">
                    <p><i>Bonus received from friends</i></p>
                    <strong><p>$<?php echo number_format($referral_bonus, 2); ?></p></strong>
                </div>
            </div>
        </div>

        <!-- Dashboard Buttons Section -->
        <div class="dashboard-buttons">
            <button onclick="location.href='deposit.php'"> <i class="bi bi-currency-exchange"></i>Deposit</button>
            <button onclick="location.href='withdrawal.php'">Withdraw<i class="bi bi-gem"></i></button>
            <button onclick="location.href='complain.php'">Complain <i class="bi bi-person-raised-hand"></i></button>
            <button onclick="location.href='loan.php'">Loan <i class="bi bi-"></i></button>
            <button onclick="location.href='referal.php'">Transfer</button>
        </div>

        <!-- Recent Transactions Section -->
        <div class="recent-transactions">
            <h2>Recent Transactions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_transactions as $transaction): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                            <td><?php echo htmlspecialchars($transaction['description']); ?></td>
                            <td>$<?php echo number_format($transaction['amount'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
     <!--    Testimonials Section 
        <div class="testimonials">
            <h2>Testimonials</h2>
            <div class="testimonial-carousel">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-item">
                       <img src="img/1.jpg" alt="john deo" class="testimonial-image">
                        <p class="testimonial-text">This platform is amazin</p>
                        <p class="testimonial-name">John Deo</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div> 

        <!-- Deposit and Withdrawal Messages Section -->
        <div class="deposit-withdrawal-messages">
            <?php foreach ($deposit_withdrawal_messages as $message): ?>
                <div class="message">
                    <?php echo htmlspecialchars($message['name']); ?> from <?php echo htmlspecialchars($message['country']); ?> has made a <?php echo htmlspecialchars($message['type']); ?> .
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Market Data Section -->
        <div class="market-data">
            <h2>Market Data</h2>
            <div id="crypto-prices"></div>
        </div>
        <a href="logout.php">Logout</a>
    </div>
    <!-- Referral Link Section -->
     <div class="refferal">
    <h1>Referral Program</h1>
        <p>Share your referral link with friends and earn rewards together!</p>
        <div class="mb-3">
            <label for="referralLink" class="form-label">Your Referral Link</label>
            <input type="text" class="form-control" id="referralLink" value="<?php echo htmlspecialchars($referral_link); ?>" readonly>
        </div>
        </div>
        <button class="btn btn-primary" onclick="copyToClipboard()">Copy Link</button>
    </div>

 <!-- TradingView Widget BEGIN -->
 <div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
  {
  "width": "100%",
  "height": 550,
  "defaultColumn": "overview",
  "screener_type": "crypto_mkt",
  "displayCurrency": "USD",
  "colorTheme": "dark",
  "locale": "en"
}
  </script>
</div>
<!-- TradingView Widget END -->
    
    <?php include 'includes/footer.php'; ?>
    <script src="js/scripts.js"></script>
    <script>

        
        // Function to show popup messages
        function showPopupMessage(message) {
            const popup = document.getElementById('messagePopup');
            popup.innerHTML = message;
            popup.classList.add('show');

            setTimeout(() => {
                popup.classList.remove('show'); // Hide after a delay
            }, 4000); // 4 seconds
        }

        document.addEventListener('DOMContentLoaded', function() {
            // ...

            // Deposit and Withdrawal Messages Script (Modified)
            const messages = <?php echo json_encode($deposit_withdrawal_messages); ?>; // Pass PHP array to JS
            let messageIndex = 0;

            function nextMessage() {
                if (messages.length > 0) { // Check if there are messages
                    const message = messages[messageIndex];
                    const amount = message.amount ? `$${message.amount}` : ''; // Display amount if available
                    const formattedMessage = `${message.name} from ${message.country} has made a ${message.type} of ${amount}.`;
                    showPopupMessage(formattedMessage);

                    messageIndex = (messageIndex + 1) % messages.length;
                }
            }

            // Show the first message immediately
            nextMessage();

            // Show subsequent messages every 4 seconds
            setInterval(nextMessage, 4000);

            // ...
        });

        function copyToClipboard() {
            var copyText = document.getElementById("referralLink");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
            alert("Referral link copied to clipboard!");
        }
        document.addEventListener('DOMContentLoaded', function() {
            fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,tron,litecoin&vs_currencies=usd')
                .then(response => response.json())
                .then(data => {
                    const pricesDiv = document.getElementById('crypto-prices');
                    pricesDiv.innerHTML = `
                        <p><strong>Bitcoin (BTC):</strong> $${data.bitcoin.usd}</p>
                        <p><strong>Ethereum (ETH):</strong> $${data.ethereum.usd}</p>
                        <p><strong>Tron (TRX):</strong> $${data.tron.usd}</p>
                        <p><strong>Litecoin (LTC):</strong> $${data.litecoin.usd}</p>
                    `;
                })
                .catch(error => console.error('Error fetching market data:', error));
        });

        // Testimonial Carousel Script
        document.addEventListener('DOMContentLoaded', function() {
            const testimonials = document.querySelectorAll('.testimonial-item');
            let currentIndex = 0;

            function showTestimonial(index) {
                testimonials.forEach((testimonial, i) => {
                    testimonial.style.display = i === index ? 'block' : 'none';
                });
            }

            function nextTestimonial() {
                currentIndex = (currentIndex + 1) % testimonials.length;
                showTestimonial(currentIndex);
            }

            // Initialize the first testimonial
            showTestimonial(currentIndex);

            // Change testimonial every 3 seconds
            setInterval(nextTestimonial, 3000);
        });

        // Deposit and Withdrawal Messages Script
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.deposit-withdrawal-messages .message');
            let messageIndex = 0;

            function showMessage(index) {
                messages.forEach((message, i) => {
                    message.style.display = i === index ? 'block' : 'none';
                });
            }

            function nextMessage() {
                messageIndex = (messageIndex + 1) % messages.length;
                showMessage(messageIndex);
            }

            // Initialize the first message
            showMessage(messageIndex);

            // Change message every 4 seconds
            setInterval(nextMessage, 4000);
        });

        // Profile Picture Update Script
        document.getElementById('profileImage').addEventListener('click', function() {
            document.getElementById('profilePictureInput').click();
        });

        document.getElementById('profilePictureInput').addEventListener('change', function() {
            var formData = new FormData(document.getElementById('profilePictureForm'));
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_profile_picture.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('profileImage').src = response.profile_picture;
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                } else {
                    alert('An error occurred while uploading the profile picture.');
                }
            };
            xhr.send(formData);
        });

        // Popup Message Script
        document.addEventListener('DOMContentLoaded', function() {
            var popupMessage = document.getElementById('popupMessage');
            if (popupMessage) {
                popupMessage.style.display = 'block';
                setTimeout(function() {
                    popupMessage.style.display = 'none';
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    </script>
 
</body>
</html>