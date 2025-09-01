<?php
require_once 'db.php';

class Airport {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($name, $city, $country, $code) {
        $sql = "INSERT INTO Airport (Name, City, Country, Code)
                VALUES (:name, :city, :country, :code)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':city' => $city,
            ':country' => $country,
            ':code' => $code
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM Airport";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM Airport WHERE AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $city, $country, $code) {
        $sql = "UPDATE Airport SET 
                    Name = :name,
                    City = :city,
                    Country = :country,
                    Code = :code
                WHERE AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':city' => $city,
            ':country' => $country,
            ':code' => $code
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM Airport WHERE AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
