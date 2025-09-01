<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/xpedia/models/booking.php';

header('Content-Type: application/json');

$booking = new Booking();

// Parse incoming request
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $booking->getById($_GET['id']);
        } else {
            $result = $booking->getAll();
        }
        echo json_encode($result);
        break;

    case 'POST':
        if (
            isset($input['passengerID']) &&
            isset($input['flightID']) &&
            isset($input['seatID']) &&
            isset($input['paymentID']) &&
            isset($input['status'])
        ) {
            $success = $booking->create(
                $input['passengerID'],
                $input['flightID'],
                $input['seatID'],
                $input['paymentID'],
                $input['status']
            );
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'PUT':
        if (
            isset($_GET['id']) &&
            isset($input['passengerID']) &&
            isset($input['flightID']) &&
            isset($input['seatID']) &&
            isset($input['paymentID']) &&
            isset($input['status'])
        ) {
            $success = $booking->update(
                $_GET['id'],
                $input['passengerID'],
                $input['flightID'],
                $input['seatID'],
                $input['paymentID'],
                $input['status']
            );
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['error' => 'Missing required fields or ID']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $success = $booking->delete($_GET['id']);
            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['error' => 'Missing booking ID']);
        }
        break;

    default:
        echo json_encode(['error' => 'Unsupported request method']);
        break;
}
?>
