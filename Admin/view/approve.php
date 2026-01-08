<?php
session_start();
if(!isset($_SESSION['isLoggedIn'])||$_SESSION['role']!=="Admin"){
    header("Location: login.php"); exit;
}
require_once dirname(__DIR__).'/model/DatabaseConnection.php';
$db=new DatabaseConnection();
$conn=$db->openConnection();
$res=$conn->query("SELECT * FROM user WHERE approval_status=0 AND role='Admin'");
?>
<table border="1">
<tr><th>Email</th><th>Action</th></tr>
<?php while($r=$res->fetch_assoc()){ ?>
<tr>
<td><?=$r['user']?></td>
<td>
<a href="../controller/approveUser.php?id=<?=$r['user_id']?>">Approve</a> |
<a href="../controller/rejectUser.php?id=<?=$r['user_id']?>">Reject</a>
</td>
</tr>
<?php } ?>
</table>
