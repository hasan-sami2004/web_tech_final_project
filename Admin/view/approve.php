<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Admin") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}

require_once '../../common/model/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $conn->query(
    "SELECT * FROM user WHERE role='Admin' AND approval_status=0"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Approval</title>
<link rel="stylesheet" href="../../common/style.css">
</head>

<body>

<div class="page-bg">

<h2>Pending Admin Requests</h2>

<table border="1" cellpadding="10">

<tr>
  <th>ID</th>
  <th>Email</th>
  <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td>

<a href="../controller/approveUser.php?id=<?php echo $row['user_id']; ?>">
  ✅ Approve
</a>

&nbsp; | &nbsp;

<a href="../controller/rejectUser.php?id=<?php echo $row['user_id']; ?>"
   onclick="return confirm('Are you sure you want to reject this admin?')">
  ❌ Reject
</a>

</td>

Approve
</a>
</td>
</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>
