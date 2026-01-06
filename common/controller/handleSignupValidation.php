<?php
session_start();

require_once "../Model/DatabaseConnection.php";

$email = $_REQUEST["email"] ?? "";
$password = $_REQUEST["password"] ?? "";

$errors = [];
$values = [];

// ---------------- PHP Validation ----------------
if (!$email) {
    $errors["email"] = "Email is required";
}
if (!$password) {
    $errors["password"] = "Password is required";
}

if (count($errors) > 0) {

    $_SESSION["emailErr"] = $errors["email"] ?? "";
    $_SESSION["passwordErr"] = $errors["password"] ?? "";
    $values["email"] = $email;
    $_SESSION["previousValues"] = $values;

    header("Location: ../View/signup.php");
    exit;

} else {

    // ---------------- Database Insert ----------------
    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    // password hash (VERY IMPORTANT)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $role = "Reader"; // default role

    // check if user already exists
    $checkSql = "SELECT user_id FROM user WHERE user = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION["signUpErr"] = "User already exists";
        header("Location: ../View/signup.php");
        exit;
    }

    // insert new user
    $sql = "INSERT INTO user (user, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        $_SESSION["signupMsg"] = "Signup successful. Please login.";
        header("Location: ../View/login.php");
        exit;
    } else {
        $_SESSION["signUpErr"] = "Signup failed. Try again.";
        header("Location: ../View/signup.php");
        exit;
    }
}
?>
