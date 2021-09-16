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
    <div>
        <img class="single-book__cover book-cover" 
        src="<?= $book->image_file ? 'uploads/' . $book->image_file  
        : 'images/dummy_600x960.png'; ?>" alt="book cover">
    </div>
    <div>
        <h4><?= $book->title; ?></h4>
        <p class="single-book__author"><?= $book->author; ?></p>
            <?php if (Auth::isLoggedIn()) : ?>

            <?php if ($book->is_available == 1): ?>
            <button class="button-basket" id="edit-book">Add to basket</a>
            <?php else: ?>
            <p>Not available at the moment</p>
            <?php endif; ?>
                <?php else :?>
                    <p class="single-book__no-access">To borrow please login</p>
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
                    <?php foreach($book->categories as $key=>$cats) : ?>
                        <?php if ($book->category == $key): ?>
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
        const editButton = document.getElementById('edit-book');
        const deleteButton = document.getElementById('delete-book');
        const yesButton = document.getElementById('modal-delete__yes');
        const noButton = document.getElementById('modal-delete__no');
        const modalWindow = document.getElementById('modal');

        deleteButton.addEventListener('click', function() {

            modalWindow.style.display = 'block';
        })
        editButton.addEventListener('click', function() {
            // Will take to edit window with selected ID of the book
            window.location.href = 'single-book-edit.php?id=<?= $book->id; ?>';
        })
        yesButton.addEventListener('click', function() {

            const frm = document.createElement('form');

            frm.setAttribute('method', 'POST');
            frm.setAttribute('action', 'delete.php?id=<?= $book->id; ?>');
            document.body.appendChild(frm);
            frm.submit();
        })

        noButton.addEventListener('click', function() {
            modalWindow.style.display = 'none';
        })
    </script>

<?php require 'includes/footer.php'; ?>