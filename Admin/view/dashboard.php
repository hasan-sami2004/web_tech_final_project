<?php
session_start();

if (!($_SESSION["isLoggedIn"] ?? false)) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["email"] ?? "User";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>
<p>Welcome, <?php echo $email; ?></p>

<ul>
    <li><a href="#">Profile</a></li>
    <li><a href="#">Manage Users</a></li>
    <li><a href="../Controller/logout.php">Logout</a></li>
</ul>

</body>
</html>
