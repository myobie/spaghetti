<?php

function reload_login_form() {
  $login_error = true;
  include("login.php");
  exit();
}

session_start();

var_dump($_SESSION["token"]);
var_dump($_POST["token"]);

var_dump((isset($_POST["email"]) && 
  isset($_POST["password"]) && 
  isset($_POST["token"]) &&
  $_SESSION["token"] == $_POST["token"]));

// Validation
if (! (isset($_POST["email"]) && 
  isset($_POST["password"]) && 
  isset($_POST["token"]) &&
  $_SESSION["token"] == $_POST["token"])) {
  reload_login_form();
}

require_once("../lib/db.php");

$email = $db->real_escape_string($_POST["email"]);
$password = $db->real_escape_string($_POST["password"]);

$user_result = $db->query("select * from users where email = '$email' and password = '$password'");

if ($user_result->num_rows == 0) {
  reload_login_form();
}

$user = $user_result->fetch_assoc();

session_start();
$_SESSION["user_id"] = $user["id"];

header("Location: index.php");

?>
