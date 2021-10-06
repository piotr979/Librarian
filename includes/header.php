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

    <script src="js/custom.js"></script>
</head>

<body>
<header>
        <div class="grid-boundries">

            <div class="logo">
                <a href="index.php">
                <div class="logo__wrapper">
                <img src="/../librarian/images/logo.svg" alt="#">
                <h2>Librarian</h2>
                </div>
                </a>
            </div>
            <nav class="authorisation">
                <ul class="authorisation__nav">
            
                <?php if (Auth::isLoggedIn(true)): ?>
                    <li><a href="admin/index.php">
                    <img id="user-credentials" class="switch-icon" src="images/switch.svg" >
                    <p class="authorisation__nav-name">Switch to admin</p>     
                </a></li>
                <?php else: ?>
                    <a href="basket.php">
                <li id="basket-wrapper">
                    <img class="shopping-basket" src="images/shopping-basket-svgrepo-com.svg" 
                    alt="shopping basket"></li>
                    <p class="authorisation__nav-name">Your basket</p>
                    </a>
                <?php endif; ?>
                <li>
                    <?php if (Auth::isLoggedIn() || Auth::isLoggedIn(true)): ?>
                        <a href="logout-user.php">
                    <img id="user-credentials" class="logout-icon" src="images/logout.svg" 
                    alt="user logout"></a>
                    <p class="authorisation__nav-name">Log out</p>
                    <?php else : ?>
                        <a href="login-user.php">
                    <img id="user-credentials" class="user-icon" src="images/user-210.svg" 
                    alt="user login or register"></a>
                    <p class="authorisation__nav-name">Login here</p>
                    <?php endif; ?> 
                  
                    </li>
                </ul>
            </nav>
        </div>
       
    </header>
    <main>
    
 