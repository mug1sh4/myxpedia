<?php
require_once 'db.php';

class Airport {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ✅ Create airport using CityID
    public function create($name, $code, $cityID) {
        $sql = "INSERT INTO Airport (Name, Code, CityID)
                VALUES (:name, :code, :cityID)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':code' => $code,
            ':cityID' => $cityID
        ]);
    }

    // ✅ Get all airports with city and country names
    public function getAll() {
        $sql = "SELECT 
                    a.AirportID,
                    a.Name AS AirportName,
                    a.Code,
                    c.CityName,
                    co.CountryName
                FROM Airport a
                JOIN City c ON a.CityID = c.CityID
                JOIN Country co ON c.CountryID = co.CountryID";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Get one airport with full location details
    public function getById($id) {
        $sql = "SELECT 
                    a.AirportID,
                    a.Name AS AirportName,
                    a.Code,
                    c.CityName,
                    co.CountryName
                FROM Airport a
                JOIN City c ON a.CityID = c.CityID
                JOIN Country co ON c.CountryID = co.CountryID
                WHERE a.AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Update airport details
    public function update($id, $name, $code, $cityID) {
        $sql = "UPDATE Airport SET 
                    Name = :name,
                    Code = :code,
                    CityID = :cityID
                WHERE AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':code' => $code,
            ':cityID' => $cityID
        ]);
    }

    // ✅ Delete airport
    public function delete($id) {
        $sql = "DELETE FROM Airport WHERE AirportID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
