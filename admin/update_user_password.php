<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["user"]) && 
  isset($_POST["user"]["password"]) && 
  isset($_POST["user"]["password_confirmation"]) && 
  $_POST["user"]["password"] == $_POST["user"]["password_confirmation"])) {

    $id = $_POST["user"]["id"];
    header("Location: edit_user.php?id=$id&password_error=true");
    exit();

}

$id = $db->real_escape_string($_POST["user"]["id"]);
$password = $db->real_escape_string($_POST["user"]["password"]);

$result = $db->query("update users set password = '$password' where id = '$id'");

header("Location: edit_user.php?id=$id&updated_password=true");

?>




