<?php
session_start();

require_once '../../common/model/DatabaseConnection.php';

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (!$email || !$password) {
    $_SESSION["loginErr"] = "All fields required";
    header("Location: ../view/dashboard.php");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

/* DB TABLE: user | COLUMN: user */

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

/* PASSWORD VERIFY */

if (!password_verify($password, $row["password"])) {
    $_SESSION["loginErr"] = "Invalid Email or Password";
    header("Location: ../view/dashboard.php");
    exit;
}

/* ADMIN APPROVAL */

if ($row["role"] == "Admin" && $row["approval_status"] == 0) {
    $_SESSION["loginErr"] = "Admin Approval Pending";
    header("Location: ../view/dashboard.php");
    exit;
}

/* LOGIN SUCCESS */

$_SESSION["isLoggedIn"] = true;
$_SESSION["email"] = $row["user"];
$_SESSION["role"] = $row["role"];

/* REDIRECT */

if ($row["role"] == "Admin") {
    header("Location: ../../Admin/view/admin_dashboard.php");
    exit;
}

header("Location: ../view/dashboard.php");
exit;
