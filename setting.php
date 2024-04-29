<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weblog Homepage</title>
    <link rel="stylesheet" href="statics/styles.css">
    <script src="statics/functions.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="statics/upload.js"></script>
</head>
<body>
    <?php
    session_start();
    include 'db.php';
    $is_loggedIn = $_SESSION["is_loggedIn"];
    if ( $is_loggedIn === true ){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_first = mysqli_real_escape_string($conn, $_POST['firstname']);
            $user_last = mysqli_real_escape_string($conn, $_POST['lastname']);
            $user_bio = mysqli_real_escape_string($conn, $_POST['bio']);
            $user_password = mysqli_real_escape_string($conn, $_POST['password']);
            $updated;
            
            try {
            if ( $user_password == "" ){
                    $query = "UPDATE users SET firstname = '$user_first',  lastname = '$user_last', bio = '$user_bio'";
                    $result = mysqli_query($conn, $query);
                    if ( $result === true ){
                        $updated = true;
                    } 
                }
                else{
                    $query = "UPDATE users SET firstname = '$user_first',  lastname = '$user_last', bio = '$user_bio', password = '$user_password'";
                    $result = mysqli_query($conn, $query);
                    if ( $result === true ){
                        $updated = true;
                    } 
                }
            }
            catch (Exception $e){
                $dynamicContent = "Error: " . $e->getMessage();
            }
            // Refresh setting page to see updated data
            if ( $updated ){
                header("Location: setting.php?msg=updated");
            }    
        }
    ?>
    <header>
        <h1>Welcome to Our Weblog</h1>
    </header>
    <nav>
        <a href="#">Panel</a>
        <a href="#">Write</a>
        <a href="#">Post</a>
        <a href="setting.php">Setting</a>
        <a href="#" onclick="deleteAllCookies();redirectWithMessage('/login.php', 1000, 'Hope to See You Again');">(<?php echo $_SESSION['username']?>) Logout</a>
    </nav>
    <div class="container">
    <h2>User Settings</h2>

    <div class="container">
    <h2>Upload Picture</h2>
    <img src='statics/images/<?php echo md5($_SESSION['username']) . '.png'?>'  width="300" height="200"></img>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="fileInput">
        <button type="submit">Upload</button>
    </form>
    <div id="uploadStatus"></div>
    </div>

    <form action="setting.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']?>" disabled>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']?>" disabled>
        </div>
        <div class="form-group">
            <label for="firstname">Firstname:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']?>" >
        </div>
        <div class="form-group">
            <label for="lastname">Lastname:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']?>" >
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea type="text" id="bio" name="bio" ><?php echo $row['bio']?></textarea>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter new password">
        </div>
        <div class="form-group">
            <input type="submit" value="Save Settings">
        </div>
    </form>
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