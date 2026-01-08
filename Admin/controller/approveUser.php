<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header("Location: ../view/login.php");
    exit;
}

require_once dirname(__DIR__) . '/model/DatabaseConnection.php';

$id = $_GET["id"] ?? 0;

if (!$id) {
    header("Location: ../view/approve.php");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare(
    "UPDATE user SET approval_status = 1 WHERE user_id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../view/approve.php");
exit;
