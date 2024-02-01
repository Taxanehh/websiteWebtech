<?php
require_once(__DIR__ . '/../../private/classes/database.php');

class Reservation
{
    public $id;
    public $user_id;
    public $table_id;
    public $start_time;
    public $end_time;

    public function __construct($id = null, $user_id = null, $table_id = null, $start_time = null, $end_time = null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->table_id = $table_id;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    public static function insert($user_id, $table_id, $start_time, $end_time): bool
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("insert into Reservations (user_id, table_id, start_time, end_time) values (:user_id, :table_id, :start_time, :end_time)");
            $statement->bindParam(":user_id", $user_id);
            $statement->bindParam(":table_id", $table_id);
            $statement->bindParam(":start_time", $start_time);
            $statement->bindParam(":end_time", $end_time);
            $statement->execute();

            $statement = $conn->prepare("update Tables set booked = 1 where id = :table_id");
            $statement->bindParam(":table_id", $table_id);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        return true;
    }

    public static function getReservations($user_id): array
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Reservations where user_id = :user_id");
            $statement->bindParam(":user_id", $user_id);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }

        $reservations = array();
        foreach ($result as $row) {
            $reservations[] = new Reservation($row['id'], $row['user_id'], $row['table_id'], $row['start_time'], $row['end_time']);
        }

        return $reservations;
    }

    public static function removeExpiredReservations(): bool
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("delete from Reservations where end_time < now()");
            $statement->execute();

            $statement = $conn->prepare("update Tables set booked = 0 where id not in (select table_id from Reservations)");
            $statement->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        return true;
    }
}