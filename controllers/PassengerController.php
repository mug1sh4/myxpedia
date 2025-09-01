<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/xpedia/models/Passenger.php';


$passenger = new Passenger();

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $passenger->getById($_GET['id']);
        } else {
            $result = $passenger->getAll();
        }
        echo json_encode($result);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $success = $passenger->create(
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['phonenumber'],
            $data['passportnumber']
        );
        echo json_encode(['success' => $success]);
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        $success = $passenger->update(
            $data['id'],
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['phonenumber'],
            $data['passportnumber']
        );
        echo json_encode(['success' => $success]);
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        $success = $passenger->delete($data['id']);
        echo json_encode(['success' => $success]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
?>
