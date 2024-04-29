<?php
session_start();
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetDir = '/var/www/html/statics/images/';
    $targetFile = $targetDir . md5($_SESSION['username']) . '.png';

    // Move the uploaded file to the target directory
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Error: " . $_FILES['file']['error'];
}
?>
