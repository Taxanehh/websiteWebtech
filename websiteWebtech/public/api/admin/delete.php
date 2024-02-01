<?php
require_once(__DIR__ . '/../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $id = $_POST['id'];

    // Validate input
    if (empty($id)) {
        echo "Please fill in all required fields.";
        exit();
    }

    try {
        $conn = Database::getConnection();
        $statement = $conn->prepare("SELECT * FROM Reservations");
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    $query = $conn->prepare("DELETE FROM Reservations WHERE id=$id");
    $query->execute();

    echo '<script>alert("The reservation with ID ' . $id . ' has been deleted.")</script>';
}
exit();