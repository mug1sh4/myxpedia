<?php
require_once 'db.php';

class Users {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 🔍 Check if username exists
    public function checkUsername($username) {
        $stmt = $this->conn->prepare("CALL checkUsername(:username)");
        $stmt->execute([':username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); // important for stored procedures
        return $result;
    }

    // ➕ Save a new user
    public function saveUser($username, $firstname, $lastname, $passwordHash, $salt, $mobile, $email, $systemAdmin, $addedBy) {
        $stmt = $this->conn->prepare("CALL saveUser(:username, :firstname, :lastname, :passwordHash, :salt, :mobile, :email, :systemAdmin, :addedBy)");
        $success = $stmt->execute([
            ':username'     => $username,
            ':firstname'    => $firstname,
            ':lastname'     => $lastname,
            ':passwordHash' => $passwordHash,
            ':salt'         => $salt,
            ':mobile'       => $mobile,
            ':email'        => $email,
            ':systemAdmin'  => $systemAdmin,
            ':addedBy'      => $addedBy
        ]);
        $stmt->closeCursor();
        return $success;
    }

    // 📋 Get all users
    public function getUsers() {
        $stmt = $this->conn->query("CALL getAllUsers()");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    // 📌 Get details for a specific user
    public function getUserDetails($userID) {
        $stmt = $this->conn->prepare("CALL getUserDetails(:userID)");
        $stmt->execute([':userID' => $userID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    // ✏️ Update user (direct SQL for now)
    public function updateUser($userID, $firstname, $lastname, $mobile, $email, $accountActive, $status) {
        $sql = "UPDATE Users 
                SET FirstName = :firstname, LastName = :lastname, Mobile = :mobile, 
                    EmailAddress = :email, AccountActive = :accountActive, Status = :status
                WHERE UserID = :userID";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':firstname'     => $firstname,
            ':lastname'      => $lastname,
            ':mobile'        => $mobile,
            ':email'         => $email,
            ':accountActive' => $accountActive,
            ':status'        => $status,
            ':userID'        => $userID
        ]);
    }

    // 🗑️ Delete user
    public function deleteUser($userID) {
        $sql = "DELETE FROM Users WHERE UserID = :userID";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':userID' => $userID]);
    }
}
?>
