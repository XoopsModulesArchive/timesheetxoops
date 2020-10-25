<?php
// $Header: /cvsroot/tsheet/timesheet.php/user_maint.php,v 1.7 2005/02/03 09:15:44 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('useradmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/user.php')) {
    include './language/' . $xoopsConfig['language'] . '/user.php';
} else {
    include './language/english/user.php';
}

// Connect to database.
$dbh = dbConnect();

//define the command menu
include 'timesheet_menu.inc';

?>
<head><title>User Management Page</title>
<?php
include('header.inc');
?>
<script language="javascript">

	function deleteUser(uid, username)
	{
		//get confirmation
		if (confirm("<?echo _TSX_USER_CONFDEL1?> '" + username + "' <?echo _TSX_USER_CONFDEL2?>"))
		{	
			document.userForm.action.value = "delete";
			document.userForm.uid.value = uid;
			document.userForm.username.value = username;
			document.userForm.submit();
		}
	}

	function editUser(uid, firstName, lastName, username, emailAddress, phone, billRate)
	{
		document.userForm.uid.value = uid;
		//document.userForm.first_name.value = firstName;
		document.userForm.last_name.value = lastName;
		document.userForm.username.value = username;
		document.userForm._username.value = username;
		document.userForm.email_address.value = emailAddress;
		//document.userForm.phone.value = phone
		document.userForm.bill_rate.value = billRate;
		//document.userForm.password.value = password;
		//document.userForm.checkAdmin.checked = isAdministrator;
		onCheckAdmin();
		document.location.href = "#AddEdit";
	}

	function importUser(name,username,emailAddress,phone,billRate) {
        document.userForm.action.value = "create";
		document.userForm._username.value = username;
		document.userForm.username.value = username;
		document.userForm.last_name.value = name;
		document.userForm.email_address.value = emailAddress;
		document.userForm.bill_rate.value = billRate;
		document.userForm.bill_rate.focus();
	}
	function addUser()
	{
		//validation
		if (document.userForm.username.value == "")
			alert("You must enter a username that the user will log on with.");
		else
		{
			document.userForm.action.value = "addupdate";
			document.userForm.submit();
		}
	}
	
	function onCheckAdmin() {
		//document.userForm.isAdministrator.value =
		//	document.userForm.checkAdmin.checked;
	}
	
</script>
<!-- </head> -->

<BODY <?php include('body.inc'); ?> >
<?php
include('banner.inc');
?>
<form action="user_action.php" name="userForm" method="post">
<input type="hidden" name="action" value="">
<input type="hidden" name="uid" value="">
	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>
	
				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading">
								<?echo _TSX_USER_TITLE ?>:
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_body">
					<tr class="inner_table_head">										
						<!--td class="inner_table_column_heading"><?echo _TSX_USER_FN ?></td-->
						<td class="inner_table_column_heading">Name</td>
						<td class="inner_table_column_heading"><?echo _TSX_USER_LU ?></td>
						<td class="inner_table_column_heading"><?echo _TSX_USER_EMAIL ?></td>
						<!--td class="inner_table_column_heading"><?echo _TSX_USER_PHONE ?></td-->
						<td class="inner_table_column_heading"><?echo _TSX_USER_BR ?></td>
						<td class="inner_table_column_heading"><i><?echo _TSX_GEN_ACT ?></i></td>
					</tr>				
<?php

//list($qh,$num) = dbQuery("select * from $USER_TABLE where username!='guest' order by last_name, first_name");

[$qh, $num] = dbQuery("select *, $USER_TABLE.uid as tsx_uid, xoop.email as xoops_email, xoop.name as xoops_name from $USER_TABLE, $XOOPS_USER_TABLE xoop where username = xoop.uname order by last_name, first_name");

