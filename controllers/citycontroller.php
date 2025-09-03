<?php
require_once '../models/city.php';
$city = new City();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode(isset($_GET['id']) ? $city->getById($_GET['id']) : $city->getAll());
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $city->create($data['CityName'], $data['CountryID'])]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $city->update($data['CityID'], $data['CityName'], $data['CountryID'])]);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(['success' => $city->delete($data['CityID'])]);
        break;
}
?>
