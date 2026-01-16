<?php
require_once 'DatabaseConnection.php';
if (isset($_POST['add_book'])) {
        $book_title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $db = new DatabaseConnection();
    $conn = $db->openConnection();
    
    $stmt = $conn->prepare("INSERT INTO books (title, author, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $book_title, $author, $price, $quantity); // s=string, d=double, i=int
    
    if ($stmt->execute()) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
