<?php
session_start();

//if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["role"] !== "Seller") {
   // header("Location: ../../common/view/dashboard.php");
   // exit;
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Dashboard</title>

    <!-- Common Style -->
  <link rel="stylesheet" href="../../common/style.css">
</head>
<body>

    <!-- Top Navigation -->
    <div class="top-nav">
        <h2>Buyer Dashboard</h2>

        <div>
            <a href="../../common/view/login.php" class="nav-btn dark">Logout</a>
        </div>
    </div>

    <!-- Page Background -->
    <div class="page-bg">
        <div style="padding: 40px 50px;">

            <h3>Welcome, Buyer 👋</h3>
            <p>Manage your books and purchases</p>

            <!-- Dashboard Grid -->
            <div class="admin-grid">

                <!-- List of Books -->
                <a href="../../common/view/book_list.php" class="admin-card">
                    <h4>📚 List of Books</h4>
                    <p>View all available books</p>
                </a>

                <!-- Search Books -->
                <a href="../../common/view/search_book.php" class="admin-card">
                    <h4>🔍 Search Books</h4>
                    <p>Search books by title or author</p>
                </a>

                <!-- Cart -->
                <a href="#" class="admin-card">
                    <h4>🛒 Cart</h4>
                    <p>View items added to cart</p>
                </a>

                <!-- Purchase -->
                <a href="#" class="admin-card">
                    <h4>💳 Purchase</h4>
                    <p>Complete your book purchase</p>
                </a>

                <!-- Purchase History -->
                <a href="#" class="admin-card">
                    <h4>📜 Purchase History</h4>
                    <p>View all previous purchases</p>
                </a>

            </div>
        </div>
    </div>

</body>
</html>