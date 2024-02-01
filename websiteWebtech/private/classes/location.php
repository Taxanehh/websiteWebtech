<?php
require_once(__DIR__ . '/../../private/classes/database.php');

class Location
{
    public $id;
    public $name;
    public $description;
    public $address;

    public function __construct($id = null, $name = null, $description = null, $address = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->address = $address;
    }

    public static function getAll(): array
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Locations");
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }

        $locations = array();
        foreach ($result as $row) {
            $locations[] = new Location($row['id'], $row['name'], $row['description'], $row['address']);
        }

        return $locations;
    }

    public static function getNearest($latitude, $longitude): ?Location
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Locations order by (latitude - :latitude) * (latitude - :latitude) + (longitude - :longitude) * (longitude - :longitude) asc limit 1");
            $statement->bindParam(":latitude", $latitude);
            $statement->bindParam(":longitude", $longitude);
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }

        return new Location($result['id'], $result['name'], $result['description'], $result['address']);
    }
}