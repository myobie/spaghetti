<?php

error_reporting(-1);
ini_set("display_errors", 1);
require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! isset($_POST["id"])) {

    header("Location: index.php");

}

$id = $_POST["id"];

$result = $db->query("delete from comments where id = '$id'");

header("Location: comments.php");

?>



