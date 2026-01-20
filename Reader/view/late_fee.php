<?php
require_once "../../common/model/DatabaseConnection.php";

$fee = "";
$perDayFine = 10; 

if (isset($_POST['check'])) {

    $book_id = $_POST['book_id'];

    $db = new DatabaseConnection();
    $conn = $db->openConnection();

   

    $sql = "SELECT borrow_date FROM borrowed_books WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $borrowDate = new DateTime($row['borrow_date']);
        $today = new DateTime();

        $days = $borrowDate->diff($today)->days;

        if ($days > 7) { 
            $lateDays = $days - 7;
            $fee = "Late Fee: " . ($lateDays * $perDayFine) . " Tk";
        } else {
            $fee = "✅ No Late Fee";
        }

    } else {
        $fee = "❌ Book not found in borrowed list";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Late Fee</title>

 
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

    <h2>Late Fee</h2>
    <p>Check fine for late return</p>

   
    <?php if($fee): ?>
      <p><b><?php echo $fee; ?></b></p>
    <?php endif; ?>

    
    <div class="login-box">

      <form method="post">

        <input type="number" name="book_id" placeholder="Enter Book ID" required>

        <button type="submit" name="check">
          Check Fee
        </button>

      </form>

    </div>

  </div>

</div>

</body>
</html>
