<?php

require 'includes/init.php';
$conn = require 'includes/db.php';
$books = [];

if (isset($_COOKIE['basket'])) {
    $books_ids = Basket::getBasket();
    foreach ($books_ids as $id ) {
    $books[] = Book::getBookById($conn, $id);
    }
}
?>

<?php require 'includes/header.php'; ?>


<div class="basket">
    <h5>Your basket</h5>

    <?php if (Basket::is_empty()): ?>
        <p class="center-me">Your basket is empty</p>
        <?php else: ?>
    <section>
        <?php foreach ($books as $book) : ?>

        <article class="basket__item">
            <div class="basket__item-cover">
          <?php if ($book->image_file): ?>
            <img src="uploads/<?= $book->image_file; ?>" alt="book cover" >
            <?php else: ?>
                <img src="images/dummy_600x960.png" alt="missing book cover">
            <?php endif; ?>
            </div>
            <div class="basket__item-details">
                <h6><?= $book->title; ?></h6>
                <p><?= $book->author; ?></p>
            </div>
            <div class="basket__item-remove">
            <img data-id="<?= $book->id; ?>"
            class="basket__item-trash-icon trash-remove" src="images/trash.svg">
</div>
        </article>
        <?php endforeach; ?>

    </section>

    <?php endif; ?>
</div>
<script>
    const trashcans = document.querySelectorAll('.trash-remove');
    console.log(trashcans);
    trashcans.forEach( function(book) {
            book.addEventListener('click', function(ev) {
                const bookId = ev.target.dataset.id;
                console.log(bookId);
        book.parentNode.parentNode.parentNode.removeChild(book.parentNode.parentNode);
        let response = fetch("remove-from-basket.php", {
            method: 'POST',
            headers: {
              'content-type': 'application/json'  
            },
            body: JSON.stringify( {
                id: bookId
            })
        })
    });
});

</script>

<?php require 'includes/footer.php'; ?>