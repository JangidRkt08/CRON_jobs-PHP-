# 📬 XKCD Email Subscription System

A lightweight PHP application that allows users to **subscribe to daily XKCD comics**, receive them via email, and **unsubscribe securely** using a verification code system.

---

## 🚀 Features

- 🔐 Email registration with OTP verification (6-digit code)
- 📥 Daily XKCD comic delivery via CRON job
- ❌ Secure unsubscription flow with verification
- 📁 File-based email storage (no database required)
- 🧠 XKCD comic fetched randomly via their API

---

## 🗂️ Project Structure

.
├── functions.php # Core logic (mail, register, unsubscribe, XKCD fetch)
├── index.php # Email registration + OTP verification
├── unsubscribe.php # Secure unsubscribe flow
├── setup_cron.sh # Script to install daily CRON job
├── registered_emails.txt # List of registered emails
├── cron.php # (You need to create this) Sends XKCD to all subscribers


---

## ⚙️ How It Works

### 1️⃣ Register Email

- User submits email on `index.php`
- A 6-digit verification code is sent
- User verifies using the code → email gets saved in `registered_emails.txt`

### 2️⃣ Daily XKCD Delivery

- `cron.php` runs via CRON (set up using `setup_cron.sh`)
- A random XKCD comic is fetched using the public API
- The comic is sent as an HTML email to all registered users

### 3️⃣ Unsubscribe

- User submits email on `unsubscribe.php`
- Receives a 6-digit verification code
- If verified, the email is removed from `registered_emails.txt`

---

## 🧪 Setup & Usage

### 🔧 Requirements

- PHP 7.0+
- Linux shell access (for CRON setup)
- PHP `mail()` function configured

### 📥 Installation

```bash
git clone https://github.com/your-username/xkcd-emailer.git
cd xkcd-emailer


📩 Test Registration
Run index.php in your browser (using localhost or web server)

Enter your email → receive OTP

Enter OTP to register

## 📩 Test Registration

1. Open `index.php` in your browser (via `localhost` or on a web server).
2. Enter your email address.
3. You will receive a 6-digit OTP on your email.
4. Enter the OTP to complete registration.

---

## ⏰ Set up CRON for Daily Emails

Run the following commands once in your terminal:

```bash
chmod +x setup_cron.sh
./setup_cron.sh
