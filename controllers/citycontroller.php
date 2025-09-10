<?php
require_once '../models/city.php';
$city = new City();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode(isset($_GET['id']) ? $city->getById($_GET['id']) : $city->getAll());
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) $data = $_POST;

        $cityName = $data['CityName'] ?? null;
        $countryID = $data['CountryID'] ?? null;

        if (!$cityName || !$countryID) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing CityName or CountryID']);
            break;
        }

        // Check for duplicates using model method
        if ($city->cityExists($cityName, $countryID)) {
            echo json_encode(['success' => false, 'error' => 'City already exists']);
            break;
        }

        $success = $city->create($cityName, $countryID);
        echo json_encode(['success' => $success]);
        break;

    case 'PUT':
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid or missing JSON payload']);
            break;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $success = $city->update($data['CityID'], $data['CityName'], $data['CountryID']);
        } else {
            $success = $city->delete($data['CityID']);
        }

        echo json_encode(['success' => $success]);
        break;
}
?>
