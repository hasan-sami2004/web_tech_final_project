<?php
class DatabaseConnection {

    public function openConnection() {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "librarymanagementsystem"; 

        $conn = new mysqli($host, $user, $password, $dbname);

        if ($conn->connect_error) {
            die("DB Connection Failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
