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

    if (isset($data['Name'], $data['Code'], $data['CityID'])) {
        $success = $airport->create(
            $data['Name'],
            $data['Code'],
            $data['CityID']
        );
        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['error' => 'Missing required fields']);
    }
}

// Handle PUT requests (Update)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['AirportID'], $data['Name'], $data['Code'], $data['CityID'])) {
        $success = $airport->update(
            $data['AirportID'],
            $data['Name'],
            $data['Code'],
            $data['CityID']
        );
        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['error' => 'Missing required fields']);
    }
}

// Handle DELETE requests
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['AirportID'])) {
        $success = $airport->delete($data['AirportID']);
        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['error' => 'Missing AirportID']);
    }
}
?>
