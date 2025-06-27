<?php
session_start();
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['email']) && !isset($_POST['verification_code'])) {
        $email = trim($_POST['email']);
        $code = generateVerificationCode();

        $_SESSION[$email] = $code; 
        $_SESSION['email_message'] = "<p>Your verification code is: <strong>$code</strong></p>";
        sendVerificationEmail($email, $code);

        echo "<p>Verification code sent to $email</p>";
    }

 if (isset($_POST['verification_code'], $_POST['email'])) {
        $email = trim($_POST['email']);
        $code = trim($_POST['verification_code']);

        if (isset($_SESSION[$email]) && $_SESSION[$email] === $code) {
            unset($_SESSION[$email]);
            registerEmail($email);
            echo "<p>Email verified and registered!</p>";
        } else {
            echo "<p>Invalid code.</p>";
        }
    }
}
?>


<h2>Register Email</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <button id="submit-email">Submit</button>
</form>

<h2>Enter Verification Code</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="verification_code" maxlength="6" placeholder="Verification Code" required>
    <button id="submit-verification">Verify</button>
</form>
