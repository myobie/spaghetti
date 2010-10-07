<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["user"]) && 
  isset($_POST["user"]["name"]) && 
  isset($_POST["user"]["email"]) &&
  isset($_POST["user"]["password"]) && 
  isset($_POST["user"]["password_confirmation"]) && 
  $_POST["user"]["password"] == $_POST["user"]["password_confirmation"])) {

    header("Location: index.php");
    exit();

}

$name = $_POST["user"]["name"];
$email = $_POST["user"]["email"];
$password = $_POST["user"]["password"];
$salt = md5(date(DATE_ATOM) . $email);

$result = $db->query("insert into users set name = '$name', 
  email = '$email', 
  password = '$password',
  salt = '$salt'");
$id = $db->insert_id;

header("Location: edit_user.php?id=$id");

?>




