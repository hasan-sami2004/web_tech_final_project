<?php
session_start();
require_once "../Model/DatabaseConnection.php";

$email    = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$role     = $_POST["role"] ?? "";

$errors = [];
$values = [];

// ---------- Validation ----------
if (!$email) {
    $errors["email"] = "Email is required";
}
if (!$password) {
    $errors["password"] = "Password is required";
}
if (!$role) {
    $errors["role"] = "Role is required";
}

if (!empty($errors)) {
    $_SESSION["emailErr"]    = $errors["email"] ?? "";
    $_SESSION["passwordErr"] = $errors["password"] ?? "";
    $_SESSION["roleErr"]     = $errors["role"] ?? "";

    $values["email"] = $email;
    $values["role"]  = $role;
    $_SESSION["previousValues"] = $values;

    header("Location: ../View/signup.php");
    exit;
}

// ---------- DB ----------
$db   = new DatabaseConnection();
$conn = $db->openConnection();

// check duplicate user
$check = $conn->prepare("SELECT user_id FROM user WHERE user = ?");
$check->bind_param("s", $email);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    $_SESSION["signUpErr"] = "User already exists";
    header("Location: ../View/signup.php");
    exit;
}

// ---------- Approval Logic ----------
$approval_status = 1; // default approved

if ($role === "Seller" || $role === "Admin") {
    $approval_status = 0; // needs approval
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO user (user, password, role, approval_status)
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("sssi", $email, $hashedPassword, $role, $approval_status);

if ($stmt->execute()) {
    if ($approval_status === 0) {
        $_SESSION["signupMsg"] =
            "Signup successful. Waiting for admin approval.";
    } else {
        $_SESSION["signupMsg"] =
            "Signup successful. Please login.";
    }
    header("Location: ../View/login.php");
    exit;
}

$_SESSION["signUpErr"] = "Signup failed";
header("Location: ../View/signup.php");
exit;
