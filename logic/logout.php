<?php
session_start();

require "Util.php";
$util = new Util();

$_SESSION["member_id"] = "";
session_destroy();

$util->clearAuthCookie();

header("Location: ../");
?>
