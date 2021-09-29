<?php

require '../includes/init.php';
Auth::requireLogin(true);
$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    Book::deleteBook($conn, $_GET['id']);
} else {
    echo "Book with given id not found.Please go back to previous page.";
}