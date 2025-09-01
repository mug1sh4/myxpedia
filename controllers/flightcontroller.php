<?php
require_once '../models/flight.php';

$flight = new Flight();

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $result = $flight->getById($_GET['id']);
    } else {
        $result = $flight->getAll();
    }
    echo json_encode($result);
}

// Handle POST requests (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $flight->create(
        $data['AirlineID'],
        $data['AircraftID'],
        $data['DepartureID'],
        $data['ArrivalID'],
        $data['DepartureTime'],
        $data['ArrivalTime']
    );
    echo json_encode(['success' => $success]);
}

// Handle PUT requests (Update)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $flight->update(
        $data['FlightID'],
        $data['AirlineID'],
        $data['AircraftID'],
        $data['DepartureID'],
        $data['ArrivalID'],
        $data['DepartureTime'],
        $data['ArrivalTime']
    );
    echo json_encode(['success' => $success]);
}

// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $flight->delete($data['FlightID']);
    echo json_encode(['success' => $success]);
}
?>
