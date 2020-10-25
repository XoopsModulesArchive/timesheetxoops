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

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//make sure "No Client exists with client_id of 1
//execute the query
tryDbQuery("INSERT INTO $CLIENT_TABLE VALUES (1,'No Client', 'This is required, do not edit or delete this client record', '', '', '', '', '', '', '', '', '', '', '', '', '', '');");
tryDbQuery("UPDATE $CLIENT_TABLE set organisation='No Client' WHERE client_id='1'");

//define the command menu
include 'timesheet_menu.inc';

?>

<!-- <html> -->
<!-- <head> -->

<TITLE>Client Management Page</TITLE>
<?php
include('header.inc');
?>
<script language="Javascript">

	function delete_client(clientId) {
				if (confirm('Are you sure you want to delete this client?'))
					location.href = 'client_action.php?client_id=' + clientId + '&action=delete';
	}

</script>
<!-- </head> -->

<BODY <?php include('body.inc'); ?> >
<?php
include('banner.inc');
?>
<form action="client_action.php" method="post">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading">
							Clients
						</td>
						<td align="right">
							<a href="client_add.php" class="outer_table_action"><?echo _TSX_CLIENT_ADD ?></A>
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_body">
<?php

//execute the query
[$qh, $num] = dbQuery("select * from $CLIENT_TABLE where client_id > 1 order by organisation");

//are there any results?
if (0 == $num) {
    print '<tr><td align="center" colspan="5"><br>There are currently no clients.<br><br></td></tr>';
} else {
    ?>
					<tr class="inner_table_head">
						<td class="inner_table_column_heading"><?echo _TSX_CLIENT_ORG ?></td>
						<td class="inner_table_column_heading"><?echo _TSX_CLIENT_CN ?></td>
						<td class="inner_table_column_heading"><?echo _TSX_CLIENT_PH ?></td>
						<td class="inner_table_column_heading"><?echo _TSX_CLIENT_EMAIL ?></td>
						<td class="inner_table_column_heading"><i><?echo _TSX_GEN_ACT ?></i></td>
					</tr>			
<?php

    while ($data = dbResult($qh)) {
        $organisationField = stripslashes($data['organisation']);

        if (empty($organisationField)) {
            $organisationField = '&nbsp;';
        }

        $contactNameField = $data['contact_first_name'] . '&nbsp;' . $data['contact_last_name'];

        $phoneField = $data['phone_number'];

        if (empty($phoneField)) {
            $phoneField = '&nbsp;';
        }

        $emailField = $data['contact_email'];

        if (empty($emailField)) {
            $emailField = '&nbsp;';
        }

        print '<tr>';

        print "<td class=\"calendar_cell_middle\"><A HREF=\"javascript:void(0)\" ONCLICK=window.open(\"client_info.php?client_id=$data[client_id]\",\"ClientInfo\",\"location=0,directories=no,status=no,menubar=no,resizable=1,width=480,height=240\")>$organisationField</A></TD>";

        print "<td class=\"calendar_cell_middle\">$contactNameField</td>";

        print "<td class=\"calendar_cell_middle\">$phoneField</td>";

        print "<td class=\"calendar_cell_middle\">$emailField</td>";

        print "<td class=\"calendar_cell_disabled_right\">\n";

        print "	<a href=\"javascript:delete_client($data[client_id]);\">" . _TSX_TS_DEL . "</a>,&nbsp;\n";

        print "	<a href=\"client_edit.php?client_id=$data[client_id]\">" . _TSX_TS_EDIT . "</a>\n";

        print "</td>\n";
    }
}
?>
				</TABLE>
			</td>
		</tr>
	</table>

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
