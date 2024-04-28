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
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST request is made
    $user_user = $_POST['username'];
    $user_pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$user_user' AND password = '$user_pass'";
    $result = mysqli_query($conn, $query);


    if ( $result && mysqli_num_rows($result) == 1) { 
        $row = mysqli_fetch_assoc($result);
        setcookie("is_loggedIn", "true", time() + 3600, "/");
        setcookie("username", $row['username'], time() + 3600, "/");
        setcookie("user_id", $row['user_id'], time() + 3600, "/");
        header("Location: user_panel.php");
    }
    else {
        // Other request method (GET, PUT, DELETE, etc.)
        $MSG = "Username Or Password is Wrong";
    }
} 
?>
<div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <a style="display: block; text-align: center; font-weight: bold; margin-top: 20px;" href="register.php">Not registered Yet ?</a>
        </form>
</div>
</body>
</html>
<?php 
if (isset($_GET['msg'])){
    $MSG = $_GET['msg'];
}
if ( isset($MSG))
{
    echo "<p style='text-align: center; font-weight: bold;'>$MSG</p>";
}
?>
<footer>
    <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>