<?php
session_start();

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

    header("Location: ../View/signup.php");
    exit;

} else {

    /*
      TEMP SIGNUP SUCCESS
      Later: INSERT into MySQL here
    */

    $_SESSION["signupMsg"] = "Signup successful. Please login.";
    header("Location: ../View/login.php");
    exit;
}
?>
