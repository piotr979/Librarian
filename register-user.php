<?php
require 'includes/init.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require "includes/db.php";
    if (isset($_POST)) {
        $username = $_POST['username'];
        $password = $_POST['password'] ?? '';
        $password_repeat = $_POST['password_repeat'] ?? '';
    }
    $errors = User::processRegisteration($conn, $username, $password, $password_repeat);
}
?>
<!DOCTYPE html>

<html>

<head>
    <title>Librarian - simple library</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&family=Reem+Kufi&display=swap" rel="stylesheet">

</head>
<body>

<section class="login-section">
 
    <form class="user-login" method="POST">
    <h3>Librarian</h3>
    <p>Sign up with your email address.</p>
    <?php if (isset($errors)): ?>
        <?php foreach ($errors as $error) : ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>    
        <label for="username" class="login__label">Login</label>
        <input name="username" class="login__input">
        <label for="password" class="login__label">Password</label>
        <input name="password" type="password" class="login__input">

        <label for="password-2" class="login__label">Repeat password</label>
        <input name="password-2" type="password" class="login__input">

        <div class="login__submit__wrapper">
        <button class="login__submit">Submit</button>
        </div>
        
</section>

<?php require 'includes/footer.php';