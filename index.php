<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

require 'includes/header.php';

$sql = "SELECT * FROM book";

$results = Book::getAllBooks($conn);


?>

<section class="books-display">
    <?php foreach ($results as $book) : ?>

        <article class="book-item">
            <a href="single-borrow.php?id=<?= $book['id']; ?>">
                <?php if ($book['image_file']) : ?>
                    <img class="book-cover" src="uploads/<?= $book['image_file']; ?>">
                <?php else : ?>
                    <img class="book-cover" src="images/dummy_600x960.png">
                <?php endif; ?>

                <!-- limits title length to 18 chars (+ ...) !-->
                <p class="book-item__title"><?=
                        (strlen($book['title']) > 20 ?
                            htmlspecialchars(substr($book['title'], 0, 15) . '...')
                            : htmlspecialchars($book['title'])); ?>
            </a>

            <p class="book-item__author"><?= htmlspecialchars($book['author']); ?></p>

            <?php if ($book['is_available']) : ?>
                <p class="book-item__torent">Available to rent</p>
            <?php else : ?>
                <p class="book-item__norent">Not available</p>
            <?php endif; ?>
        </article>

    <?php endforeach; ?>

</section>
<?php require 'includes/footer.php'; ?>