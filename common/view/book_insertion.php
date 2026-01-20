<?php
session_start();

if (
    !isset($_SESSION["isLoggedIn"]) ||
    ($_SESSION["role"] !== "Admin" && $_SESSION["role"] !== "Seller")
) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Insert Book</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY — INSERT BOOK</b></div>

  <div class="nav-links">

<?php if($_SESSION["role"]=="Admin"): ?>
<a href="../../Admin/view/admin_dashboard.php" class="nav-btn">Dashboard</a>
<?php else: ?>
<a href="../../Seller/view/seller_dashboard.php" class="nav-btn">Dashboard</a>
<?php endif; ?>

<a href="../controller/logout.php" class="nav-btn dark">Logout</a>

  </div>
</nav>

<div class="login-wrapper">

<div class="login-box">

<h2>Add New Book</h2>

<form method="POST" action="/web_tech_final_project/common/controller/book_insertion.php">

  <input type="text" name="title" placeholder="Book Title" required>

  <input type="text" name="author" placeholder="Author Name" required>

  <input type="number" step="0.01" name="price" placeholder="Price" required>

  <input type="number" name="quantity" placeholder="Quantity" required>

  <button type="submit" name="add_book">Add Book</button>

</form>

</div>

</div>

</div>

</body>
</html>
