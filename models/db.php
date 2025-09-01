<?php
session_start();

class Database {
    private $servername;
    private $databasename;
    private $username;
    private $password;
    private $charset;
    private $conn; // Store the PDO connection

    // Constructor to initialize DB credentials
    public function __construct() {
        $this->servername = "localhost";
        $this->databasename = "flight_booking";
        $this->username = "root";
        $this->password = "";
        $this->charset = "utf8mb4";
        $this->connect(); // Initialize connection on object creation
    }

    // Connect to the database using PDO
    private function connect() {
        try {
            $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->databasename . ";charset=" . $this->charset;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // ✅ Expose the PDO connection to child classes
    public function getConnection() {
        return $this->conn;
    }

    // Execute a query and return the result set
    public function getData($sql) {
        return $this->conn->query($sql);
    }

    // Execute a query and return results as JSON
    public function getJSON($sql) {
        $rst = $this->getData($sql);
        return json_encode($rst->fetchAll(PDO::FETCH_ASSOC));
    }

    // Fetch a single row as an associative array
    public function getRow($sql) {
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // Execute a query that modifies data (INSERT, UPDATE, DELETE)
    public function setData($sql) {
        return $this->conn->exec($sql);
    }
}
?>
