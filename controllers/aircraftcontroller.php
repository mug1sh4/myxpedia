<?php
require_once '../models/aircraft.php';

$aircraft = new Aircraft();

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $result = $aircraft->getById($_GET['id']);
    } else {
        $result = $aircraft->getAll();
    }
    echo json_encode($result);
}

// Handle POST requests (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $aircraft->create(
        $data['Model'],
        $data['Capacity'],
        $data['Manufacturer']
    );
    echo json_encode(['success' => $success]);
}

// Handle PUT requests (Update)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $aircraft->update(
        $data['AircraftID'],
        $data['Model'],
        $data['Capacity'],
        $data['Manufacturer']
    );
    echo json_encode(['success' => $success]);
}

// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $aircraft->delete($data['AircraftID']);
    echo json_encode(['success' => $success]);
}
?>
