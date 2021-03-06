<?php
require 'includes/init.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = require "includes/db.php";
    
    $pass_and_admin_verify = User::authenticate($conn, $_POST['username'], $_POST['password']);
 
        // we check second element in array to find out if its admin
    
        if (isset($pass_and_admin_verify)) {
            if ($pass_and_admin_verify[1] == true) {
                $_SESSION['is_logged_in_as_admin'] = true;
                Url::redirect('/librarian/admin/index.php');
            } elseif ($pass_and_admin_verify[0] == true) {
                $_SESSION['is_logged_in'] = true;
                Url::redirect('/librarian/index.php');
            }
        } else {
            $errors[] = "Authentication error.";
        }
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
    <p>Login with your email address.</p>
    <?php if (isset($errors)): ?>
        <?php foreach ($errors as $error) : ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>    
        <label for="username" class="login__label">Email</label>
        <input name="username" class="login__input">
        <label for="password" class="login__label">Password</label>
        <input name="password" type="password" class="login__input">

        <div class="login__submit__wrapper">
        <button class="login__submit">Login</button>
        </div>
        <div class="reg-teaser">
            <p>No account?&nbsp;<a href="register-user.php">Register here</a>
        </div>
</section>

<?php require 'includes/footer.php';
