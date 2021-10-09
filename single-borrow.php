<?php

require 'includes/init.php';

$conn = require 'includes/db.php';
require 'includes/header.php';

if (isset($_GET['id'])) {

    $book = Book::getBookById($conn, $_GET['id']);
} else {
    $book = null;
}
?>
<div class="single-book">
    <div id="book-id" data-id="<?= $book->id; ?>">
        <img class="single-book__cover book-cover" 
        src="<?= $book->image_file ?
            'uploads/' . $book->image_file :
            'images/dummy_600x960.png'; ?>" alt="book cover">
    </div>

    <div id="">
        <h4><?= $book->title; ?></h4>
        <p class="single-book__author"><?= $book->author; ?></p>
        <?php if (Auth::isLoggedIn(true)) : ?>
            <p>Please login as user</p>
        <?php elseif (Basket::isInTheBasket($book->id)) : ?>
            <p>Already in the basket</p>
        <?php elseif (Basket::isLimitReached()) : ?>
            <p>Limit 4 books reached!</p>
        <?php elseif ($book->is_available == 1) : ?>
            <button class="button-basket" id="add-book">Add to basket</button>
            <div id="basket-update"></div>
        <?php else : ?>
            <p>Not available at the moment</p>
        <?php endif; ?>
    </div>
    <div class="single-book__table-wrapper">
        <table class="single-book__table">
            <tr>
                <td>
                    Year:
                </td>
                <td>
                    <?= $book->year; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Category:
                </td>
                <td>
                    <?php foreach ($book->categories as $key => $cats) : ?>
                        <?php if ($book->category == $key) : ?>
                            <?= ucfirst($cats) ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Pages:
                </td>
                <td>
                    <?= $book->pages; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Publisher:
                </td>
                <td>
                    <?= $book->publisher; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Age:
                </td>
                <td>
                    <?php if ($book->age_from == 0) : ?>
                        Kids
                    <?php else : ?>
                        Adults
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Available:
                </td>
                <td>
                    <?php if ($book->is_available == 0) : ?>
                        No
                    <?php else : ?>
                        Yes
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>

    <!-- MODAL WINDOW ENDS HERE -->
    <script>
        const addButton = document.getElementById('add-book');
        if (addButton != null) {
            addButton.addEventListener('click', function() {
                const bookId = document.getElementById('book-id').dataset.id;

                //adds item to basket ($_COOKIE) by sending json to php
                let response = fetch(
                    "add-to-basket.php", {
                        method: "POST",
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            bookId: bookId
                        })
                    }).then((response) => {
                    if (response.status === 200) {
                        if (addButton) {
                            addButton.parentNode.removeChild(addButton);
                            const parentNode = document.getElementById('basket-update');
                            parentNode.innerHTML = "<p>Added to basket</p>"
                            updateBasketIcon();
                        }
                    }
                });
            })
        }
    </script>
    <?php require 'includes/footer.php'; ?>