<?php
session_start();

require_once '../../common/model/DatabaseConnection.php';

$email = $_POST["email"] ?? "";

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/signup.php");
    exit;
}

$password = $_POST["password"] ?? "";
$role = $_POST["role"] ?? "Reader";

if (!$email || !$password) {
    header("Location: ../view/signup.php");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$approval = 1;

if ($role == "Admin") {
    $approval = 0;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "INSERT INTO user (user, password, role, approval_status) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $email, $hash, $role, $approval);
$stmt->execute();

header("Location: ../view/dashboard.php");
exit;
