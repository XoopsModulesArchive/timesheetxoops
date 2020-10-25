<?php

// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('clientadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}
if (file_exists('./language/' . $xoopsConfig['language'] . '/client.php')) {
    include './language/' . $xoopsConfig['language'] . '/client.php';
} else {
    include './language/english/client.php';
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/common.php')) {
    include './language/' . $xoopsConfig['language'] . '/common.php';
} else {
    include './language/english/common.php';
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//define the command menu
$commandMenu->add(new TextCommand(_TSX_GEN_BACK, true, 'javascript:history.back()'));

?>
<!-- <html> -->
<!-- <head> -->

<title>Add a new Client</title>
<?php include('header.inc'); ?>
<!-- </head> -->

<body <?php include('body.inc'); ?> >
<?php include('banner.inc'); ?>
<form action="client_action.php" method="post">
<input type="hidden" name="action" value="add">

<table width="600" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading" nowrap>
							Add New Client
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>			
				<table width="100%" border="0" cellpadding="1" cellspacing="2" class="table_body">
					<tr>
						<td align="right"><?echo _TSX_CLIENT_ORG?>:</td>
						<td><input size="60" name="organisation" style="width: 100%;" maxlength="64"></td>
					</tr>
					<tr>
						<td valign="top" align="right"><?echo _TSX_CLIENT_DESC?>:</td>
						<td><textarea name="description" rows="4" cols="58" style="width: 100%;"></textarea></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_ADDR1?>:</td>
						<td><input size="60" name="address1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_ADDR2?>:</td>
						<td><input size="60" name="address2" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_CITY?>:</td>
						<td><input size="60" name="city" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_CTRY?>:</td>
						<td><input size="60" name="country" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_PC?>:</td>
						<td><input size="13" name="postal_code"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_FN?>:</td>
						<td><input size="60" name="contact_first_name" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_LN?>:</td>
						<td><input size="60" name="contact_last_name" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_UN?>:</td>
						<td><input size="32" name="client_username" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_EMAIL?>:</td>
						<td><input size="60" name="contact_email" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_PHONE?>:</td>
						<td><input size="20" name="phone_number" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_FAX?>:</td>
						<td><input size="20" name="fax_number" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_MOBILE?>:</td>
						<td><input size="20" name="gsm_number" style="width: 100%;"></td>
					</tr>
					<tr>
						<td align="right"> <?echo _TSX_CLIENT_WEB?>:</td>
						<td><input size="60" name="http_url" style="width: 100%;"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>						
			<td>
				<table width="100%" border="0" class="table_bottom_panel">
					<tr>
						<td align="center">
							<input type="submit" name="add" value="Add New Client">
						</td>
					</tr>
				</table>
			</td>		</tr>
	</table>	

<!-- include the timesheet face up until the end -->
<?php include 'timesheet_face_part_3.inc'; ?>

		</td>
	</tr>
</table>
		
</form>
	
<?php include('footer.inc'); ?>
<!-- </BODY> -->
<!-- </HTML> -->

