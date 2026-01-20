<?php
session_start();

if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Admin") {
    header("Location: ../../common/view/dashboard.php");
    exit;
}

require_once '../../common/model/DatabaseConnection.php';

$db = new DatabaseConnection();
$conn = $db->openConnection();

$result = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
<head>
<title>User Management</title>
<link rel="stylesheet" href="../../common/style.css">
</head>

<body>

<div class="page-bg">

<nav class="top-nav">
  <div class="logo">📚 <b>USER MANAGEMENT</b></div>

  <div class="nav-links">
    <a href="admindashboard.php" class="nav-btn">Dashboard</a>
    <a href="../../common/controller/logout.php" class="nav-btn dark">Logout</a>
  </div>
</nav>

<div style="padding:40px">

<h2>All Users</h2>

<!-- SEARCH BOX -->
<input type="text" id="searchBox" placeholder="Search user by email..." autocomplete="off">
<div id="resultBox"></div>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

<tr>
  <th>ID</th>
  <th>Email</th>
  <th>Role</th>
  <th>Status</th>
  <th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>

<tr>

<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['role']; ?></td>

<td>
<?php
 if($row['approval_status']==1) echo "Active";
 else if($row['approval_status']==0) echo "Pending";
 else echo "Disabled";
?>
</td>

<td>

<a href="../controller/changeStatus.php?id=<?php echo $row['user_id']; ?>&status=1">
 Activate
</a>

 |

<a href="../controller/changeStatus.php?id=<?php echo $row['user_id']; ?>&status=-1"
onclick="return confirm('Disable this user?')">
 Disable
</a>

</td>

</tr>

<?php endwhile; ?>

</table>

</div>

</div>

<!-- AJAX SCRIPT MUST BE AFTER HTML -->
<script>

document.getElementById("searchBox").addEventListener("keyup", function () {

    let query = this.value;

    if(query.length === 0){
        document.getElementById("resultBox").innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();

    xhr.open("GET",
      "/web_tech_final_project/Admin/controller/searchUserAjax.php?query=" + query,
      true
    );

    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById("resultBox").innerHTML = this.responseText;
        }
    };

    xhr.send();

});

</script>

</body>
</html>