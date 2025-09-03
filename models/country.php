<?php
require_once 'db.php';

class Country {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($name) {
        $sql = "INSERT INTO Country (CountryName) VALUES (:name)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':name' => $name]);
    }

    public function getAll() {
        $sql = "SELECT * FROM Country";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM Country WHERE CountryID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name) {
        $sql = "UPDATE Country SET CountryName = :name WHERE CountryID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id, ':name' => $name]);
    }

    public function delete($id) {
        $sql = "DELETE FROM Country WHERE CountryID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
