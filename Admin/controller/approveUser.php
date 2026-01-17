<?php
session_start();

if ($_SESSION["role"] !== "Admin") exit;

require_once '../../common/model/DatabaseConnection.php';

$id = $_GET["id"];

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("UPDATE user SET approval_status=1 WHERE user_id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: ../view/approve.php");
exit;
