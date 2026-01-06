<?php
session_start();

if ($_SESSION["isLoggedIn"] ?? false) {
    header("Location: dashboard.php");
    exit;
}

$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$signUpErr = $_SESSION["signUpErr"] ?? "";
$previousValues = $_SESSION["previousValues"] ?? [];

unset($_SESSION["emailErr"], $_SESSION["passwordErr"], $_SESSION["signUpErr"], $_SESSION["previousValues"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>

<h2>Signup</h2>

<form method="post" action="../Controller/handleSignupValidation.php">
    <label>Email</label><br>
    <input type="text" name="email" value="<?php echo $previousValues["email"] ?? ""; ?>">
    <div><?php echo $emailErr; ?></div><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <div><?php echo $passwordErr; ?></div><br>

    <div><?php echo $signUpErr; ?></div><br>

    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
