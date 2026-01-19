<?php
session_start();
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Seller") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Search Book</title>
<link rel="stylesheet" href="../../common/style.css">
</head>
<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo"><b>🔍 Search Book</b></div>
  <a href="seller_dashboard.php" class="nav-btn dark">Back</a>
</nav>

<div style="padding:40px; max-width:500px; margin:auto;">

<div class="login-box">
<form method="get">
  <input type="text" name="search" placeholder="Enter Book Name">
  <button type="submit">Search</button>
</form>
</div>

</div>
</div>

</body>
</html>
