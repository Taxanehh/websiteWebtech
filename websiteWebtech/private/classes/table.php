<?php
require_once(__DIR__ . '/../../private/classes/database.php');

class Table
{
    public $id;
    public $location_id;
    public $max_seats;
    public $booked;

    public function __construct($id = null, $location_id = null, $max_seats = null, $booked = null)
    {
        $this->id = $id;
        $this->location_id = $location_id;
        $this->max_seats = $max_seats;
        $this->booked = $booked;
    }

    public function getTable($table_id): ?Table
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Tables where id = :table_id");
            $statement->bindParam(":table_id", $table_id);
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }

        return new Table($result['id'], $result['location_id'], $result['max_seats'], $result['booked']);
    }

    public function getAvailableTables($location_id): array
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Tables where location_id = :location_id and booked = 0");
            $statement->bindParam(":location_id", $location_id);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }

        $tables = array();
        foreach ($result as $row) {
            if ($row['booked'] == 0) {
                $tables[] = new Table($row['id'], $row['location_id'], $row['max_seats'], $row['booked']);
            }
        }

        return $tables;
    }

    public function getSeats($table_id): int
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select max_seats from Tables where id = :table_id");
            $statement->bindParam(":table_id", $table_id);
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }

        return $result['max_seats'];
    }
}
