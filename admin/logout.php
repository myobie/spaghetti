<?php

session_start();
$_SESSION["user_id"] = "";
$_SESSION["user_token"] = "";

header("Location: index.php");

?>
