<?php
require_once '../models/airport.php';

$airport = new Airport();

// Handle GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $result = $airport->getById($_GET['id']);
    } else {
        $result = $airport->getAll();
    }
    echo json_encode($result);
}

// Handle POST requests (Create)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $airport->create(
        $data['Name'],
        $data['City'],
        $data['Country'],
        $data['Code']
    );
    echo json_encode(['success' => $success]);
}

// Handle PUT requests (Update)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $airport->update(
        $data['AirportID'],
        $data['Name'],
        $data['City'],
        $data['Country'],
        $data['Code']
    );
    echo json_encode(['success' => $success]);
}

// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $airport->delete($data['AirportID']);
    echo json_encode(['success' => $success]);
}
?>
