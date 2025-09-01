<?php
require_once('../models/db.php');
require_once('../models/airline.php');

// ✅ Create DB connection
$database = new Database();
$db = $database->getConnection();

// ✅ Pass connection to model
$airline = new Airline($db);

// Save airline
if (isset($_POST['saveairline'])) {
    $airlinename = $_POST['airlinename'];
    $homecountryid = $_POST['homecountryid'];
    $logo = $_POST['logo'];

    $response = $airline->saveAirline($airlinename, $logo, $homecountryid);
    echo json_encode($response);
}

// Filter airlines
if (isset($_GET['filterairlines'])) {
    $airlinename = $_GET['airlinename'] ?? '';
    $countryname = $_GET['countryname'] ?? '';

    $response = $airline->filterAirlines($airlinename, $countryname);
    echo json_encode($response);
}

// Get airline details
if (isset($_GET['getairlinedetails'])) {
    $airlineid = $_GET['airlineid'];
    $response = $airline->getAirlineDetails($airlineid);
    echo json_encode($response);
}

// Delete airline
if (isset($_POST['deleteairline'])) {
    $airlineid = $_POST['airlineid'];
    $response = $airline->deleteAirline($airlineid);
    echo json_encode($response);
}
?>
