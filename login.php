<?php
// Authenticate
require 'class.AuthenticationManager.php';

// START OF XOOPS MODULE STUFF
  /*
  **  Retrieve USER info (uid)
  **
  */

  if (!$xoopsUser) {
      header('Location: ' . XOOPS_URL . '/user.php');

      exit();
  } elseif ($xoopsUser) {
      $_POST['username'] = $xoopsUser->getVar('uname');

      $_POST['password'] = 'checkxoopsusers';
  }

  //
  //	if (!$authenticationManager->userExists($_POST["username"]))
  //		xoopsAddTimesheetUser($username);
  //

//check that this form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    //try logging the user in

    if (!$authenticationManager->login($_POST['username'], $_POST['password'])) {
        $loginFailure = true;
    } else {
        if (!empty($_REQUEST['redirect'])) {
            header("Location: $_REQUEST[redirect]");
        } else {
            header('Location: index.php');
        }

        exit();
    }
} else {
    //destroy the session by logging out

    $authenticationManager->logout();
}

function printMessage($message)
{
    print '<tr>' .
                '	<td>&nbsp;</td>' .
                '	<td colspan="3">' .
                '		<table width="100%" border="0" bgcolor="black" cellspacing="0" cellpadding="1">' .
                '			<tr>' .
                '				<td>' .
                '					<table width="100%" border="0" bgcolor="yellow">' .
                "						<tr><td class=\"login_error\">$message</td></tr>" .
                '					</table>' .
                '				</td>' .
                '			</tr>' .
                '		</table>' .
                '	</td>' .
                '</tr>';
}

$redirect = $_REQUEST['redirect'] ?? '';

////////////////////////////////////////////////////////////////////////////
function xoopsAddTimesheetUser($username)
{
    include 'table_names.inc';

    global $xoopsUser;

    $level = 1;

    $email_address = $xoopsUser->getVar('email');

    $first_name = $xoopsUser->getVar('name');

    dbquery("INSERT INTO $USER_TABLE (username, level, password, allowed_realms, first_name, " .
                                'last_name, email_address, phone, bill_rate, time_stamp, status) ' .
                                "VALUES ('$username',$level,'not used','.*','$first_name'," .
        "'','$email_address','','0',0,'OUT')");

    dbquery("INSERT INTO $ASSIGNMENTS_TABLE VALUES (1,'$username' )"); // add default project.
        dbquery("INSERT INTO $TASK_ASSIGNMENTS_TABLE VALUES (1,'$username', 1)"); // add default task
}
////////////////////////////////////////////////////////////////////////////

?>

<!-- <html> -->
<!-- <head> -->

<title>Timesheet Login</title>
<?php
include('header.inc');
?>
<!-- </head> -->

<body onLoad="document.loginForm.username.focus();">

<form action="login.php" method="POST" name="loginForm" style="margin: 0px;">
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>"></input>

<table border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td style="padding-top: 100;">

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading" nowrap>
							Timesheet Login
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

			<table width="300" cellspacing="0" cellpadding="5" class="box">
				<tr>
					<td><img class="login_image" src="images/spacer.gif"></td>
					<td class="label">Username:<br><input type="text" name="username" size="25" maxlength="25"></td>
					<td class="label">Password:<br><input type="password" name="password" size="25" maxlength="25"></td>
					<td class="label"><br><input type="submit" name="Login" value="submit"></td>
				</tr>
				<?php	if (isset($loginFailure)) {
    printMessage($authenticationManager->getErrorMessage());
} elseif (isset($_REQUEST['clearanceRequired'])) {
    printMessage("$_REQUEST[clearanceRequired] clearance is required for the page you have tried to access.");
}
                ?>
			</table>
					
<!-- include the timesheet face up until the end -->
<?php include 'timesheet_face_part_3.inc'; ?>
	
		</td>
	</tr>
</table>

</form>

<?php
include('xoops_footer.php');
?>

<!-- </BODY> -->
<!-- </HTML> -->

