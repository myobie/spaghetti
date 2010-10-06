<?php

require_once("lib/db.php");
require_once("lib/markdown.php");
session_start();

// Validation
if (! (isset($_POST["comment"]) && 
  isset($_POST["comment"]["post_id"]) &&
  isset($_POST["comment"]["name"]) && 
  isset($_POST["comment"]["email"]) &&
  isset($_SESSION["token"]) && 
  isset($_POST["token"]) &&
  $_SESSION["token"] == $_POST["token"])) {

    $message = urlencode("Couldn't add your comment.");
    header("Location: index.php?message=$message");
    exit();

}

$post_id = $_POST["comment"]["post_id"];
$name = $_POST["comment"]["name"];
$email = $_POST["comment"]["email"];
$body = $_POST["comment"]["body"];
$body_rendered = Markdown($body);

$result = $db->query("insert into comments set post_id = '$post_id', 
  name = '$name', 
  email = '$email',
  body = '$body',
  body_rendered = '$body_rendered'");

header("Location: post.php?id=$post_id");

?>
