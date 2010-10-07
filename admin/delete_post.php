<?php

require_once("../lib/db.php");
require_once("../lib/markdown.php");
require_once("../lib/admin_helpers.php");

require_login();

// Validation
if (! isset($_POST["id"])) {

    header("Location: index.php");

}

$id = $db->real_escape_string($_POST["id"]);

$result = $db->query("delete from posts where id = '$id'");

header("Location: posts.php");

?>


