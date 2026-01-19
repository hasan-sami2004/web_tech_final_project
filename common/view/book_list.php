<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once __DIR__ . "/../controller/bookListController.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Book List</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY — BOOK LIST</b></div>

  <div class="nav-links">

<?php if(isset($_SESSION["role"])): ?>

<?php if($_SESSION["role"]=="Admin"): ?>
<a href="../../Admin/view/admin_dashboard.php" class="nav-btn">Dashboard</a>

<?php elseif($_SESSION["role"]=="Seller"): ?>
<a href="../../Seller/view/seller_dashboard.php" class="nav-btn">Dashboard</a>

<?php elseif($_SESSION["role"]=="Buyer"): ?>
<a href="../../Buyer/view/buyer_dashboard.php" class="nav-btn">Dashboard</a>

<?php elseif($_SESSION["role"]=="Reader"): ?>
<a href="../../Reader/view/reader_dashboard.php" class="nav-btn">Dashboard</a>
<?php endif; ?>

<a href="../controller/logout.php" class="nav-btn dark">Logout</a>

<?php endif; ?>

  </div>
</nav>

<div style="padding:40px">

<div class="admin-card">

<table width="100%" cellpadding="12">
<tr>
  <th>ID</th>
  <th>Title</th>
  <th>Author</th>
  <th>Price</th>
  <th>Quantity</th>
</tr>

<?php while($row = $books->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($row["id"]) ?></td>
  <td><?= htmlspecialchars($row["title"]) ?></td>
  <td><?= htmlspecialchars($row["author"]) ?></td>
  <td><?= htmlspecialchars($row["price"]) ?></td>
  <td><?= htmlspecialchars($row["quantity"]) ?></td>
</tr>
<?php endwhile; ?>

</table>

</div>

</div>

</div>

</body>
</html>