while ($data = dbResult($qh)) {
    $firstNameField = empty($data['first_name']) ? '&nbsp;' : $data['first_name'];

    $lastNameField = empty($data['xoops_name']) ? '&nbsp;' : $data['xoops_name'];

    $usernameField = empty($data['username']) ? '&nbsp;' : $data['username'];

    $emailAddressField = empty($data['xoops_email']) ? '&nbsp;' : $data['xoops_email'];

    $phoneField = empty($data['phone']) ? '&nbsp;' : $data['phone'];

    $billRateField = empty($data['bill_rate']) ? '&nbsp;' : $data['bill_rate'];

    //	$isAdministrator = ($data["level"] >= 10);

    print "<tr>\n";

    //print "<td class=\"calendar_cell_middle\">$firstNameField</td>";

    print "<td class=\"calendar_cell_middle\">$lastNameField</td>";

    print "<td class=\"calendar_cell_middle\">$usernameField</td>";

    print "<td class=\"calendar_cell_middle\">$emailAddressField</td>";

    //print "<td class=\"calendar_cell_middle\">$phoneField</td>";

    print "<td class=\"calendar_cell_middle\">$billRateField</td>";

    print '<td class="calendar_cell_disabled_right">';

    print "	<a href=\"javascript:deleteUser('$data[tsx_uid]', '$data[username]')\">" . _TSX_GEN_DEL . "</a>,&nbsp;\n";

    print " <a href=\"javascript:editUser('$data[tsx_uid]', '-', '$data[xoops_name]', '$data[username]', '$data[xoops_email]', '', '$data[bill_rate]')\">" . _TSX_GEN_EDIT . "</a>\n";

    print "</td>\n";

    print "</tr>\n";
}
?>
				</table>
			</td>
		</tr>
	</table>
	
<!-- include the timesheet face up until the end -->
<?php include 'timesheet_face_part_3.inc'; ?>

		</td>
	</tr>
</table>
		
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading">
							<a name="AddEdit">	<?echo _TSX_USER_LBL?>:</a>
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>			
				<table width="100%" border="0" class="table_body">
					<tr>
						<!--td>First name:<br><input size="20" DISABLED name="first_name" style="width: 100%;"></td-->
						<TD>Name:<br><input size="20" DISABLED name="last_name" style="width: 100%;"></td>
						<TD>Login:<br><input size="20" DISABLED name="_username" style="width: 100%;"><input type="hidden" name="username"></td>
						<TD>Email address:<br><input size="35" DISABLED name="email_address" style="width: 100%;"></td>
						<!--TD>Phone:<br><input size="20" name="phone" DISABLED style="width: 100%;"></td-->
						<TD>Bill rate:<br><input size="20" name="bill_rate" style="width: 100%;"></td>
					</tr>
					<tr>
					</tr>
				</table>
			</td>			
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" class="table_bottom_panel">
					<tr>
						<td align="center">
							<input type="button" name="addupdate" value="<?echo _TSX_USER_LBL?>" onclick="javascript:addUser()" class="bottom_panel_button">
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<!--
        //
        // BEGIN Xoops User Management Hack
        //
        -->
	
	<div style="width:250px;margin-top:20px;text-align:center;">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_body">
					<tr class="inner_table_head">										
						<td class="inner_table_column_heading"><?echo _TSX_USER_LU ?></td>
						<td class="inner_table_column_heading"><i>Actions</i></td>
					</tr>				
                    <?php

                    [$qh, $num] = dbQuery("select * from $USER_TABLE where username!='guest'");

                    $users = [];
                    while ($data = dbResult($qh)) {
                        if ('' != $data['username']) {
                            $users[] = $data['username'];
                        }
                    }

                    [$qh, $num] = dbQuery("select * from $XOOPS_USER_TABLE WHERE uname NOT IN ('" . implode("', '", $users) . "')");

                    while ($data = dbResult($qh)) {
                        $nameField = empty($data['name']) ? '&nbsp;' : $data['name'];

                        $usernameField = empty($data['uname']) ? '&nbsp;' : $data['uname'];

                        $link = "<a href=\"javascript:importUser('$data[name]', '$data[uname]','$data[email]','','')\">Add</a>";

                        print "<tr>\n";

                        print "<td class=\"calendar_cell_middle\">$nameField ($usernameField)</td>";

                        print "<td class=\"calendar_cell_disabled_right\">$link</td>";

                        print "</tr>\n";
                    }
                    ?>
				</table>
        </div>

	
<!--
        //
        // END Xoops User Management Hack
        //
        -->
	
	
<!-- include the timesheet face up until the end -->
<?php include 'timesheet_face_part_3.inc'; ?>

		</td>
	</tr>
</table>
			
</form>
<?php
include('footer.inc');
?>
<!-- </BODY> -->
<!-- </HTML> -->

