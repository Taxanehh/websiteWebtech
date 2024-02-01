<?php
require_once(__DIR__ . '/../../../../private/classes/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $menu_id = $_POST['menu_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
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

    $query = $conn->prepare("INSERT INTO `menuitems`(`menu_id`, `name`, `description`, `price`) VALUES ('$menu_id','$name','$description','$price')");
    $query->execute();

    echo '<script>alert("The item with name ' . $name . ' has been created.")</script>';
}
exit();