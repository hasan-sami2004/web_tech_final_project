<?php
require_once '../model/ReaderModel.php';

class ReaderController {

    public function search() {
        require '../view/search_book.php';
    }

    public function borrowedList() {
        $model = new ReaderModel();
        $data = $model->borrowedList($_SESSION['reader_id']);
        require '../view/borrowed_list.php';
    }

    public function returnBook() {
        $model = new ReaderModel();
        if (isset($_POST['borrow_id'])) {
            $model->returnBook($_POST['borrow_id']);
        }
        header("Location: index.php?c=reader&a=borrowedList");
    }

    public function lateFee() {
        require '../view/late_fee.php';
    }
}
