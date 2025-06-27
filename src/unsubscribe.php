
<?php
session_start();
require_once 'functions.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($email === '') {
        $_SESSION['message'] = "<p>Please enter your email.</p>";
        exit;  
    }

    if (empty($_POST['verification_code'])) {
       
        $registeredEmails = file(__DIR__ . '/registered_emails.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!in_array($email, $registeredEmails)) {
            echo "<p>Error: This email is not registered.</p>";
        } else {
            $code = generateVerificationCode();
            $_SESSION['unsubscribe'][$email] = $code;
            sendVerificationEmail($email, $code);
            echo "<p>Check your email for the code.</p>";
        }

    } else {

        $inputCode = trim($_POST['verification_code']);
   
        if (isset($_SESSION['unsubscribe'][$email]) && $_SESSION['unsubscribe'][$email] === $inputCode) {
            $removed = unsubscribeEmail($email);
            if ($removed) {
                echo "<p><strong>$email</strong> unsubscribed successfully.</p>";
            } else {
                echo "<p>Sorry, email not found.</p>";
            }
            unset($_SESSION['unsubscribe'][$email]);  // remove code after use
        } else {
            echo "<p>Invalid code. Please try again.</p>";
        }
    }
} 
?>

<h2>Unsubscribe from XKCD Emails</h2>

<form method="POST">
    <input type="email" name="email" required placeholder="Enter your email">
    <button type="submit">Send Verification Code</button>
</form>

<br>

<form method="POST">
    
    <input type="email" name="email" required placeholder="Enter your email">
    <input type="text" name="verification_code" maxlength="6" required placeholder="Enter verification code">
    <button type="submit" id="submit-unsubscribe">Unsubscribe</button>
</form>

