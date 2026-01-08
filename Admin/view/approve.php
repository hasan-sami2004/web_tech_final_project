<?php
require_once "../Model/DatabaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $conn->query(
    "SELECT user_id, user, role
     FROM user
     WHERE approval_status = 0"
);
?>

<h2>Pending Approvals</h2>

<table border="1">
<tr>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row["user"] ?></td>
    <td><?= $row["role"] ?></td>
    <td>
        <a href="../Controller/approveUser.php?id=<?= $row["user_id"] ?>">
            Approve
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
