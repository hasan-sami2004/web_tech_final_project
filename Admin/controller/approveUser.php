<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") exit;

require_once '../../common/model/DatabaseConnection.php';

if (!isset($_GET["id"])) exit;

$id = (int) $_GET["id"]; // Type cast (extra safety)

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare(
  "UPDATE user SET approval_status=1 WHERE user_id=?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../view/approve.php");
exit;
