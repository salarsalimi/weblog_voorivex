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
        session_start();
        if (isset($_SESSION['msg'])){ $message = $_SESSION['msg']; }
        include 'db.php';
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
            $user_token = $_GET['token'];
            $_SESSION['token'] = $user_token;
            $query = "SELECT * FROM users WHERE token = '$user_token'";
            $result = mysqli_query($conn, $query);
            
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row['username'];

            if ( $result && mysqli_num_rows($result) == 1) {
                $valid_token = true;
            }
            else {
                $message = "Token is Invalid or Expired ... ";
            }
            
        }

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            // POST request is made
            $user_user = $_POST['username'];
            $user_pass = $_POST['password'];
            $user_conf = $_POST['confPassword'];

            $user_token = $_SESSION['token'];

            if ( $user_pass !== $user_conf ){
                $_SESSION['msg'] = "Paswords do not match please try Agian !: ";
                header("Location: reset_password.php?token=$user_token");
            }
            else {

                $query_pass = "UPDATE users SET password =  '$user_pass' WHERE token = '$user_token'";
                $result_pass = mysqli_query($conn, $query_pass);
                $user = $_SESSION['user'];


                if ( $result_pass === true ){
                    $query_token_reset = "UPDATE users SET token =  'NULL' WHERE username = '$user'";
                    $result_token_reset = mysqli_query($conn, $query_token_reset);
                    header("Location:/login.php?msg=Password has successfully been changed");
                }
            }   
        }
    ?>
<?php if ( isset( $valid_token ) && $valid_token === true){ ?>
<div class="login-container">
    <h2>Forget password</h2>
    <form class="login-form" action="reset_password.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="password" placeholder="password" required>
        <input type="text" name="confPassword" placeholder="Confirm" required>
        <input type="submit" value="Set">
        <p style="display: block; text-align: center; font-weight: bold; margin-top: 20px;" href="register.php"><?php if (isset($message)) {echo $message;}?></p>
    </form>
</div>   

<?php 
}
else {
    if ( !isset ($message)) {
        $message = "Invalid Link Please go to this link to get Reset password link <a href='forget_password.php'> Click me </a>";
    }
?>
  <p style="display: block; text-align: center; font-weight: bold; margin-top: 20px;" href="register.php"><?php if (isset($message)) {echo $message;}?></p>
<?php
}
if ( isset($MSG))
{
    echo "<p style='text-align: center; font-weight: bold;'>$MSG</p>";
}
?>
</body>
</html>
<footer>
    <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>