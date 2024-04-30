<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $charLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }
    
    return $randomString;
}


function getUserbyId( $id = 1 ){
    include 'db.php';
    $query = "SELECT * FROM users where user_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ( $result && mysqli_num_rows($result) == 1 ){
        return $row['username'];
    }
}

function getCategorybyId( $id = 1 ){
    include 'db.php';
    $query = "SELECT * FROM categories where category_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ( $result && mysqli_num_rows($result) == 1 ){
        return $row['category_name'];
    }
}
?>
