<?php
require_once 'db.php';

class Flight {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Create a new flight
    public function create($airlineID, $aircraftID, $departureID, $arrivalID, $departureTime, $arrivalTime) {
        $sql = "INSERT INTO Flight (AirlineID, AircraftID, DepartureID, ArrivalID, DepartureTime, ArrivalTime)
                VALUES (:airlineID, :aircraftID, :departureID, :arrivalID, :departureTime, :arrivalTime)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':airlineID' => $airlineID,
            ':aircraftID' => $aircraftID,
            ':departureID' => $departureID,
            ':arrivalID' => $arrivalID,
            ':departureTime' => $departureTime,
            ':arrivalTime' => $arrivalTime
        ]);
    }

    // Read all flights
    public function getAll() {
        $sql = "SELECT * FROM Flight";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one flight by ID
    public function getById($id) {
        $sql = "SELECT * FROM Flight WHERE FlightID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update flight details
    public function update($id, $airlineID, $aircraftID, $departureID, $arrivalID, $departureTime, $arrivalTime) {
        $sql = "UPDATE Flight SET 
                    AirlineID = :airlineID,
                    AircraftID = :aircraftID,
                    DepartureID = :departureID,
                    ArrivalID = :arrivalID,
                    DepartureTime = :departureTime,
                    ArrivalTime = :arrivalTime
                WHERE FlightID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':airlineID' => $airlineID,
            ':aircraftID' => $aircraftID,
            ':departureID' => $departureID,
            ':arrivalID' => $arrivalID,
            ':departureTime' => $departureTime,
            ':arrivalTime' => $arrivalTime
        ]);
    }

    // Delete a flight
    public function delete($id) {
        $sql = "DELETE FROM Flight WHERE FlightID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
