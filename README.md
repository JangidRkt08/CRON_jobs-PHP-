📬 XKCD Email Subscription and Unsubscription System
A simple PHP-based project that allows users to subscribe to daily XKCD comic emails and unsubscribe using an email verification system.

🚀 Features
✅ Email registration with 6-digit OTP verification

✅ Daily XKCD comic delivery via CRON job

✅ Secure email unsubscription with verification code

✅ XKCD comic fetched randomly each day

✅ Plain file-based email storage (registered_emails.txt)

🛠️ Tech Stack
PHP 7+

HTML

CRON (Linux job scheduler)

📁 Project Structure
bash
Copy
Edit
├── functions.php              # Core functionality: send mail, register/unsubscribe, fetch XKCD
├── index.php                 # Email registration + verification
├── unsubscribe.php           # Email unsubscription + verification
├── registered_emails.txt     # Stores subscribed emails (plain text)
├── setup_cron.sh             # Script to setup CRON job for daily email
├── cron.php                  # (You should create this) Sends emails to all subscribers daily
📝 How It Works
🔐 1. Registering an Email
User submits email in index.php

Receives a 6-digit code on the given email

Enters the code to verify and get registered

Email is stored in registered_emails.txt

🧾 2. Daily XKCD Comic via CRON
A CRON job calls cron.php every 24 hours

Each registered email receives a random XKCD comic

❌ 3. Unsubscribe via unsubscribe.php
User enters email → gets verification code

Enters code to confirm unsubscription

Email is removed from registered_emails.txt

📦 Installation & Setup
1. Clone this repository
bash
Copy
Edit
git clone https://github.com/your-username/xkcd-emailer.git
cd xkcd-emailer
2. Set up CRON Job
Run the shell script to install a CRON job:

bash
Copy
Edit
chmod +x setup_cron.sh
./setup_cron.sh
This will run cron.php every day at midnight to send XKCD comics.

⚠️ Make sure cron.php exists and is correctly sending comics using sendXKCDUpdatesToSubscribers().

3. Setup PHP Mail
Ensure your PHP environment supports the mail() function. For development/testing:

On Linux, install and configure sendmail or postfix

On production, use SMTP or external mail APIs (like SendGrid or PHPMailer)

🔒 Security Notes
Email verification codes are stored in PHP sessions

Make sure your server uses HTTPS to protect user data

Add rate-limiting or CAPTCHA to avoid spamming

📌 To-Do
 Add logging system

 Store emails securely using a database

 Add UI/UX improvements and error displays

 Improve unsubscribe link support via tokens (e.g., one-click links)

🙋‍♂️ Author
Ravikant Jangid