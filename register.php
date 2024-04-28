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
        include 'db.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // POST request is made
            $user_user = $_POST['username'];
            $user_email = $_POST['email'];
            $user_pass = $_POST['password'];
        
            try {
                $query = "INSERT INTO users ( username, email, password) VALUES ('$user_user', '$user_email', '$user_pass')";
                $result = mysqli_query($conn, $query);
            
                if ( $result === true) { 
                    header("Location: login.php?msg=You have Successfully registered");
                }
                else {
                    // Other request method (GET, PUT, DELETE, etc.)
                    $errMSG = "Username Or Password is Wrong";
                }
            }
            catch (Exception $e){
                $dynamicContent = "Error: " . $e->getMessage();
            }
        } 
    ?>
    <div class="login-container">
        <h2>Sign-Up</h2>
        <form class="login-form" action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Sign-Up">
            <a style="display: block; text-align: center; font-weight: bold; margin-top: 20px;" href="register.php">Already registered ?</a>
            <p style="display: block; text-align: center; margin-top: 20px;"><?php echo $dynamicContent; ?></p>
        </form>
    </div>
</body>
</html>
<footer>
        <p>&copy; 2024 Your Website Name. All rights reserved.</p>
</footer>