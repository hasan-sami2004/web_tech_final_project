<?php
session_start();

/*
  
 Database add kora lagbe

*/
$demoUsers = [
    "admin@library.com" => "1234"
];

$email = $_REQUEST["email"] ?? "";
$password = $_REQUEST["password"] ?? "";

$errors = [];
$values = [];

// PHP Validation
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

    header("Location: ../View/login.php");
    exit;

} else {

    // TEMP LOGIN CHECK (REMOVE LATER)
    if (isset($demoUsers[$email]) && $demoUsers[$email] === $password) {

        $_SESSION["email"] = $email;
        $_SESSION["isLoggedIn"] = true;
        $_SESSION["role"] = "admin";

        header("Location: ../View/dashboard.php");
        exit;

    } else {
        $_SESSION["loginErr"] = "Invalid email or password";
        header("Location: ../View/login.php");
        exit;
    }
}
?>
