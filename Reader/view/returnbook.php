<?php
require_once "../../common/model/DatabaseConnection.php";

$msg = "";

if (isset($_POST['return'])) {

    $book_id = $_POST['book_id'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    
    $checkSql = "SELECT * FROM borrowed_books WHERE book_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        
        $deleteSql = "DELETE FROM borrowed_books WHERE book_id = ? LIMIT 1";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $book_id);
        $deleteStmt->execute();

        
        $updateSql = "UPDATE books SET quantity = quantity + 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("i", $book_id);
        $updateStmt->execute();

        $msg = "✅ Book Returned Successfully";

    } else {
        $msg = "❌ This book was not borrowed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Return Book</title>

  
  <link rel="stylesheet" href="../../common/style.css">
</head>

<body>


<div class="top-nav">
  <div class="logo">
    📚 <b>WEBTECH LIBRARY</b>
  </div>
</div>


<div class="page-bg">

  <div style="padding:40px">

    <h2>Return Book</h2>
    <p>Enter Book ID to return</p>

   
    <?php if($msg): ?>
      <p><b><?php echo $msg; ?></b></p>
    <?php endif; ?>

    
    <div class="login-box">

      <form method="post">

        <input type="number" name="book_id" placeholder="Enter Book ID" required>

        <button type="submit" name="return">
          Return Book
        </button>

      </form>

    </div>

  </div>

</div>

</body>
</html>
