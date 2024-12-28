
<h1>Forgot Password</h1>
<form id="forgotPasswordForm">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <input type="button" value="Verify Email" onclick="verifyEmail()">
</form>

<div id="newPasswordSection" style="display:none;">
    <h2>Enter New Password</h2>
    <form id="updatePasswordForm">
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required>
        <br>
        <input type="button" value="Update Password" onclick="updatePassword()">
    </form>
</div>

<div id="responseMessage"></div>

<script>
function verifyEmail() {
    const email = document.getElementById('email').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'verify_email.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        const response = JSON.parse(this.responseText);
        document.getElementById('responseMessage').innerText = response.message;
        if (response.status === 'success') {
            document.getElementById('newPasswordSection').style.display = 'block';
        }
    };
    xhr.send('email=' + encodeURIComponent(email));
}

function updatePassword() {
    const email = document.getElementById('email').value;
    const newPassword = document.getElementById('newPassword').value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        const response = JSON.parse(this.responseText);
        document.getElementById('responseMessage').innerText = response.message;
        if (response.status === 'success') {
            document.getElementById('forgotPasswordForm').reset();
            document.getElementById('updatePasswordForm').reset();
            document.getElementById('newPasswordSection').style.display = 'none';
        }
    };
    xhr.send('email=' + encodeURIComponent(email) + '&new_password=' + encodeURIComponent(newPassword));
}
</script>