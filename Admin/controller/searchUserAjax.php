<?php
session_start();

require_once '../../common/model/DatabaseConnection.php';

$search = $_GET["query"] ?? "";

if($search==""){
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();

$stmt = $conn->prepare(
 "SELECT user FROM user WHERE user LIKE ? LIMIT 10"
);

$param = "%".$search."%";

$stmt->bind_param("s",$param);
$stmt->execute();

$result = $stmt->get_result();

while($row = $result->fetch_assoc()){
    echo "<div>".$row['user']."</div>";
}