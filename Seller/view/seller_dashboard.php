<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Seller") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}

$sellerId = $_SESSION["seller_id"] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
<title>Seller Dashboard</title>
<link rel="stylesheet" href="../../common/style.css">
</head>

<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY — SELLER PANEL</b></div>

  <div class="nav-links">
    <a href="../../common/controller/logout.php" class="nav-btn dark">Logout</a>
  </div>
</nav>

<div style="padding:40px">

<h2>Welcome Seller</h2>
<p>Seller ID: <?php echo $sellerId; ?></p>

<div class="admin-grid">

  <a href="../../common/view/book_insertion.php" class="admin-card">
    <h3>➕ Insert Book</h3>
    <p>Add new books to store</p>
  </a>

  <a href="update_book.php" class="admin-card">
    <h3>✏️ Update Book</h3>
    <p>Update price and quantity</p>
  </a>

  <a href="../../common/view/book_list.php" class="admin-card">
    <h3>📚 Book List</h3>
    <p>View all available books</p>
  </a>

  <a href="../../common/view/search_book.php" class="admin-card">
    <h3>🔍 Search Book</h3>
    <p>Find books quickly</p>
  </a>

  <a href="sell_history.php" class="admin-card">
    <h3>🧾 Sell History</h3>
    <p>View sold books and earnings</p>
  </a>

</div>

</div>

</div>

</body>
</html>
