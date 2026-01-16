<?php
session_start();

/* SECURITY CHECK */

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

<!-- NAVBAR -->

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY - ADMIN PANEL</b></div>

  <div class="nav-links">
    <a href="../../common/controller/logout.php" class="nav-btn dark">Logout</a>
  </div>
</nav>

<!-- DASHBOARD CONTENT -->

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

  <div class="admin-card">
    <h3>👥 View Users</h3>
    <p>See all registered users</p>
  </div>

  <div class="admin-card">
    <h3>📚 Book List</h3>
    <p>View available books</p>
  </div>

  <div class="admin-card">
    <h3>✅ Admin Approval</h3>
    <p>Approve pending admins</p>
  </div>

</div>

</div>

</body>
</html>
