<?php
session_start();

require_once(__DIR__ . '/../../private/utils.php');
require_once(__DIR__ . '/../../private/classes/user.php');
require_once(__DIR__ . '/../../private/classes/table.php');
require_once(__DIR__ . '/../../private/classes/reservation.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo "CSRF token validation failed.";
        exit();
    }

    // Collect data from form
    $location = $_POST['location'];
    $startTime = $_POST['startTime'];
    $peopleAmount = $_POST['peopleAmount'];
    $table = $_POST['table'];

    // Validate input
    if (empty($location) || empty($startTime) || empty($peopleAmount) || empty($table)) {
        echo "Please fill in all required fields.";
        exit();
    }

    $location = test_input($location);
    $peopleAmount = test_input($peopleAmount);
    $table = test_input($table);

    $startTime = test_input($startTime);
    if (!preg_match("/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/", $startTime)) {
        echo "Invalid time format";
        exit();
    }
    // Get today's date
    $todayDate = date("Y-m-d");

    // Convert startTime to datetime
    $startTime = date("Y-m-d H:i:s", strtotime($todayDate . " " . $startTime));
    // End time is 2 hours after start time
    $endTime = date("Y-m-d H:i:s", strtotime($startTime . " +2 hours"));

    // Check if table is available
    $dbTable = Table::getTable($table);
    if ($dbTable === null) {
        echo "Table not found.";
        exit();
    }

    // Check if table is already booked
    if ($dbTable->booked == 1) {
        echo "Table is already booked.";
        exit();
    }

    // Check if table is big enough
    if ($dbTable->max_seats < $peopleAmount) {
        echo "Table is not big enough.";
        exit();
    }

    // Create new user object
    $user = new User();

    // Get user id from session
    $user = unserialize($_SESSION['user']);
    $user_id = $user->id;

    // Insert reservation into database
    $success = Reservation::insert($user_id, $table, $startTime, $endTime);

    // Invalidate the CSRF token
    unset($_SESSION['csrf_token']);

    if (!$success) {
        echo "Something went wrong. Please try again later.";
        exit();
    }

    // Alert user of successful form submission
    header("Location: /dashboard.php?reservation=success");
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