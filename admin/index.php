<?php

require '../includes/init.php';

Auth::requireLogin(true);

$conn = require '../includes/db.php';

require 'includes/header.php';
require 'includes/columns.php';



$sql = "SELECT * FROM book";

$results = Book::getAllBooks($conn);

/* this Book instance's class its only for accessing categories, a bit of waste indeed :) */
$book = new Book();
?>

<section class="books-display__admin">

    <table class="books__admin">
        <thead>
            <tr>
                <?php foreach (array_slice($table_columns, 1) as $key => $value) : ?>
                    <th class="books__admin-head">
                        <?= $value ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result) : ?>
        
            <tr class="books__admin-row-edit" data-id="<?= $result['id'] ?>">
                <?php foreach (array_slice($table_columns, 1) as $key => $value) : ?>

                    <td>
                        <?php if ($key == 'category'): ?>
                            <?php foreach($book->categories as $key=>$cats) : ?>
                        <?php if ($result['category'] == $key): ?>
                            <?= ucfirst($cats) ?>
                            <?php endif; ?>
                    <?php endforeach; ?>
                        <?php elseif ($key == 'age_from'): ?>
                                <?= $result[$key] == '0' ? 'Kids' : 'Adults' ?>
                        <?php elseif ($key == 'is_available'): ?>
                                <?= $result[$key] == '1' ? 'Yes' : "No" ?>
                       
                        <?php elseif ($key == 'image_file') : ?>
                                <?= $result[$key] !== '' ? "Yes" : "No" ?>
                        <?php else: ?>
                        <?= $result[$key] ?>
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="books__admin-new">
    <a href="book-new.php" class="books__admin-new-book">Add new</a>
    </div>
</section>

<script>
    document.onreadystatechange = function() {
    const rows = document.querySelectorAll('.books__admin-row-edit');
    rows.forEach( function(row) {
        row.addEventListener('click', function(e) {
            location.href = "single-book.php?id=" + e.target.parentElement.dataset.id;
        });
    });
}

</script>
<?php require 'includes/footer.php'; ?>