<?php
// $Header: /cvsroot/tsheet/timesheet.php/config.php,v 1.8 2005/02/03 08:06:10 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('configadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/config.php')) {
    include './language/' . $xoopsConfig['language'] . '/config.php';
} else {
    include './language/english/config.php';
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//define the command menu
include 'timesheet_menu.inc';

//Get the result set for the config set 1
[$qh, $num] = dbQuery(
    'select locale, timezone, timeformat, headerhtml, bodyhtml, footerhtml, ' . 'errorhtml, bannerhtml, tablehtml, weekstartday ' . "from $CONFIG_TABLE where config_set_id = '1'"
);
$resultset = dbResult($qh);

?>
<title>Timesheet.php Configuration Parameters</title>
<?php
include('header.inc');
?>

<script language="Javascript">



function onSubmit() {
	
	//submit the form
	document.configurationForm.submit();
}


</script>
<body <?php include('body.inc'); ?> >
<?php
include('banner.inc');
?>
<form action="config_action.php" name="configurationForm" method="post">
<input type="hidden" name="action" value="edit">							

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

				<table width="100%" border="0">
					<tr>
						<td align="left" nowrap class="outer_table_heading" nowrap>
							<?echo _TSX_CONFIG_TITLE ?>
						</td>
					</tr>
					<tr>
						<td>
						<?php echo _TSX_CONFIG_INTRO ?>
						</td>
					</tr>
				</table>

<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_2.inc'; ?>

	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="outer_table">
		<tr>
			<td>			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_body">					
					<tr>
						<td>
						

				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">		
		
		<!-- locale -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_LOC ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_LOCDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="localeReset" value="off" valign="absmiddle" onclick="document.configurationForm.locale.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<input type="text" name="locale" size="75" maxlength="254" value="<?php echo htmlentities(trim(stripslashes($resultset['locale'])), ENT_QUOTES | ENT_HTML5); ?>" style="width: 100%;">
				</td>
			</tr>
			
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">					
			
		<!-- timezone -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_TZ ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_TZDSC ?></code>.
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="timezoneReset" value="off" onclick="document.configurationForm.timezone.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<input type="text" name="timezone" size="75" maxlength="254" value="<?php echo htmlentities(trim(stripslashes($resultset['timezone'])), ENT_QUOTES | ENT_HTML5); ?>" style="width: 100%;">
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">	
			
			<!-- timeformat -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_TF ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_TFDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
				 <input type="checkbox" name="timeformatReset" value="off" onclick="document.configurationForm.timeformat.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<select name="timeformat" style="width: 100%;">
						<?php if ('12' == $resultset['timeformat']) { ?>
							<option value="12" selected>12 hour format</option>
							<option value="24">24 hour format</option>
						<?php } else { ?>
							<option value="12">12 hour format</option>
							<option value="24" selected>24 hour format</option>
						<?php } ?>
					</select>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">

			<!-- weekstartday -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_WSD ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_WSDDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
				 <input type="checkbox" name="weekStartDayReset" value="off" onclick="document.configurationForm.weekstartday.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<select name="weekstartday" style="width: 100%;">					
						<?php
                                //get the current time
                                $dowDate = time();

                                //make it sunday
                                $dowDate -= (24 * 60 * 60) * date('w', $dowDate);

                                //for each day of the week
                                for ($i = 0; $i < 7; $i++) {
                                    $dowString = strftime('%A', $dowDate);

                                    print "<option value=\"$i\"";

                                    if ($resultset['weekstartday'] == $i) {
                                        print ' selected';
                                    }

                                    print ">$dowString</option>";

                                    //increment the day

                                    $dowDate += (24 * 60 * 60);
                                }
                        ?>
					</select>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">			
			
			<!-- headerhtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_HHTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_HHTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="headerReset" value="off" onclick="document.configurationForm.headerhtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="headerhtml" style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['headerhtml'])), ENT_QUOTES | ENT_HTML5); ?>	</textarea>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">					
			
			<!-- bodyhtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_BHTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_BHTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="bodyReset" value="off" onclick="document.configurationForm.bodyhtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="bodyhtml"  style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['bodyhtml'])), ENT_QUOTES | ENT_HTML5); ?></textarea>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">					

			<!-- bannerhtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_BANHTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_BANHTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="bannerReset" value="off" onclick="document.configurationForm.bannerhtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="bannerhtml" style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['bannerhtml'])), ENT_QUOTES | ENT_HTML5); ?></textarea>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">					
			
			<!-- footerhtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_FHTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_FHTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="footerReset" value="off" onclick="document.configurationForm.footerhtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="footerhtml" style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['footerhtml'])), ENT_QUOTES | ENT_HTML5); ?></textarea>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">	
			
			<!-- errorhtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_EHTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_EHTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="errorReset" value="off" onclick="document.configurationForm.errorhtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="errorhtml" style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['errorhtml'])), ENT_QUOTES | ENT_HTML5); ?></textarea>
				</td>
			</tr>

				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="5" class="section_body">					
			
			
			<!-- tablehtml -->
			<tr>
				<td align="left" valign="top">
					<b><?echo _TSX_CONFIG_LBL_THTML ?></b>:
				</td>
				<td align="left" width="100%">
					<?echo _TSX_CONFIG_LBL_THTMLDSC ?>
				</td>
			</tr>
			<tr>
				<td align="left" class="label" nowrap width="90">
					<input type="checkbox" name="tableReset" value="off" onclick="document.configurationForm.tablehtml.disabled=(this.checked);"><?echo _TSX_CONFIG_RESET?></input>
				</td>
				<td align="left" width="100%">
					<textarea rows="5" cols="73" name="tablehtml" style="width: 100%;"><?php echo htmlentities(trim(stripslashes($resultset['tablehtml'])), ENT_QUOTES | ENT_HTML5); ?></textarea>
				</td>
			</tr>

						</table>
					</td>
				</tr>	
						
				</table>				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_bottom_panel">					

			<!-- form submission -->
			<tr>
				<td colspan="2" align="center">
					<table width="100%">
						<tr>
							<td align="center">
								<input type="button" value="Submit Changes" name="submitButton" id="submitButton" onClick="onSubmit();"></input>
							</td>
					</table>
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
		
<?php
include('footer.inc');
?>
<!-- </BODY> -->
<!-- </HTML> -->

