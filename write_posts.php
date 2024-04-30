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
        $query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            $category_id = mysqli_real_escape_string($conn, $_POST['category']);
            $author_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
            
            try {
            
                $query = "INSERT INTO posts (title, content, author_id, category_id) values ('$title', '$content', '$author_id', '$category_id')";
                $result = mysqli_query($conn, $query);
                if ( $result === true ){
                    header("Location: my_posts.php");
            } 
                }
            
            catch (Exception $e){
                $dynamicContent = "Error: " . $e->getMessage();
                print_r($dynamicContent);
            }
            // Refresh setting page to see updated data
           
        }
    ?>
    <header>
        <h1>Welcome to Our Weblog</h1>
    </header>
    <nav>
        <a href="#">Panel</a>
        <a href="write_posts.php">Write</a>
        <a href="my_posts.php">Post</a>
        <a href="setting.php">Setting</a>
        <a href="#" onclick="deleteAllCookies();redirectWithMessage('/login.php', 1000, 'Hope to See You Again');">(<?php echo $_SESSION['username']?>) Logout</a>
    </nav>
    <div class="container">
    <h2>User Settings</h2>

    <div class="container">
    <h2>Wrrite a New Post</h2>
    </div>

    <form action="write_posts.php" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" style="width: 300px;" placeholder="Title" >
        <div class="form-group">
            <label for="content">content:</label>
            <textarea type="text" id="content" name="content" style="width: 700px; height: 200px;" placeholder="In this post i want to talk about ..."></textarea>
        </div>
        <select id="category" name="category">
            <?php
                foreach ($rows as $row) {
                    echo "<option value=" . $row[0] .">" . $row[1] . "</option>";
                }
            ?>
        </select><br></br>
        <div class="form-group">
            <input type="submit" value="Post">
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