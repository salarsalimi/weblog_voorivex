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
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM posts where author_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $rows = array(); // Initialize an empty array to store the rows

        if ($result) {
            // Loop through the result set and fetch each row
            while ($row = mysqli_fetch_assoc($result)) {
                // Append the fetched row to the $rows array
                $rows[] = $row;
            }

            // Free the result set
            mysqli_free_result($result);
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($conn);
        }
        print_r($rows);
        

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
    <h2>My Weblog Posts</h2>
    </div>
    <div class="container">
        <?php 
            foreach ( $rows as $r ){
                echo "<p> - " . $r['title'] . " - Publish in: " . $r['publication_date'] . "   | <a href=/view_post.php?post_id=" . $r['post_id'] . " >view</a>" . "   | <a href=/edit_post.php?post_id=" . $r['post_id'] . " >edit</a>" .  "   | <a href=/delete_post.php?post_id=" . $r['post_id'] . " >delete</a>" . "</p>";
            }
        ?>
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