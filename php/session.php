<?php
session_start();
require "php/kitlab_db.php";

$mysqli = new mysqli('localhost', $uzivatel, $heslo, $databaze);
$mysqli->query("SET NAMES utf8");

if (isset($_GET["logout"])) {
    session_destroy();
    Header("Location: ./");
    die();
}

if (isset($_POST["username"]) && isset($_POST["password"]) && !isset($_POST["password2"])) {
    /* if ($_POST["username"] == "user" && $_POST["pass"] == "abc") {
      $_SESSION["username"] = $_POST["username"];
      } */
    $stmt = $mysqli->prepare("SELECT id, username FROM users WHERE username=? AND password=PASSWORD(?)");
    $stmt->bind_param("ss", $_POST['username'], $_POST['password']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "Incorrect combination name and password";
    } else {
        $row = $result->fetch_assoc();
//$row['id'];
        $_SESSION["username"] = $row['username'];
    }
}

/*if (isset($_SESSION["username"]) && isset($_POST["new_pass"])) {
    $stmt = $mysqli->prepare("UPDATE users password SET password=PASSWORD(?) WHERE username=?");
    $stmt->bind_param("ss", $_POST['new_pass'], $_SESSION["username"]);
    $stmt->execute();
}*/
?>

