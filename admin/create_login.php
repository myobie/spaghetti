<?php

function reload_login_form() {
  $login_error = true;
  include("login.php");
  exit();
}

// Validation
if (! (isset($_POST["email"]) && isset($_POST["password"]))) {
  reload_login_form();
}

require_once("../lib/db.php");

$email = $_POST["email"];
$password = $_POST["password"];

$user_result = $db->query("select * from users where email = '$email' and password = '$password'");

if ($user_result->num_rows == 0) {
  reload_login_form();
}

$user = $user_result->fetch_assoc();

session_start();
$_SESSION["user_id"] = $user["id"];

header("Location: index.php");

?>
