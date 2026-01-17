<?php
session_start();

require_once '../../common/model/DatabaseConnection.php';

$email = $_REQUEST["email"] ?? "";


$password = $_REQUEST["password"] ?? "";

if (!$email || !$password) {
    $_SESSION["loginErr"] = "All fields required";
    header("Location: ../view/dashboard.php");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM user WHERE user = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows != 1) {
    $_SESSION["loginErr"] = "Invalid Email or Password";
    header("Location: ../view/dashboard.php");
    exit;
}

$row = $result->fetch_assoc();

if ($row['approval_status'] == -1) {
    $_SESSION["loginErr"] = "Account Disabled By Admin";
    header("Location: ../view/dashboard.php");
    exit;
}

if (!password_verify($password, $row["password"])) {
    $_SESSION["loginErr"] = "Invalid Email or Password";
    header("Location: ../view/dashboard.php");
    exit;
}

if ($row["role"] == "Admin" && $row["approval_status"] == 0) {
    $_SESSION["loginErr"] = "Admin Approval Pending";
    header("Location: ../view/dashboard.php");
    exit;
}

$_SESSION["isLoggedIn"] = true;
$_SESSION["email"] = $row["user"];
$_SESSION["role"] = $row["role"];

if ($row["role"] == "Admin") {
    header("Location: ../../Admin/view/admin_dashboard.php");
    exit;
}

header("Location: ../view/dashboard.php");
exit;
