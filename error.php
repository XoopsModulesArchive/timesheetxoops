<?php
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';

if (file_exists('./language/' . $xoopsConfig['language'] . '/common.php')) {
    include './language/' . $xoopsConfig['language'] . '/common.php';
} else {
    include './language/english/common.php';
}

//continue session
session_start();

//get the logged in user
$loggedInUser = $_SESSION['loggedInUser'];

//load local vars from superglobals
$errormsg = stripslashes($_REQUEST['errormsg']);

//define the command menu
$commandMenu->add(new TextCommand(_TSX_GEN_BACK, true, 'javascript:back()'));

?>
<!-- <html> -->
<!-- <head> -->

    <TITLE>Error, <?php echo $loggedInUser; ?></TITLE>
<?php
include('header.inc');
?>
<!-- </head> -->

<BODY <?php include('body.inc'); ?> >
<?php
include('banner.inc');
include('error.inc');
include('footer.inc');
?>
<!-- </BODY> -->
<!-- </HTML> -->
