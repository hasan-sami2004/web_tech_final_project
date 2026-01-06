<?php
session_start();

if ($_SESSION["isLoggedIn"] ?? false) {
    header("Location: dashboard.php");
    exit;
}

$emailErr    = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$loginErr    = $_SESSION["loginErr"] ?? "";
$previous    = $_SESSION["previousValues"] ?? [];

unset(
    $_SESSION["emailErr"],
    $_SESSION["passwordErr"],
    $_SESSION["loginErr"],
    $_SESSION["previousValues"]
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h2>Login</h2>

<?php if ($loginErr): ?>
    <div class="error"><?= $loginErr ?></div>
<?php endif; ?>

<form method="post" action="../Controller/handleLoginValidation.php">

    <label>Email</label><br>
    <input type="text" name="email"
           value="<?= htmlspecialchars($previous["email"] ?? "") ?>">
    <div class="error"><?= $emailErr ?></div><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <div class="error"><?= $passwordErr ?></div><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="signup.php">Sign up</a></p>

</body>
</html>
