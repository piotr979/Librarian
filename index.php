<?php

require 'includes/init.php';

$conn = require 'includes/db.php';

require 'includes/header.php';

$sql = "SELECT * FROM book";

$results = Book::getAllBooks($conn);

$book = new Book();
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET)) {
        if (isset($_GET['checkbox-avail'])) {
            $results = $book->getBooksWithAvailability($conn, true);
        } else if (isset($_GET['checkbox-borrowed'])) {
            $results = $book->getBooksWithAvailability($conn, false);
        } else if (isset($_GET['checkbox_avail']) && (isset($_GET['checkbox_borrowed']))) {

            $results = Book::getAllBooks($conn);
        
        } else if (isset($_GET['filter_category'])) {
            if ($_GET['filter_category'] != 'all') {
             $results = $book->getBooksWithCategory($conn, $_GET['filter_category']);
            } else {
                $results = Book::getAllBooks($conn);
    
            }
        }
        
      }
    
    
}
?>
<section class="welcoming">
    <h2 class="welcoming__header">Welcome to Librarian.</h2>
    <p class="welcoming__text">Online system for classic libraries.</p>

</section>
<section class="filtering">
    <div class="filtering-category">
        <form method="GET">
        <select onchange="this.form.submit();" name="filter_category">
    
                <option value="all">All categories</option>
                <?php foreach ($book->categories as $category) : ?>

                 
                        <option value="<?= $category; ?>"
                        <?php if (isset($_GET['filter_category'])) : ?>
                        <?php if ($category == $_GET['filter_category']) echo "selected"; ?>
                        <?php endif; ?>
                        ><?= ucfirst($category); ?></option>

                        
                    <?php endforeach; ?>
         
                      
        </select>
            
    </div>

   
    <div class="filtering-checkboxes">
    <label>
 
        <input onchange="this.form.submit();" class="in-stock" type="checkbox" name="checkbox-avail" value="avail-yes"
            <?= isset($_GET['checkbox-avail']) ? "checked" : "" ; ?> >
       <span class="checkbox-text">In stock</span></label>
<label>
            <input onchange="this.form.submit();" class="out-of-stock" type="checkbox" name="checkbox-borrowed" value="avail-no"
            <?= isset($_GET['checkbox-borrowed']) ? "checked" : "" ; ?> >
            <span class="checkbox-text">Out of stock</span></label>
    </div>
    </form>
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

</script>
<?php require 'includes/footer.php'; ?>