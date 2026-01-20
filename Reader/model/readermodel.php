<?php
require_once '../../common/model/DatabaseConnection.php';

class ReaderModel {

    public function searchBook($keyword) {
        $db = getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE title LIKE ?");
        $key = "%$keyword%";
        $stmt->bind_param("s", $key);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function borrowBook($reader_id, $book_id) {
        $db = getConnection();
        $stmt = $db->prepare(
            "INSERT INTO borrowed_books(reader_id, book_id, borrow_date)
             VALUES (?, ?, NOW())"
        );
        $stmt->bind_param("ii", $reader_id, $book_id);
        return $stmt->execute();
    }

    public function borrowedList($reader_id) {
        $db = getConnection();
        $stmt = $db->prepare(
            "SELECT b.title, bb.borrow_date, bb.return_date
             FROM borrowed_books bb
             JOIN books b ON b.id = bb.book_id
             WHERE bb.reader_id=?"
        );
        $stmt->bind_param("i", $reader_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function returnBook($id) {
        $db = getConnection();
        $stmt = $db->prepare(
            "UPDATE borrowed_books SET return_date = NOW() WHERE id=?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
