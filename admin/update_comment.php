<?php

require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["comment"]) && 
  isset($_POST["comment"]["id"]) && 
  isset($_POST["comment"]["post_id"]) && 
  isset($_POST["comment"]["name"]) && 
  isset($_POST["comment"]["email"]) && 
  isset($_POST["comment"]["body"]))) {

    header("Location: index.php");
    exit();

}

$id = $db->real_escape_string($_POST["comment"]["id"]);
$post_id = $db->real_escape_string($_POST["comment"]["post_id"]);
$name = $db->real_escape_string($_POST["comment"]["name"]);
$email = $db->real_escape_string($_POST["comment"]["email"]);
$body = $db->real_escape_string($_POST["comment"]["body"]);
$body_rendered = Markdown($body);

$result = $db->query("update comments set post_id = '$post_id', 
  name = '$name', 
  email = '$email', 
  body = '$body',
  body_rendered = '$body_rendered'
  where id = '$id'");

header("Location: edit_comment.php?id=$id&updated=true");

?>


