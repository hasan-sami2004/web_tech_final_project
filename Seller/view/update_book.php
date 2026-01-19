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
<title>Update Book</title>
<link rel="stylesheet" href="../../common/style.css">
</head>
<body>

<h2>✏️ Update Book</h2>

<form method="post">
    <input type="text" name="book_id" placeholder="Book ID" required><br><br>
    <input type="number" name="price" placeholder="New Price"><br><br>
    <input type="number" name="quantity" placeholder="New Quantity"><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>
