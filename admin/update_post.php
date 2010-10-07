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

$id = $db->real_escape_string($_POST["post"]["id"]);
$user_id = $db->real_escape_string($_POST["post"]["user_id"]);
$title = $db->real_escape_string($_POST["post"]["title"]);
$body = $db->real_escape_string($_POST["post"]["body"]);
$body_rendered = Markdown($body);

$result = $db->query("update posts set user_id = '$user_id', 
  title = '$title', 
  body = '$body',
  body_rendered = '$body_rendered'
  where id = '$id'");

header("Location: edit_post.php?id=$id&updated=true");

?>

