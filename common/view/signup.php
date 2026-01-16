<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY</b></div>
</nav>

<div class="login-wrapper">

  <div class="login-box">

    <h2>Create Account</h2>

    <form action="../controller/handleSignupValidation.php" method="post">

      <input type="text" name="email" placeholder="Email" required>

      <input type="password" name="password" placeholder="Password" required>

      <select name="role" required>
        <option value="Reader">Reader</option>
        <option value="Seller">Seller</option>
        <option value="Admin">Admin</option>
      </select>

      <button type="submit">Sign Up</button>

    </form>

  </div>

</div>

</body>
</html>
