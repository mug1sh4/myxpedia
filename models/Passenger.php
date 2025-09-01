<?php
require_once 'db.php';

class Passenger {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Create a new passenger
    public function create($firstname, $lastname, $email, $phonenumber, $passportnumber) {
        $sql = "INSERT INTO Passenger (FirstName, LastName, Email, PhoneNumber, PassportNumber)
                VALUES (:firstname, :lastname, :email, :phonenumber, :passportnumber)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':phonenumber' => $phonenumber,
            ':passportnumber' => $passportnumber
        ]);
    }

    // Read all passengers
    public function getAll() {
        $sql = "SELECT * FROM Passenger";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one passenger by ID
    public function getById($id) {
        $sql = "SELECT * FROM Passenger WHERE PassengerID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update passenger details
    public function update($id, $firstname, $lastname, $email, $phonenumber, $passportnumber) {
        $sql = "UPDATE Passenger SET 
                    FirstName = :firstname,
                    LastName = :lastname,
                    Email = :email,
                    PhoneNumber = :phonenumber,
                    PassportNumber = :passportnumber
                WHERE PassengerID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':phonenumber' => $phonenumber,
            ':passportnumber' => $passportnumber
        ]);
    }

    // Delete a passenger
    public function delete($id) {
        $sql = "DELETE FROM Passenger WHERE PassengerID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
