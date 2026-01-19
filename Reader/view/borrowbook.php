<?php
require_once "../../common/model/DatabaseConnection.php";

$msg = "";

if (isset($_POST['borrow'])) {

    $book_id = $_POST['book_id'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

    

    $checkSql = "SELECT quantity FROM books WHERE id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        if ($row['quantity'] > 0) {

            

            $updateSql = "UPDATE books SET quantity = quantity - 1 WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $book_id);
            $updateStmt->execute();

            $msg = "✅ Book Borrowed Successfully";

        } else {
            $msg = "❌ Book Out Of Stock";
        }

    } else {
        $msg = "❌ Invalid Book ID";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrow Book</title>

  
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

    <h2>Borrow Book</h2>
    <p>Enter Book ID to borrow</p>

    
    <?php if($msg != ""): ?>
      <p><b><?php echo $msg; ?></b></p>
    <?php endif; ?>

    
    <div class="login-box">

      <form method="post">

        <input type="number" name="book_id" placeholder="Enter Book ID" required>

        <button type="submit" name="borrow">
          Borrow Book
        </button>

      </form>

    </div>

  </div>

</div>

</body>
</html>