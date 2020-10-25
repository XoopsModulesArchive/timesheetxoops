<?php
// $Header: /cvsroot/tsheet/timesheet.php/reports.php,v 1.5 2005/03/02 22:22:38 stormer Exp $

// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('report')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/report.php')) {
    include './language/' . $xoopsConfig['language'] . '/report.php';
} else {
    include './language/english/report.php';
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$uid = $_REQUEST['uid'] ?? $contextUser;

//define the command menu
include 'timesheet_menu.inc';

// Set default months
setReportDate($year, $month, $day, $next_week, $prev_week, $next_month, $prev_month, $time, $time_middle_month);

?>
<?php include('header.inc'); ?>
<!-- </head> -->

<body <?php include('body.inc'); ?> >
<?php include('banner.inc'); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading">
							<?php echo _TSX_REPORT_TITLE ?>
						</td>
						<td align="left" nowrap class="outer_table_heading">
			  			<?php echo date('F d, Y', $time) ?>
						</td>
						<td align="right" nowrap>
						<?php
                            printPrevNext($time, $next_week, $prev_week, $next_month, $prev_month, $time_middle_month, $uid);
                        ?>
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_body">
					<tr class="inner_table_head">
						<td class="inner_table_column_heading"><?echo _TSX_REPORT_DESC_TITLE ?></td>
						<td class="inner_table_column_heading"><?echo _TSX_GEN_ACT ?></td>
					</tr>				
					<tr>
						<td class="calendar_cell_middle"><?echo _TSX_REPORT_HWSU_TITLE ?></td>
						<td class="calendar_cell_disabled_right">
							<a href="admin_report_specific_user.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=monthly"><?echo _TSX_REPORT_GEN_MONTH ?></a> /
							<a href="admin_report_specific_user.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=weekly"><?echo _TSX_REPORT_GEN_WEEK ?></a>
						</td>
					<tr>
					<tr>
						<td class="calendar_cell_middle"><?echo _TSX_REPORT_HWSP_TITLE ?></td>
						<td class="calendar_cell_disabled_right">
							<a href="admin_report_specific_project.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=monthly"><?echo _TSX_REPORT_GEN_MONTH ?></a> /
							<a href="admin_report_specific_project.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=weekly"><?echo _TSX_REPORT_GEN_WEEK ?></a>
						</td>
					</tr>
					<tr>
						<td class="calendar_cell_middle"><?echo _TSX_REPORT_HWSC_TITLE ?></td>
						<td class="calendar_cell_disabled_right">
							<a href="admin_report_specific_client.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=monthly"><?echo _TSX_REPORT_GEN_MONTH ?></a> /
							<a href="admin_report_specific_client.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=weekly"><?echo _TSX_REPORT_GEN_WEEK ?></a>
						</td>
					</tr>
					<tr>
						<td class="calendar_cell_middle"><?echo _TSX_REPORT_HWAUAP_TITLE ?></td>
						<td class="calendar_cell_disabled_right">
							<a href="admin_report_all.php?month=<?php print $month; ?>&year=<?php print $year; ?>&mode=monthly"><?echo _TSX_REPORT_GEN_MONTH ?></a>
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
		
<?php
include('footer.inc');
?>

