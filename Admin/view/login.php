<?php session_start(); ?>
<form method="post" action="../controller/handleLoginValidation.php">
<input name="email" placeholder="Email"><br>
<input type="password" name="password" placeholder="Password"><br>
<button>Login</button>
<div><?=$_SESSION['loginErr']??''?></div>
</form>
<a href="signup.php">Signup</a>
<?php session_unset(); ?>
