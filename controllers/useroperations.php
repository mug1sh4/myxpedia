<?php
header("Content-Type: application/json");
require_once '../models/users.php';

$users = new Users();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            $result = $users->getUserDetails($_GET['id']);
            echo json_encode($result);
        } else {
            $result = $users->getUsers();
            echo json_encode($result);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) $data = $_POST;

        $username    = $data['Username'] ?? null;
        $firstname   = $data['FirstName'] ?? null;
        $lastname    = $data['LastName'] ?? null;
        $password    = $data['Password'] ?? null; // plain password
        $mobile      = $data['Mobile'] ?? null;
        $email       = $data['EmailAddress'] ?? null;
        $systemAdmin = $data['SystemAdmin'] ?? false;
        $addedBy     = $data['AddedBy'] ?? null;

        if (!$username || !$password) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing Username or Password']);
            break;
        }

        // Generate salt + hash
        $salt = bin2hex(random_bytes(16));
        $passwordHash = password_hash($password . $salt, PASSWORD_BCRYPT);

        // Check if username exists
        $exists = $users->checkUsername($username);
        if ($exists && $exists['UserCount'] > 0) {
            echo json_encode(['success' => false, 'error' => 'Username already exists']);
            break;
        }

        $success = $users->saveUser(
            $username,
            $firstname,
            $lastname,
            $passwordHash,
            $salt,
            $mobile,
            $email,
            $systemAdmin,
            $addedBy
        );
        echo json_encode(['success' => $success]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Invalid or missing JSON payload']);
            break;
        }

        $success = $users->updateUser(
            $data['UserID'],
            $data['FirstName'],
            $data['LastName'],
            $data['Mobile'],
            $data['EmailAddress'],
            $data['AccountActive'],
            $data['Status']
        );

        echo json_encode(['success' => $success]);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !isset($data['UserID'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Missing UserID']);
            break;
        }

        $success = $users->deleteUser($data['UserID']);
        echo json_encode(['success' => $success]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'error' => 'Method not allowed']);
        break;
}
?>
