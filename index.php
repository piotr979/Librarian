<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

require 'includes/header.php';

$sql = "SELECT * FROM book";

$results = Book::getAllBooks($conn);
$book = new Book();

?>
<section class="welcoming">
    <h2 class="welcoming__header">Welcome to Librarian.</h2>
    <p class="welcoming__text">Simplified rent to read online system.</p>

</section>
<section class="filtering">
    <div class="filtering-category">
        <select name="filter-category">
    
                <option value="all">All categories</option>
                <?php foreach ($book->categories as $category) : ?>
                    <option value="<?= $category; ?>"><?= ucfirst($category); ?></option>
                <?php endforeach; ?>
         
                      
        </select>
    </div>

    <div class="filtering-checkboxes">
    <label>
 
        <input class="in-stock" type="checkbox" name="checkbox-avail" value="avail-yes">
       <span class="checkbox-text">In stock</span></label>
<label>
            <input class="out-of-stock" type="checkbox" name="checkbox-borrowed" value="avail-no">
            <span class="checkbox-text">Out of stock</span></label>
    </div>

</section>
<section class="books-display">
    <?php foreach ($results as $book) : ?>

        <article class="book-item">
            <div class="book-wrapper">
                <a href="single-borrow.php?id=<?= $book['id']; ?>">
                    <?php if ($book['image_file']) : ?>
                        <img class="book-cover" src="uploads/<?= $book['image_file']; ?>">
                    <?php else : ?>
                        <img class="book-cover" src="images/dummy_600x960.png">
                    <?php endif; ?>
            </div>
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
<script>
 function() {
     updateBasketIcon();
 }();
</script>
<?php require 'includes/footer.php'; ?>