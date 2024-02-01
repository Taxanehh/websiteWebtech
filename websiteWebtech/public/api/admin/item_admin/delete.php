<?php
require_once(__DIR__ . '/../../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $id = $_POST['id'];

    try {
        $conn = Database::getConnection();
        $statement = $conn->prepare("SELECT * FROM menuitems");
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    $query = $conn->prepare("DELETE FROM menuitems WHERE id=$id");
    $query->execute();

    echo '<script>alert("The item with ID ' . $id . ' has been deleted.")</script>';
}
exit();