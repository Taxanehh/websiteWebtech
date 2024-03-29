<?php
require_once(__DIR__ . '/../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $id = $_POST['id'];
    $table_id = $_POST['table_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    try {
        $conn = Database::getConnection();
        $statement = $conn->prepare("SELECT * FROM Reservations");
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    $query = $conn->prepare("SELECT table_id FROM reservations WHERE id=$id");
    $tableid = $query->execute();

    $query = $conn->prepare("UPDATE `tables` SET booked = '0' WHERE id=$tableid");
    $query->execute();

    $query = $conn->prepare("UPDATE `reservations` SET `table_id`='$table_id',`start_time`='$start_time',`end_time`='$end_time' WHERE id=$id");
    $query->execute();

    $query = $conn->prepare("UPDATE `tables` SET booked = '1' WHERE id=$table_id");
    $query->execute();

    echo '<script>alert("The reservation with ID ' . $id . ' has been edited.")</script>';
}
exit();