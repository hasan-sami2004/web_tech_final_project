<?php
session_start();

$emailErr    = $_SESSION["emailErr"] ?? "";
$passwordErr = $_SESSION["passwordErr"] ?? "";
$roleErr     = $_SESSION["roleErr"] ?? "";
$signUpErr   = $_SESSION["signUpErr"] ?? "";
$signupMsg   = $_SESSION["signupMsg"] ?? "";
$previous    = $_SESSION["previousValues"] ?? [];

unset(
    $_SESSION["emailErr"],
    $_SESSION["passwordErr"],
    $_SESSION["roleErr"],
    $_SESSION["signUpErr"],
    $_SESSION["signupMsg"],
    $_SESSION["previousValues"]
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
    <div class="success"><?= $signupMsg ?></div>
<?php endif; ?>

<?php if ($signUpErr): ?>
    <div class="error"><?= $signUpErr ?></div>
<?php endif; ?>

<form method="post" action="../Controller/handleSignupValidation.php">

    <label>Email</label><br>
    <input type="text" name="email"
           value="<?= htmlspecialchars($previous["email"] ?? "") ?>">
    <div class="error"><?= $emailErr ?></div><br>

    <label>Password</label><br>
    <input type="password" name="password">
    <div class="error"><?= $passwordErr ?></div><br>

    <label>Role</label><br>
    <select name="role">
        <option value="">-- Select Role --</option>
        <?php
        $roles = ["Reader", "Buyer", "Seller", "Admin"];
        foreach ($roles as $r) {
            $selected = (($previous["role"] ?? "") === $r) ? "selected" : "";
            echo "<option value='$r' $selected>$r</option>";
        }
        ?>
    </select>
    <div class="error"><?= $roleErr ?></div><br>

    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
