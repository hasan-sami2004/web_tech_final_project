<?php
session_start();

$error = $_SESSION["loginErr"] ?? "";
unset($_SESSION["loginErr"]);
?>

<!DOCTYPE html>
<html>
<head>
<title>WebTech Library</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<nav class="top-nav">
  <div class="logo">📚 <b>WEBTECH LIBRARY</b></div>
  <div class="nav-links">
    <a href="signup.php" class="nav-btn dark">Sign Up</a>
  </div>
</nav>

<div class="login-wrapper">

  <div class="login-box">

    <h2>Login</h2>

    <?php if($error): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="../controller/handleLoginValidation.php" method="post" onsubmit="return validateLogin()">

  <input type="text" id="loginEmail" name="email" placeholder="Email" required>

  <input type="password" id="loginPassword" name="password" placeholder="Password" required>

  <button type="submit">Login</button>

  </form>


<p class="signup-text">
  Don't have an account?
  <a href="signup.php">Sign up</a>
</p>

  </div>

</div>

<script>

function validateLogin(){

  let email = document.getElementById("loginEmail").value.trim();
  let password = document.getElementById("loginPassword").value.trim();

  if(email === ""){
    alert("Email is required");
    return false;
  }

  if(password === ""){
    alert("Password is required");
    return false;
  }

  return true;
}

</script>

</body>
</html>
