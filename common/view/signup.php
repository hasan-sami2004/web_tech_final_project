<?php
session_start();

if ($_SESSION["isLoggedIn"] ?? false) {
    header("Location: dashboard.php");
    exit;
}

$emailErr = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$signUpErr = $_SESSION["signUpErr"] ?? "";
$signupMsg = $_SESSION["signupMsg"] ?? "";
$previousValues = $_SESSION["previousValues"] ?? [];

unset(
    $_SESSION["emailErr"],
    $_SESSION["passwordErr"],
    $_SESSION["signUpErr"],
    $_SESSION["previousValues"],
    $_SESSION["signupMsg"]
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h2>Signup</h2>

<?php if ($signupMsg): ?>
    <div class="success"><?php echo $signupMsg; ?></div>
<?php endif; ?>

<?php if ($signUpErr): ?>
    <div class="error"><?php echo $signUpErr; ?></div>
<?php endif; ?>

<form method="post" action="../Controller/handleSignupValidation.php">

    <label>Email</label><br>
    <input type="text" name="email"
           value="<?php echo htmlspecialchars($previousValues['email'] ?? ''); ?>">
    <div class="error"><?php echo $emailErr; ?></div><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <div class="error"><?php echo $passwordErr; ?></div><br>

    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
