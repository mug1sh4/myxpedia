<?php
require_once '../models/country.php';
$country = new Country();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode(isset($_GET['id']) ? $country->getById($_GET['id']) : $country->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $country->create($data['CountryName'])]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $country->update($data['CountryID'], $data['CountryName'])]);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $country->delete($data['CountryID'])]);
        break;
}
?>
