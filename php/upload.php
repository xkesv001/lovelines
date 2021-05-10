<?php

$target_dir = __DIR__ . '/uploads/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
/*if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}*/

if ($target_file == $target_dir) {
    $uploadOk = 0;
}



if (isset($_POST["fileToUpload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file) && $target_file != $target_dir) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" /* && $imageFileType != "png" && $imageFileType != "jpeg" */ && $imageFileType != "gif" && $target_file != $target_dir) {
    echo "Sorry, only JPG & GIF files are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 && $target_file != $target_dir) {
    echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
        if ($imageFileType == "jpg") {
            rename($target_file, "uploads/obrazek.jpg");
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been renamed to obrazek.jpg.<br>";
        } else {
            rename($target_file, "uploads/obrazek.gif");
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been renamed to obrazek.gif.<br>";
        }
    } else {
        if ($target_file != $target_dir) {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
if ($target_file != $target_dir) {
    echo "<br><br><br>";
}
?>

