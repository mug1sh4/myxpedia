<?php
require_once 'db.php';

class City {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function cityExists($name, $countryID) {
    $sql = "SELECT COUNT(*) FROM City WHERE CityName = :name AND CountryID = :countryID";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':name' => $name, ':countryID' => $countryID]);
    return $stmt->fetchColumn() > 0;
}


    public function create($name, $countryID) {
        $sql = "INSERT INTO City (CityName, CountryID) VALUES (:name, :countryID)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':name' => $name, ':countryID' => $countryID]);
    }

    public function getAll() {
        $sql = "SELECT c.CityID, c.CityName, co.CountryName
                FROM City c
                JOIN Country co ON c.CountryID = co.CountryID";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT c.CityID, c.CityName, co.CountryName
                FROM City c
                JOIN Country co ON c.CountryID = co.CountryID
                WHERE c.CityID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $countryID) {
        $sql = "UPDATE City SET CityName = :name, CountryID = :countryID WHERE CityID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id, ':name' => $name, ':countryID' => $countryID]);
    }

    public function delete($id) {
        $sql = "DELETE FROM City WHERE CityID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
