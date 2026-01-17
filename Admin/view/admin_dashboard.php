<?php
session_start();


if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Admin") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}

$email = $_SESSION["email"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../../common/style.css">
</head>

<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY - ADMIN PANEL</b></div>

  <div class="nav-links">
    <a href="../../common/controller/logout.php" class="nav-btn dark">Logout</a>
  </div>
</nav>



<div style="padding:40px">

<h2>Welcome Admin</h2>
<p><?php echo $email; ?></p>

<div class="admin-grid">

  <div class="admin-card">
    <h3>🔍 Search Book</h3>
    <p>Search books from database</p>
  </div>

  <div class="admin-card">
    <h3>➕ Insert Book</h3>
    <p>Add new books</p>
  </div>

  <a href="user_list.php" class="admin-card">
    <h3>👥 View Users</h3>
    <p>See all registered users</p>
  </a>


  <div class="admin-card">
    <h3>📚 Book List</h3>
    <p>View available books</p>
  </div>

  <a href="approve.php" class="admin-card">
    <h3>✅ Admin Approval</h3>
    <p>Approve pending admins</p>
  </a>


</div>

</div>

</div>

</body>
</html>
