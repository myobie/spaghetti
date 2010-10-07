<?php

require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! (isset($_POST["id"]) && 
  isset($_POST["token"]) &&
  $_SESSION["token"] == $_POST["token"])) {

    header("Location: index.php");

}

$id = $db->real_escape_string($_POST["id"]);

$result = $db->query("delete from users where id = '$id'");

header("Location: users.php");

?>




