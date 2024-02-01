<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Set the session variable to indicate user's consent
    $_SESSION['cookie_consent'] = true;
} else {
// Not a POST request, redirect to homepage
    header("Location: /");
}
exit();
