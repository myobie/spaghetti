<?php

session_start();
$_SESSION["user_id"] = "";

header("Location: index.php");

?>
