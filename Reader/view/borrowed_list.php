<?php
require_once "../../common/model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

/*
Assumed Table:
borrowed_books
-----------------
id
book_id
book_title
borrow_date
*/

$sql = "SELECT * FROM borrowed_books ORDER BY borrow_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrowed Books</title>

  <!-- Global Style -->
  <link rel="stylesheet" href="../../common/style.css">
</head>

<body>

<!-- ===== NAVBAR ===== -->
<div class="top-nav">
  <div class="logo">
    📚 <b>WEBTECH LIBRARY</b>
  </div>
</div>

<!-- ===== PAGE BG ===== -->
<div class="page-bg">
  <div style="padding:40px">

    <h2>Borrowed Books</h2>
    <p>Your borrowed book history</p>

    <div class="admin-card" style="overflow-x:auto">

      <table width="100%" cellpadding="10" cellspacing="0">
        <tr style="background:#f1f1f1">
          <th align="left">Book ID</th>
          <th align="left">Title</th>
          <th align="left">Borrow Date</th>
        </tr>

        <?php if($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['book_id']; ?></td>
              <td><?php echo $row['book_title']; ?></td>
              <td><?php echo $row['borrow_date']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="3">No borrowed books found</td>
          </tr>
        <?php endif; ?>

      </table>

    </div>

  </div>
</div>

</body>
</html>
