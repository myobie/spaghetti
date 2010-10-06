<?php

error_reporting(-1);
ini_set("display_errors", 1);
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
$token = md5(date(DATE_ATOM) . $token);

$result = $db->query("insert into users set name = '$name', 
  email = '$email', 
  password = '$password',
  salt = '$salt',
  token = '$token'");
$id = $db->insert_id;

header("Location: edit_user.php?id=$id");

?>




