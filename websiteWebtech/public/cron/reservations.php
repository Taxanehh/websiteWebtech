<?php
require_once(__DIR__ . '/../../private/classes/reservation.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Remove expired reservations
    Reservation::removeExpiredReservations();

    echo "Expired reservations removed.";
} else {
    // Not a GET request, redirect to homepage
    header("Location: /");
}