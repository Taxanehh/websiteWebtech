<?php
require_once(__DIR__ . '/../../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $id = $_POST['id'];
    $menu_id = $_POST['menu_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    try {
        $conn = Database::getConnection();
        $statement = $conn->prepare("SELECT * FROM menuitems");
        $statement->execute();
        $result = $statement->fetch();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }

    $query = $conn->prepare("UPDATE `menuitems` SET `menu_id`='$menu_id',`name`='$name',`price`='$price' WHERE id=$id");
    $query->execute();

    echo '<script>alert("The reservation with ID ' . $id . ' has been edited.")</script>';
}
exit();