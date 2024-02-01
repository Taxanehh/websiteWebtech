<?php
session_start();
require_once(__DIR__ . '/../../../private/classes/table.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get data
    $table_id = $_GET['tableId'];

    // Get available seats
    $seats = Table::getSeats($table_id);
    
    // Return available seats as options.
    for ($i = 1; $i <= $seats; $i++) {
        echo "<option value='{$i}'>{$i}</option>";
    }
} else {
    // Not a GET request, redirect to homepage
    header("Location: /");
}
exit();
