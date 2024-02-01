<?php
session_start();
require_once(__DIR__ . '/../../../private/classes/user.php');
require_once(__DIR__ . '/../../../private/utils.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo "CSRF token validation failed.";
        exit();
    }

    // Collect data from form
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($firstName) || empty($lastName || empty($password))) {
        echo "Please fill in all required fields.";
        exit();
    }

    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    $firstName = test_input($firstName);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
        echo "Only letters and white space allowed";
        exit();
    }

    $lastName = test_input($lastName);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        echo "Only letters and white space allowed";
        exit();
    }

    $password = test_input($password);
    if (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,}$/", $password)) {
        echo "Password must contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character";
        exit();
    }

    // Create new user object
    $user = new User(
        null,
        null,
        null,
        null,
        null,
        null
    );

    // Attempt to register user
    $success = $user->register($email, $password, $firstName, $lastName);

    // Invalidate the CSRF token
    unset($_SESSION['csrf_token']);

    if (!$success) {
        echo 'Registration failed. Please try again.';
        exit();
    }

    // Registration successful, add user to session
    $_SESSION['user'] = serialize($success);

    // Redirect to dashboard
    header("Location: /dashboard.php");
} else {
    // Not a POST request, redirect to homepage
    header("Location: /");
}
exit();