<?php
require_once(__DIR__ . '/../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $id = $_POST['id'];

    try {
        $conn = Database::getConnection();
        $statement = $conn->prepare("SELECT * FROM Reservations");
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    $query = $conn->prepare("SELECT table_id FROM Reservations WHERE id=$id");
    $tableid = $query->execute();
    
    $query = $conn->prepare("UPDATE tables SET booked = '0' WHERE id=$tableid");
    $query->execute();

    $query = $conn->prepare("DELETE FROM Reservations WHERE id=$id");
    $query->execute();

    echo '<script>alert("The reservation with ID ' . $id . ' has been deleted.")</script>';
}
exit();