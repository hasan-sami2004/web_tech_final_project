<?php
session_start();

if (
    !isset($_SESSION["isLoggedIn"]) ||
    ($_SESSION["role"] !== "Admin" && $_SESSION["role"] !== "Seller")
) {
    header("Location: ../view/dashboard.php");
    exit;
}

require_once '../model/DatabaseConnection.php';

$title = $_POST["title"] ?? "";
$author = $_POST["author"] ?? "";
$price = $_POST["price"] ?? 0;
$quantity = $_POST["quantity"] ?? 0;

if (!$title || !$author || !$price || !$quantity) {
    header("Location: ../view/book_insertion.php");
    exit;
}

$db = new DatabaseConnection();
$conn = $db->openConnection();



$sql = "INSERT INTO books (title, author, price, quantity)
VALUES (?, ?, ?, ?)
ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssii", $title, $author, $price, $quantity);

$stmt->execute();

header("Location: ../view/book_insertion.php");
exit;

