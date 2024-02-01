<?php
session_start();

require_once(__DIR__ . '/../../private/utils.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo "CSRF token validation failed.";
        exit();
    }

    // Collect data from form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input
    if (empty($firstName) || empty($lastName) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit();
    }

    $firstName = test_input($firstName);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
        echo "Only letters and white spaces allowed";
        exit();
    }

    $lastName = test_input($lastName);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        echo "Only letters and white spaces allowed";
        exit();
    }

    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    $message = test_input($message);

    // Send email
    $success = send_email($firstName, $lastName, $email, $message);

    // Invalidate the CSRF token
    unset($_SESSION['csrf_token']);

    if (!$success) {
        echo "Something went wrong. Please try again later.";
        exit();
    }

    // Alert user of successful form submission
    echo "Thank you for your message! We will get back to you as soon as possible.";
} else {
    // Not a POST request, redirect to homepage
    header("Location: /");
}
exit();

function send_email($firstName, $lastName, $email, $message)
{
    $to = "kimi@kimi.com";
    $subject = "Contact form submission";
    $txt = "First name: " . $firstName . "\n" . "Last name: " . $lastName . "\n" . "Email: " . $email . "\n" . "Message: " . $message;
    $headers = "From: " . $email . "\r\n" .
        "CC:";
    mail($to, $subject, $txt, $headers);
}