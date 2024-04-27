<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog Homepage</title>
    <link rel="stylesheet" href="statics/styles.css">
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request is made
    $user_user = $_POST['username'];
    $user_pass = $_POST['password'];

    $suername = "Salar";
    $password = "P@ssw0rd";

    if ( $user_user == $suername && $password == $user_pass ){
        setcookie("is_loggedIn", "true", time() + 3600, "/");
        setcookie("username", "Salar", time() + 3600, "/");
        header("Location: user_panel.php");
    }
    else {
        // Other request method (GET, PUT, DELETE, etc.)
        $errMSG = "Username Or Password is Wrong";
    }
} 
?>
<div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
</div>
</body>
</html>
<?php 
if ( !is_null($errMSG))
{
    echo "<p style='text-align: center; font-weight: bold;'>$errMSG</p>";
}
?>
<footer>
    <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>