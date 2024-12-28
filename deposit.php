<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit - Crypto Investment</title>
    <link rel="stylesheet" href="deposit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>

        /* CSS */
.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: #FF3D00;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}


    </style>
<body>
<div class="loader"></div>
   
   <nav class="navbar">

    <!-- HTML -->
    <div class="loader" id="loader" style="display: none;"></div>
    <nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
   
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">DEPOSIT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Others
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="loan.php">Loan</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="complains.php">Complains</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
    


    <div class="container mt-5">
    
        <h1>Deposit Plans</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" onclick="showPaymentModal('Starter Plan', 100)">
                    <div class="card-header">
                        <h2>Starter Plan</h2>
                    </div>
                    <div class="card-body">
                        <p>Minimum Deposit: $100</p>
                        <p>Maximum Deposit: $899</p>
                        <p>Interest Rate: 5% per day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" onclick="showPaymentModal('intermediate Plan', 200)">
                    <div class="card-header">
                        <h2>Intermediate Plan</h2>
                    </div>
                    <div class="card-body">
                        <p>Minimum Deposit: $200</p>
                        <p>Maximum Deposit: $999</p>
                        <p>Interest Rate: 6% per day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" onclick="showPaymentModal('Pro Plan', 1000)">
                    <div class="card-header">
                        <h2>Pro Plan</h2>
                    </div>
                    <div class="card-body">
                        <p>Minimum Deposit: $1000</p>
                        <p>Maximum Deposit: $4999</p>
                        <p>Interest Rate: 7% per day</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" onclick="showPaymentModal('Group Plan', 5000)">
                    <div class="card-header">
                        <h2>Group Plan</h2>
                    </div>
                    <div class="card-body">
                        <p>Minimum Deposit: $5000</p>
                        <p>Maximum Deposit: $10000</p>
                        <p>Interest Rate: 10% per day</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-3" onclick="showVerifyPaymentModal()">Verify Payment</button>
    </div>
    <div class="popup-message" id="popupMessage"></div>
    <!-- Payment Method Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm" action="process_deposit.php" method="post">
                        <input type="hidden" name="plan" id="selectedPlan">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Deposit Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-primary" onclick="showPaymentDetails('PayPal')">PayPal</button>
                                <button type="button" class="btn btn-outline-primary" onclick="showPaymentDetails('Crypto Wallet')">Crypto Wallet</button>
                                <button type="button" class="btn btn-outline-primary" onclick="showPaymentDetails('Bank Transfer')">Bank Transfer</button>
                                <button type="button" class="btn btn-outline-primary" onclick="showPaymentDetails('Western Union')">Western Union</button>
                                <button type="button" class="btn btn-outline-primary" onclick="showPaymentDetails('Bank Card')">Bank Card</button>
                            </div>
                        </div>
                        <input type="hidden" name="payment_method" id="selectedPaymentMethod">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment Details Modal -->
    <div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentDetailsModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="paymentDetailsText"></p>
                    <button type="button" class="btn btn-primary" onclick="copyToClipboard()">Copy to Clipboard</button>
                    <button type="button" class="btn btn-success" onclick="submitPaymentForm()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Verify Payment Modal -->
    <div class="modal fade" id="verifyPaymentModal" tabindex="-1" aria-labelledby="verifyPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyPaymentModalLabel">Verify Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="verifyPaymentForm" action="verify_payment.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="verificationImage" class="form-label">Upload Deposit Proof</label>
                            <input type="file" class="form-control" id="verificationImage" name="verification_image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        $(document).ready(function(){
            $('.navbar-toggle').click(function () {
                $('#navbar-collapse').toggleClass('in');
                
            });
            $('.dropdown-toggle').click(function() {
             $(this).next('.dropdown-menu').toggle();   
            });
        });

        document.addEventListener("DOMContentLoaded",function(){
            const navbarToggle =document.querySelector(".navbar-toggle");
            const navbarCollapse =document.querySelector("#navbar-collapse");

            navbarToggle.addEventListener("click",function() {
                navbarCollapse.classList.toggle("in");
            });
            const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

            dropdownToggles.forEach(function(dropdownToggle){
                dropdownToggle.addEventListener("click",function() {
                    const dropdownMenu =dropdownToggle.nextElementSibling;
                    dropdownMenu.classList,toggle("in");
                });
            });
        });

        function showPaymentModal(plan, amount) {
            document.getElementById('selectedPlan').value = plan;
            document.getElementById('amount').value = amount;
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        }

        function showPaymentDetails(method) {
            document.getElementById('selectedPaymentMethod').value = method;
            var detailsText = '';
            switch (method) {
                case 'PayPal':
                    detailsText = 'PayPal Email: example@paypal.com';
                    break;
                case 'Crypto Wallet':
                    detailsText = 'Tron Wallet Address: 1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa';
                    break;
                case 'Bank Transfer':
                    detailsText = 'Bank Account: 123456789, Bank: Example Bank, SWIFT: EXAMPBANK';
                    break;
                case 'Western Union':
                    detailsText = 'Western Union Details: Name: John Doe, Country: USA';
                    break;
                case 'Bank Card':
                    detailsText = 'Bank Card Details: Card Number: 4111 1111 1111 1111, Expiry: 12/23, CVV: 123';
                    break;
            }
            document.getElementById('paymentDetailsText').innerText = detailsText;
            var paymentDetailsModal = new bootstrap.Modal(document.getElementById('paymentDetailsModal'));
            paymentDetailsModal.show();
        }

        function copyToClipboard() {
            var text = document.getElementById('paymentDetailsText').innerText;
            navigator.clipboard.writeText(text).then(function() {
                alert('Copied to clipboard');
            }, function(err) {
                alert('Failed to copy: ', err);
            });
        }

        function submitPaymentForm() {
            var formData = new FormData(document.getElementById('paymentForm'));
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_deposit.php', true);
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                var popupMessage = document.getElementById('popupMessage');
                popupMessage.innerText = response.message;
                popupMessage.style.display = 'block';
                setTimeout(function() {
                    popupMessage.style.display = 'none';
                }, 3000);
                if (response.success) {
                    document.getElementById('paymentForm').reset();
                    var paymentDetailsModal = bootstrap.Modal.getInstance(document.getElementById('paymentDetailsModal'));
                    paymentDetailsModal.hide();
                }
            };
            xhr.send(formData);
        }

        function showVerifyPaymentModal() {
            var verifyPaymentModal = new bootstrap.Modal(document.getElementById('verifyPaymentModal'));
            verifyPaymentModal.show();
        }

        document.getElementById('verifyPaymentForm').addEventListener('verify', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'verify_payment.php', true);
            xhr.onload = function () {
                var response = JSON.parse(xhr.responseText);
                var popupMessage = document.getElementById('popupMessage');
                popupMessage.innerText = response.message;
                popupMessage.style.display = 'block';
                setTimeout(function() {
                    popupMessage.style.display = 'none';
                    if (response.success) {
                        window.location.href = 'dashboard.php';
                    }
                }, 3000);
            };
            xhr.send(formData);
        });

        function showLoader() {
    document.getElementById('loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('loader').style.display = 'none';
}

function showPaymentModal(plan, amount) {
    showLoader(); // Show loader when the button is clicked
    document.getElementById('selectedPlan').value = plan;
    document.getElementById('amount').value = amount;
    
    // Simulate a delay to show the loader (e.g., 2 seconds)
    setTimeout(function() {
        hideLoader(); // Hide loader after processing
        var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    }, 2000); // Adjust the delay as needed
}

function submitPaymentForm() {
    showLoader(); // Show loader when submitting the form
    var formData = new FormData(document.getElementById('paymentForm'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process_deposit.php', true);
    xhr.onload = function () {
        hideLoader(); // Hide loader after receiving response
        var response = JSON.parse(xhr.responseText);
        var popupMessage = document.getElementById('popupMessage');
        popupMessage.innerText = response.message;
        popupMessage.style.display = 'block';
        setTimeout(function() {
            popupMessage.style.display = 'none';
        }, 3000);
        if (response.success) {
            document.getElementById('paymentForm').reset();
            var paymentDetailsModal = bootstrap.Modal.getInstance(document.getElementById('paymentDetailsModal'));
            paymentDetailsModal.hide();
        }
    };
    xhr.send(formData);
}
    </script>
     <?php include 'includes/footer.php'; ?>
     
</body>
</html>