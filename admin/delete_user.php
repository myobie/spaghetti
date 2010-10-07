<?php

require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! isset($_POST["id"])) {

    header("Location: index.php");

}

$id = $_POST["id"];

$result = $db->query("delete from users where id = '$id'");

header("Location: users.php");

?>




