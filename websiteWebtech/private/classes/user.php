<?php
require_once(__DIR__ . '/../../private/classes/database.php');

class User
{
    public $id;
    public $admin;
    public $email;
    public $password;
    public $firstName;
    public $lastName;

    public function __construct($id = null, $admin = null, $email = null, $password = null, $firstName = null, $lastName = null)
    {
        $this->id = $id;
        $this->admin = $admin;
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function login($email, $password)
    {
        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("select * from Users where email = :email");
            $statement->bindParam(":email", $email);
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        if (password_verify($password, $result['password'])) {
            return new User($result['id'], $result['admin'], $result['email'], $result['password'], $result['first_name'], $result['last_name'],);
        } else {
            return false;
        }
    }
    
    public static function register($email, $password, $firstName, $lastName)
    {
        $password_hash = password_hash($password, PASSWORD_ARGON2ID);

        try {
            $conn = Database::getConnection();
            $statement = $conn->prepare("insert into Users (email, password, first_name, last_name) values (:email, :password, :firstName, :lastName)");
            $statement->bindParam(":email", $email);
            $statement->bindParam(":password", $password_hash);
            $statement->bindParam(":firstName", $firstName);
            $statement->bindParam(":lastName", $lastName);
            $statement->execute();

            $statement = $conn->prepare("select * from Users where email = :email");
            $statement->bindParam(":email", $email);
            $statement->execute();
            $result = $statement->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }

        return new User($result['id'], $result['admin'], $result['email'], $result['password'], $result['first_name'], $result['last_name']);
    }
}