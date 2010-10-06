<?php

require_once("../lib/db.php"); // path is relative to the file that includes this one in admin folder

function require_login() {
  global $db;

  session_start();
  if (! isset($_SESSION["user_id"])) {
    redirect_to_login();
  }

  $id = $_SESSION["user_id"];

  $user_result = $db->query("select * from users where id = '$id'");

  if ($user_result->num_rows == 0) {
    redirect_to_login();
  }

  $user = $user_result->fetch_assoc();

  if ($user["id"] != $_SESSION["user_id"]) {
    redirect_to_login();
  }
}

function redirect_to_login() {
    header("Location: login.php");
}

?>
