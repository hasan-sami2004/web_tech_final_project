<?php
session_start();

if ($_SESSION["isLoggedIn"] ?? false) {
    header("Location: dashboard.php");
    exit;
}

$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$loginErr = $_SESSION["loginErr"] ?? "";
$previousValues = $_SESSION["previousValues"] ?? [];

unset($_SESSION["emailErr"], $_SESSION["passwordErr"], $_SESSION["loginErr"], $_SESSION["previousValues"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="post" action="../Controller/handleLoginValidation.php">
    <label>Email</label><br>
    <input type="text" name="email" value="<?php echo $previousValues["email"] ?? ""; ?>">
    <div><?php echo $emailErr; ?></div><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <div><?php echo $passwordErr; ?></div><br>

    <div><?php echo $loginErr; ?></div><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="signup.php">Sign up</a></p>

</body>
</html>
