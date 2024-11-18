<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheet_bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php include('header.php'); ?>
    <header>
        <h1>Login</h1>
        <nav>
            <ul>
                <li>
                    <a href="startseite.php">
                        <img src="images/Home-Button-Icon.jpg" alt="arial picture of the home button logo">
                    </a>
                </li>
                <li>
                    <a href="impressum.php"><img src="images/Telefon Icon.png" alt="Telefon Icon"></a>
                </li>
                <li>
                    <a href="impressum.php"><img src="images/Email Icon.png" alt="E-Mail Icon"></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/"><img src="images/Instagram Icon.webp" alt="Instagram Icon"></a>
                </li>
                <li>
                    <a href="https://www.facebook.com/"><img src="images/Facebook Icon.svg" alt="Facebook Icon"></a>
                </li>
                <li>
                    <a href="register.html">Register</a>
                </li>
            </ul>    
        </nav>
    </header>

    <main>
        <div class="section-wrapper-login">
            <section>
                <form action="/submit_login" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    
        
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    
        
                    <button type="submit">Login</button>
                </form>
            </section>
        </div>
    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
