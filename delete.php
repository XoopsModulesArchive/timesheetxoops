<?php
// Authenticate
require 'class.AuthenticationManager.php';
if (!$authenticationManager->isLoggedIn()) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$trans_num = $_REQUEST['trans_num'];

dbQuery("delete from $TIMES_TABLE where trans_num=$trans_num AND uid='$contextUser'");
header("Location: $_SERVER[HTTP_REFERER]");

