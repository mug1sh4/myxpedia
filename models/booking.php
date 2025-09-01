<?php
require_once 'db.php';

class Booking {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Create a new booking
    public function create($passengerID, $flightID, $seatID, $paymentID, $status) {
        $sql = "INSERT INTO Booking (PassengerID, FlightID, SeatID, PaymentID, Status)
                VALUES (:passengerID, :flightID, :seatID, :paymentID, :status)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':passengerID' => $passengerID,
            ':flightID' => $flightID,
            ':seatID' => $seatID,
            ':paymentID' => $paymentID,
            ':status' => $status
        ]);
    }

    // Read all bookings
    public function getAll() {
        $sql = "SELECT * FROM Booking";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read one booking by ID
    public function getById($id) {
        $sql = "SELECT * FROM Booking WHERE BookingID = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update booking details
    public function update($id, $passengerID, $flightID, $seatID, $paymentID, $status) {
        $sql = "UPDATE Booking SET 
                    PassengerID = :passengerID,
                    FlightID = :flightID,
                    SeatID = :seatID,
                    PaymentID = :paymentID,
                    Status = :status
                WHERE BookingID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':passengerID' => $passengerID,
            ':flightID' => $flightID,
            ':seatID' => $seatID,
            ':paymentID' => $paymentID,
            ':status' => $status
        ]);
    }

    // Delete a booking
    public function delete($id) {
        $sql = "DELETE FROM Booking WHERE BookingID = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
