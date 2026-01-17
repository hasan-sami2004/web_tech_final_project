<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Admin") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}

require_once '../../common/model/DatabaseConnection.php';

$id = $_GET['id'] ?? 0;
$status = $_GET['status'] ?? 0;

if(!$id){
    header("Location: ../view/user_list.php");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare("UPDATE user SET approval_status=? WHERE user_id=?");
$stmt->bind_param("ii",$status,$id);
$stmt->execute();

header("Location: ../view/user_list.php");
exit;
