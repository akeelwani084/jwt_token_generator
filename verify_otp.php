<?php
session_start();

if (!isset($_SESSION['otp']) || empty($_SESSION['otp'])) {
    echo "OTP session expired or not found. Please request a new OTP.";
    exit;
}

// Check if form is submitted for OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEnteredOTP = $_POST['otp'];
    $storedOTP = $_SESSION['otp'];
    $email = $_SESSION['email'];

    // Validate the entered OTP
    if ($userEnteredOTP == $storedOTP) {
        // OTP is valid, redirect to password reset form
        header("Location: reset_password_form.php?email=" . urlencode($email));
        exit;
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <div class="otp-container">
        <h2>Verify OTP</h2>
        <p>Enter the OTP sent to your email address.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-group">
                <label for="otp">OTP</label>
                <input type="text" id="otp" name="otp" required>
            </div>
            <button type="submit">Verify OTP</button>
        </form>
    </div>
</body>
</html>