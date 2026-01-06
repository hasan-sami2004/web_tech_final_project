<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$email    = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$errors = [];
$values = [];

// ---------- Validation ----------
if (!$email) {
    $errors["email"] = "Email is required";
}
if (!$password) {
    $errors["password"] = "Password is required";
}

if (!empty($errors)) {
    $_SESSION["emailErr"]    = $errors["email"] ?? "";
    $_SESSION["passwordErr"] = $errors["password"] ?? "";
    $values["email"] = $email;
    $_SESSION["previousValues"] = $values;

    header("Location: ../View/login.php");
    exit;
}

// ---------- DB ----------
$db   = new DatabaseConnection();
$conn = $db->openConnection();

// get user from database
$sql = "SELECT user_id, user, password, role, approval_status
        FROM user
        WHERE user = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION["loginErr"] = "Invalid email or password";
    header("Location: ../View/login.php");
    exit;
}

$row = $result->fetch_assoc();

// ---------- Password verify ----------
if (!password_verify($password, $row["password"])) {
    $_SESSION["loginErr"] = "Invalid email or password";
    header("Location: ../View/login.php");
    exit;
}

// ---------- Approval check ----------
if ($row["approval_status"] == 0) {
    $_SESSION["loginErr"] =
        "Your account is pending admin approval.";
    header("Location: ../View/login.php");
    exit;
}

// ---------- Login success ----------
$_SESSION["isLoggedIn"] = true;
$_SESSION["user_id"]   = $row["user_id"];
$_SESSION["email"]     = $row["user"];
$_SESSION["role"]      = $row["role"];

header("Location: ../View/dashboard.php");
exit;
