<?php session_start(); ?>
<form method="post" action="../controller/handleSignupValidation.php">
<input name="email" placeholder="Email"><br>
<input type="password" name="password" placeholder="Password"><br>
<select name="role">
<option value="">Role</option>
<option>Reader</option>
<option>Buyer</option>
<option>Seller</option>
<option>Admin</option>
</select><br>
<button>Signup</button>
<div><?=$_SESSION['signUpErr']??''?></div>
<div><?=$_SESSION['signupMsg']??''?></div>
</form>
<?php session_unset(); ?>
