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
<title>Update Book</title>
<link rel="stylesheet" href="../../common/style.css">
</head>
<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo"><b>✏️ Update Book</b></div>
  <a href="seller_dashboard.php" class="nav-btn dark">Back</a>
</nav>

<div style="padding:40px; max-width:500px; margin:auto;">

<div class="login-box">
<form method="post">
  <input type="text" name="book_name" placeholder="Book Name" required>
  <input type="number" name="price" placeholder="New Price">
  <input type="number" name="quantity" placeholder="New Quantity">
  <button type="submit">Update Book</button>
</form>
</div>

</div>
</div>

</body>
</html>
