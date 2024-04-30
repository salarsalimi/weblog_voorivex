<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog Homepage</title>
    <link rel="stylesheet" href="statics/styles.css">
    <script src="statics/functions.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to Our Weblog</h1>
    </header>
    <?php session_start(); ?>
    <nav>
        <a href="/register.php">SingUp</a>
        <a href="/all_posts.php">All-Posts</a>
        <a href="/user_panel.php" >User-Panel</a>
    </nav>
</body>
</html>
<footer>
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>