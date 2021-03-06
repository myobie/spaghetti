<?php

require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["post"]) && 
  isset($_POST["post"]["id"]) && 
  isset($_POST["post"]["user_id"]) && 
  isset($_POST["post"]["title"]) && 
  isset($_POST["post"]["body"]))) {

    header("Location: index.php");
    exit();

}

$id = $_POST["post"]["id"];
$user_id = $_POST["post"]["user_id"];
$title = $_POST["post"]["title"];
$body = $_POST["post"]["body"];
$body_rendered = Markdown($body);

$result = $db->query("update posts set user_id = '$user_id', 
  title = '$title', 
  body = '$body',
  body_rendered = '$body_rendered'
  where id = '$id'");

header("Location: edit_post.php?id=$id&updated=true");

?>

