<?php

error_reporting(-1);
ini_set("display_errors", 1);
require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["user"]) && 
  isset($_POST["user"]["id"]) && 
  isset($_POST["user"]["name"]) && 
  isset($_POST["user"]["email"]))) {

    header("Location: index.php");
    exit();

}

$id = $_POST["user"]["id"];
$name = $_POST["user"]["name"];
$email = $_POST["user"]["email"];

$result = $db->query("update users set name = '$name', 
  email = '$email' 
  where id = '$id'");

header("Location: edit_user.php?id=$id&updated=true");

?>



