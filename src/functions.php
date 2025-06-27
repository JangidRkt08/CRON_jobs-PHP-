<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * 
 * 
 * 
 * Generate a 6-digit numeric verification code.
 */
function generateVerificationCode(): string {
    // TODO: Implement this function
    return rand(100000, 999999);
}

/**
 * Send a verification code to an email.
 */
function sendVerificationEmail(string $email, string $code): bool {
    // TODO: Implement this function


    $subject = "Your Verification Code";
    $message = "<p>To confirm un-subscription, use this code: <strong>$code</strong></p>";

    
    if (isset($_SESSION['email_message'])) {
        $message = str_replace('{code}', $code, $_SESSION['email_message']);
        unset($_SESSION['email_message']); 
    }
 
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: <no-reply@example.com>\r\n";

    return mail($email, $subject, $message, $headers);

}


/**
 * Register an email by storing it in a file.
 */
function registerEmail(string $email): bool {
  $file = __DIR__ . '/registered_emails.txt';
    // TODO: Implement this function
  
 $existingEmails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

 
    foreach ($existingEmails as $existing) {
        if (strcasecmp(trim($existing), trim($email)) == 0) {
            echo "Email already registered.<br>";
            return false;
        }
    }

       file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
    echo "Email registered successfully.<br>";
    return true;
}

/**
 * Unsubscribe an email by removing it from the list.
 */
function unsubscribeEmail(string $email): bool {
    $file = __DIR__ . '/registered_emails.txt';

    $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $originalCount = count($emails);

    $filteredEmails = [];
    foreach ($emails as $e) {
        if (trim(strtolower($e)) !== strtolower(trim($email))) {
            $filteredEmails[] = $e;
        }
    }

    file_put_contents($file, implode(PHP_EOL, $filteredEmails) . PHP_EOL);

    return count($filteredEmails) < $originalCount;
}

/**
 * Fetch random XKCD comic and format data as HTML.
 */
function fetchAndFormatXKCDData(): string {
    // TODO: Implement this function


     $randomId = rand(1, 3000);
    $url = "https://xkcd.com/$randomId/info.0.json";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    return "<h2>XKCD Comic</h2>
            <img src='{$data['img']}' alt='XKCD Comic'>
            <p><a href='#' id='unsubscribe-button'>Unsubscribe</a></p>";

}

/**
 * Send the formatted XKCD updates to registered emails.
 */
function sendXKCDUpdatesToSubscribers(): void {
  $file = __DIR__ . '/registered_emails.txt';
  // TODO: Implement this function

   $emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $content = fetchAndFormatXKCDData();
    $subject = "Your XKCD Comic";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: <no-reply@example.com>\r\n";
    foreach ($emails as $email) {
        mail($email, $subject, $content, $headers);
}

}

?>