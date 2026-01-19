<?php
require_once __DIR__ . "/../model/DatabaseConnection.php";

$db = new DatabaseConnection();
$conn = $db->openConnection();

$books = null;

if (isset($_GET["search"])) {
    $search = $_GET["search"];

    $sql = "SELECT * FROM books 
            WHERE title LIKE '%$search%' 
            OR author LIKE '%$search%'";

    $books = $conn->query($sql);

    if (!$books) {
        die("Search query failed");
    }
}
