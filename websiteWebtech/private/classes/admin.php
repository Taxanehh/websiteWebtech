<?php
require_once(__DIR__ . '/../../private/classes/database.php');

class Admin
{
    public static function ReservationsTable()
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("SELECT * FROM Reservations");
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
        $query = $conn->prepare("SELECT * FROM Reservations");
        $query->execute();

        echo '<table style="border-spacing: 15px 15px; position: right;"><tr><th>id</th><th>user_id</th><th>table_id</th><th>start_time</th><th>end_time</th></tr>';
        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['user_id']) . "</td><td>" . htmlspecialchars($row['table_id']) . "</td><td>" . htmlspecialchars($row['start_time']) . "</td><td>" . htmlspecialchars($row['end_time']) . "</td><td>" . "</td></tr> ";
        }
        echo '</table>';
    }
}
?>
