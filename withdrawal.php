<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php'; 

// ... (Existing dashboard code) ...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... other head content ... -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
 <link rel="stylesheet" href="withdrawal.css">
 </head>
    <body>

    <nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand"  href="#">Prime Investment</a> <a src="img/logo.png">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">prime Invest</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Dashbaord</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deposit.php">Deposit</a>
          </li>
        <!--  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul> -->
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
                    <!-- Add more nav items as needed -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="dashbaord.php">Dashbaord</a></li>
                            <li><a class="dropdown-item" href="deposit.php">Deposit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="withdrawal-form">
    <h2>Withdrawal</h2>
    <form action="process_withdrawal.php" method="post">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
        </div>

        <div class="mb-3">
            <label for="withdrawal_method" class="form-label">Withdrawal Method:</label>
            <select class="form-control" id="withdrawal_method" name="withdrawal_method" required onchange="showWithdrawalDetails(this)">  <!-- Added onchange -->
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
                <option value="crypto">Cryptocurrency</option> <!-- Example -->
                <!-- Add other withdrawal methods as needed -->
            </select>
        </div>

        <!-- Withdrawal Details Sections (Initially hidden) -->
        <div id="paypal_details" style="display: none;">
            <label for="paypal_email" class="form-label">PayPal Email:</label>
            <input type="email" class="form-control" id="paypal_email" name="paypal_email">
        </div>

        <div id="bank_transfer_details" style="display: none;">
            <label for="bank_name" class="form-label">Bank Name:</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name">
            <label for="account_number" class="form-label">Account Number:</label>
            <input type="text" class="form-control" id="account_number" name="account_number">
            <!-- Add other bank details as needed -->
        </div>

        <div id="crypto_details" style="display: none;">
            <label for="crypto_address" class="form-label">Crypto Address:</label>
            <input type="text" class="form-control" id="crypto_address" name="crypto_address">
            <!-- Add other crypto details as needed -->
        </div>



        <button type="submit" class="btn btn-primary">Withdraw</button>
    </form>
</div>

<script>
    function showWithdrawalDetails(select) {
        // Hide all details sections
        document.getElementById('paypal_details').style.display = 'none';
        document.getElementById('bank_transfer_details').style.display = 'none';
        document.getElementById('crypto_details').style.display = 'none'; // Example

        // Show the selected details section
        var selectedMethod = select.value;
        var detailsSectionId = selectedMethod + '_details';
        if (document.getElementById(detailsSectionId)) {
            document.getElementById(detailsSectionId).style.display = 'block';
        }
    }
</script>
