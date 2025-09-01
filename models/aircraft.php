<?php
require_once 'db.php';

class Aircraft {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function create($model, $capacity, $manufacturer) {
        $sql = "INSERT INTO Aircraft (Model, Capacity, Manufacturer)
                VALUES (:model, :capacity, :manufacturer)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':model' => $model,
            ':capacity' => $capacity,
            ':manufacturer' => $manufacturer
        ]);
    }

    public function getAll() {
        $sql = "SELECT * FROM Aircraft";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM Aircraft WHERE AircraftID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $model, $capacity, $manufacturer) {
        $sql = "UPDATE Aircraft SET 
                    Model = :model,
                    Capacity = :capacity,
                    Manufacturer = :manufacturer
                WHERE AircraftID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':model' => $model,
            ':capacity' => $capacity,
            ':manufacturer' => $manufacturer
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM Aircraft WHERE AircraftID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
