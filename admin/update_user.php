<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["user"]) && 
  isset($_POST["user"]["id"]) && 
  isset($_POST["user"]["name"]) && 
  isset($_POST["user"]["email"]) && 
  isset($_POST["token"]) &&
  $_SESSION["token"] == $_POST["token"])) {

    header("Location: index.php");
    exit();

}

$id = $db->real_escape_string($_POST["user"]["id"]);
$name = htmlspecialchars($db->real_escape_string($_POST["user"]["name"]));
$email = htmlspecialchars($db->real_escape_string($_POST["user"]["email"]));

$result = $db->query("update users set name = '$name', 
  email = '$email' 
  where id = '$id'");

header("Location: edit_user.php?id=$id&updated=true");

?>



