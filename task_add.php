<?php
// $Header: /cvsroot/tsheet/timesheet.php/task_add.php,v 1.6 2004/07/02 14:15:56 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('taskadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/common.php')) {
    include './language/' . $xoopsConfig['language'] . '/common.php';
} else {
    include './language/english/common.php';
}
if (file_exists('./language/' . $xoopsConfig['language'] . '/task.php')) {
    include './language/' . $xoopsConfig['language'] . '/task.php';
} else {
    include './language/english/task.php';
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$proj_id = $_REQUEST['proj_id'];

//define the command menu
$commandMenu->add(new TextCommand(_TSX_GEN_BACK, true, 'javascript:history.back()'));

?>
<!-- <html> -->
<!-- <head> -->

	<title>Add New Task</title>
<?php include('header.inc'); ?>
<!-- </head> -->

<body <?php include('body.inc'); ?> >
<?php include('banner.inc'); ?>

<form action="task_action.php" method="post">
<input type="hidden" name="action" value="add">
<input type="hidden" name="proj_id" value="<?php echo $proj_id ?>">

<table width="600" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading" nowrap>
							<?echo _TSX_TASK_ADD_TASK ?>:
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
						<td align="right"><?echo _TSX_TASK_LBL_TN?>:</td>
						<td><input type="text" name="name" size="42" style="width: 100%"></td>
					</tr>
					<tr>
						<td align="right" valign="top"><?echo _TSX_TASK_LBL_DS?>:</td>
						<td><textarea name="description" rows="4" cols="40" wrap="virtual" style="width: 100%"></textarea></td>
					</tr>
					<tr>
						<td align="right"><?echo _TSX_TASK_LBL_SU?>:</td>
						<td><?php proj_status_list('task_status', 'Started'); ?></td>
					</tr>
					<tr>
						<td align="right" valign="top"><?echo _TSX_TASK_LBL_AS?>:</td>
						<td><?php multi_user_select_list('assigned[]'); ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>						
			<td>
				<table width="100%" border="0" class="table_bottom_panel">
					<tr>
						<td align="center">
							<input type="submit" value="<?echo _TSX_TASK_ADD_TASK?>">
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	

<!-- include the timesheet face up until the end -->
<?php include 'timesheet_face_part_3.inc'; ?>

		</td>
	</tr>
</table>
	
</form>
	
<?php include 'footer.inc'; ?>
<!-- </BODY> -->
<!-- </HTML> -->
