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
    <?php

    $is_loggedIn = $_COOKIE["is_loggedIn"];
    $user_id = $_COOKIE["user_id"];
    if ( $is_loggedIn == "true" && !is_null($user_id) ){
        
    
    ?>
    <header>
        <h1>Welcome to Our Weblog</h1>
    </header>
    <nav>
        <a href="#">Panel</a>
        <a href="#">Write</a>
        <a href="#">Post</a>
        <a href="#">Setting</a>
        <a href="#" onclick="deleteAllCookies();redirectWithMessage('/login.php', 1000, 'Hope to See You Again');">(<?php echo $_COOKIE['username']?>) Logout</a>
    </nav>
    <div class="container">
        <div class="post">
            <h2>Post Title 1</h2>
            <p>This is the content of the first blog post. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>
        </div>
        <div class="post">
            <h2>Post Title 2</h2>
            <p>This is the content of the second blog post. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>
        </div>
        <div class="post">
            <h2>Post Title 3</h2>
            <p>This is the content of the third blog post. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>
        </div>
    </div>
    <?php 
    }
    else {
    ?>
    <script> redirectWithMessage("/login.php", 3000, "Redirecting to The login page") </script>
    <?php } ?>
    

</body>
</html>
<footer>
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>