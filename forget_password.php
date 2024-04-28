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
        include 'functions.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // POST request is made
            $user_user = $_POST['username'];

            $query = "SELECT * FROM users WHERE username = '$user_user'";
            $result = mysqli_query($conn, $query);

            if ( $result && mysqli_num_rows($result) == 1) { 
                $token = md5(generateRandomString());
                $update_query = "UPDATE users SET token = '$token' WHERE username = '$user_user'";
                $update_result = mysqli_query($conn, $update_query);
                $row = mysqli_fetch_assoc($result);
                print("/reset_password.php/?token=" . $token);
                $token_set = "A reset Link has has been sent to you Email Address: " . $row['email'];
            }
            else {
                // Other request method (GET, PUT, DELETE, etc.)
                $MSG = "Username does not exist";
            }
    } 
    ?>
<div class="login-container">
    <h2>Forget password</h2>
    <form class="login-form" action="forget_password.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="submit" value="Reset">
        <p style="display: block; text-align: center; font-weight: bold; margin-top: 20px;" href="register.php"><?php if (isset($token_set)) {echo $token_set;}?></p>
    </form>
</div>   
</body>
</html>
<?php 
if ( isset($MSG))
{
    echo "<p style='text-align: center; font-weight: bold;'>$MSG</p>";
}
?>
<footer>
    <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>