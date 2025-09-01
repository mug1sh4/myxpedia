<?php
require_once("db.php");

class Airline {
    private $conn;
    private $table = "airlines";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function checkAirline($airlinename) {
        $sql = "SELECT * FROM " . $this->table . " WHERE airlinename = :airlinename";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":airlinename", $airlinename);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveAirline($airlinename, $airlinelogo, $homecountryid) {
        $check = $this->checkAirline($airlinename);
        if (count($check) > 0) {
            return ["status" => "error", "message" => "The airline exists"];
        }

        // If you have a stored procedure sp_saveairline
        $sql = "CALL sp_saveairline(:airlinename, :airlinelogo, :homecountryid)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":airlinename", $airlinename);
        $stmt->bindParam(":airlinelogo", $airlinelogo);
        $stmt->bindParam(":homecountryid", $homecountryid);
        $stmt->execute();

        return ["status" => "success", "message" => "The airline was saved successfully"];
    }

    public function filterAirlines($airlinename, $countryname) {
        $sql = "SELECT * FROM " . $this->table . " 
                WHERE airlinename LIKE :airlinename 
                AND countryname LIKE :countryname";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":airlinename", "%$airlinename%");
        $stmt->bindValue(":countryname", "%$countryname%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAirlineDetails($airlineid) {
        $sql = "SELECT * FROM " . $this->table . " WHERE airlineid = :airlineid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":airlineid", $airlineid);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteAirline($airlineid) {
        $sql = "DELETE FROM " . $this->table . " WHERE airlineid = :airlineid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":airlineid", $airlineid);
        $stmt->execute();
        return ["status" => "success", "message" => "The airline was deleted successfully"];
    }
}
?>
