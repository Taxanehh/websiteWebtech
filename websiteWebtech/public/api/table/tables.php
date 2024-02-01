<?php
require_once(__DIR__ . '/../../../private/classes/table.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get data
    $location_id = $_GET['locationId'];

    // Get available tables
    $tables = Table::getAvailableTables($location_id);

    // Return available tables as options
    foreach ($tables as $table) {
        echo "<option value='{$table->id}'>{$table->id}</option>";
    }
} else {
    // Not a GET request, redirect to homepage
    header("Location: /");
}
exit();
