<?php

require 'includes/init.php';
$conn = require 'includes/db.php';

if (isset($_SESSION['basket'])) {
    $books_in_basket = Basket::getBasket();
}
?>

<?php require 'includes/header.php'; ?>


<div class="basket">
    <h5>Your basket</h5>

    <section>
        <article class="basket__item">
            <div class="basket__item-cover">
            <img src="images/dummy_600x960.png" alt="">
            </div>
            <div class="basket__item-details">
                <h6>Old book</h6>
                <p>Marry marry</p>
            </div>
            <div class="basket__item-remove">
            <a href=""><img class="basket__item-trash-icon" src="images/trash.svg"></a>
</div>
        </article>
    </section>
</div>

<?php require 'includes/footer.php'; ?>