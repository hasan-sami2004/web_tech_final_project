<?php
require_once __DIR__ . "/../model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$sql = "SELECT * FROM books";
$books = $conn->query($sql);

if (!$books) {
    die("Database query failed");
}
