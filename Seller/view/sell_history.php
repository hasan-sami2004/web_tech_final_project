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
<title>Sell History</title>
<link rel="stylesheet" href="../../common/style.css">
</head>
<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo"><b>🧾 Sell History</b></div>
  <a href="seller_dashboard.php" class="nav-btn dark">Back</a>
</nav>

<div style="padding:40px">

<div class="admin-grid">

<div class="admin-card">
  <h3>Total Books Sold</h3>
  <p><b>0</b></p>
</div>

<div class="admin-card">
  <h3>Total Earnings</h3>
  <p><b>৳ 0.00</b></p>
</div>

</div>

<br>

<div class="admin-card">
<table width="100%" cellpadding="12">
<tr>
  <th>Book Name</th>
  <th>Quantity</th>
  <th>Total Price</th>
</tr>
</table>
</div>

</div>
</div>

</body>
</html>
