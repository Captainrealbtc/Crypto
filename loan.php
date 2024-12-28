<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $interest_rate = 5.0; // Set by admin, example value
    $term = 12; // Example term, can be adjusted as needed

    // Validate inputs
    if (is_numeric($amount)) {
        // Prepare the SQL statement
        $stmt = mysqli_prepare($conn, "INSERT INTO loans (user_id, amount, interest_rate, term) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "idii", $user_id, $amount, $interest_rate, $term);
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(['status' => 'success', 'message' => 'Loan application submitted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to submit loan application.']);
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
    }
    // Close the connection
    mysqli_close($conn);
}
?>


<!-- loan.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
    <style>
        /* Basic styling for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* Success message styling */
        .success-message {
            display: none;
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Loan Application</h1>
    <form id="loanForm" method="POST" action="loan.php">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required>
        <br>
        <label for="amount">Loan Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
        <br>
        <input type="button" value="Apply for Loan" onclick="showTerms()">
    </form>
    <div id="responseMessage" class="success-message"></div>

    <!-- Modal for Loan Terms -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeTerms()">&times;</span>
            <h2>Loan Terms</h2>
            <p>Here are the terms of the loan...</p>
            <button onclick="agreeTerms()">I Agree</button>
        </div>
    </div>

    <script>
    function showTerms() {
        document.getElementById('termsModal').style.display = 'block';
    }

    function closeTerms() {
        document.getElementById('termsModal').style.display = 'none';
    }

    function agreeTerms() {
        document.getElementById('termsModal').style.display = 'none';
        submitLoanForm();
    }

    function submitLoanForm() {
        const form = document.getElementById('loanForm');
        const formData = new FormData(form);

        fetch('loan.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const responseMessage = document.getElementById('responseMessage');
            if (data.status === 'success') {
                responseMessage.style.display = 'block';
                responseMessage.textContent = data.message;
                setTimeout(() => {
                    window.location.href = 'dashboard.php'; // Redirect to the user's dashboard
                }, 2000); // Wait for 2 seconds before redirecting
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>