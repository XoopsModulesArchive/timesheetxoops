<?php
//$Header: /cvsroot/tsheet/timesheet.php/proj_maint.php,v 1.10 2005/05/17 03:38:37 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('projectadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

if (file_exists('./language/' . $xoopsConfig['language'] . '/project.php')) {
    include './language/' . $xoopsConfig['language'] . '/project.php';
} else {
    include './language/english/project.php';
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//define the command menu
include 'timesheet_menu.inc';

//set up query
$query = "select distinct $PROJECT_TABLE.title, $PROJECT_TABLE.proj_id, $PROJECT_TABLE.client_id, " .
                        "$CLIENT_TABLE.organisation, $PROJECT_TABLE.description, " .
                        "DATE_FORMAT(start_date, '%M %d, %Y') as start_date, " .
                        "DATE_FORMAT(deadline, '%M %d, %Y') as deadline, " .
                    "$PROJECT_TABLE.proj_status, http_link, proj_leader " .
                    "FROM $PROJECT_TABLE, $CLIENT_TABLE, $USER_TABLE " .
                    'WHERE ';
if (0 != $client_id) {
    $query .= "$PROJECT_TABLE.client_id = $client_id AND ";
}

$query .= "$PROJECT_TABLE.proj_id > 0 AND $CLIENT_TABLE.client_id = $PROJECT_TABLE.client_id " .
                    "ORDER BY $PROJECT_TABLE.title";

?>
<!-- <html> -->
<!-- <head> -->

<title>Projects</title>
<?php
include('header.inc');
?>
<script language="Javascript">

	function delete_project(clientId, projectId) {
				if (confirm('<?echo _TSX_PROJECT_CONF_DELETE ?>'))
					location.href = 'proj_action.php?client_id=' + clientId + '&proj_id=' + projectId + '&action=delete';
	}

</script>
<!-- </head> -->

<body <?php include('body.inc'); ?> >
<?php
include('banner.inc');
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" class="face_padding_cell">
		
<!-- include the timesheet face up until the heading start section -->
<?php include 'timesheet_face_part_1.inc'; ?>

			<table width="100%" border="0">
				<tr>
					<td width="40%">
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><table width="50"><tr><td><?echo _TSX_PROJECT_CLIENT ?>:</td></tr></table></td>
								<td width="100%"><?php client_select_list($client_id, 0, false, false, true, false, 'submit();', false); ?></td>
							</tr>
						</table>
						</form>
					</td>						
					<td align="center" nowrap class="outer_table_heading">
						<?echo _TSX_PROJECT_TITLE ?>
					</td>
					<td align="right" nowrap>
						<a href="proj_add.php?client_id=<?php echo $client_id; ?>"><?echo _TSX_PROJECT_ADD_PROJ ?></a>
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
    [$qh, $num] = dbQuery($query);

    //are there any results?
    if (0 == $num) {
        if (0 != $client_id) {
            print '<tr><td align="center"><br>There are no projects for this client.<br><br></td></tr>';
        } else {
            print '<tr><td align="center"><br>There are no projects.<br><br></td></tr>';
        }
    } else {
        //iterate through results

        for ($j = 0; $j < $num; $j++) {
            //get the current record

            $data = dbResult($qh);

            //strip slashes

            $data['title'] = stripslashes($data['title']);

            $data['organisation'] = stripslashes($data['organisation']);

            $data['description'] = stripslashes($data['description']);

            [$billqh, $bill_num] = dbquery(
                'select sum(unix_timestamp(end_time) - unix_timestamp(start_time)) as total_time, '
                . 'sum(bill_rate * ((unix_timestamp(end_time) - unix_timestamp(start_time))/(60*60))) as billed '
                . "from $TIMES_TABLE, $USER_TABLE "
                . "where end_time > 0 AND $TIMES_TABLE.proj_id = $data[proj_id] AND $USER_TABLE.username = $TIMES_TABLE.uid "
            );

            $bill_data = dbResult($billqh);

            //start the row ?>
								<tr>
									<td>
										<table width="100%" border="0"<?php if ($j + 1 < $num) {
                print 'class="section_body"';
            } ?>>
											<tr>
												<td valign="center">
<?php
            if ('' != $data['http_link']) {
                print "<a href=\"$data[http_link]\"><span class=\"project_title\">$data[title]</span></a>";
            } else {
                print "<span class=\"project_title\">$data[title]</span>";
            }

            print "&nbsp;&nbsp;<span class=\"project_status\">&lt;$data[proj_status]&gt;</span>"
?>
												</td>
												<td align="right">
<?php
            if (isset($data['start_date']) && '' != $data['start_date'] && '' != $data['deadline']) {
                print '<span class="label">' . _TSX_PROJECT_LBL_ST . ":</span> $data[start_date]<br><span class=\"label\">" . _TSX_PROJECT_LBL_DL . ":</span> $data[deadline]";
            } else {
                print '&nbsp;';
            } ?>			
												</td>
												<td align="right" valign="top" nowrap>
													<span class="label"><?echo _TSX_GEN_ACT ?>:</span>
													<a href="proj_edit.php?client_id=<?php echo $client_id; ?>&proj_id=<?php echo $data['proj_id']; ?>"><?echo _TSX_GEN_EDIT ?></a>,
													<a href="javascript:delete_project(<?php echo $client_id; ?>,<?php echo $data['proj_id']; ?>);"><?echo _TSX_GEN_DEL ?></a>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo $data['description']; ?><br></td>			
												<td valign="top" align="right"><span class="label"><?echo _TSX_PROJECT_CLIENT ?>:</span> <?php echo $data['organisation']; ?></td>
											</tr>			
											<tr>
												<td colspan="3" width="100%">
													<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<tr>
															<td width="70%">
																<table border="0" cellpadding="0" cellspacing="0">
																	<tr>
																		<td>											
																			<span class="label"><?echo _TSX_PROJECT_LBL_TT ?>:</span> <?php echo(isset($bill_data['total_time']) ? formatSeconds($bill_data['total_time']) : '0h 0m'); ?><br>
														    	   <span class="label"><?echo _TSX_PROJECT_LBL_TB ?>:</span> <b>$<?php echo($bill_data['billed'] ?? '0.00'); ?></b>
																		</td>												
																	</tr>
																	<tr><td>&nbsp;</td></tr>

																		
<?php

            //display project leader
            print '<tr><td><span class="label">' . _TSX_PROJECT_LBL_PL . ":</span> $data[proj_leader] </td></tr>";

            //display assigned users

            [$qh2, $num_workers] = dbQuery("select distinct username from $ASSIGNMENTS_TABLE where proj_id = $data[proj_id]");

            if (0 == $num_workers) {
                print "<tr><td><font size=\"-1\">Nobody assigned to this project</font></td></tr>\n";
            } else {
                $workers = '';

                print '<tr><td><span class="label">' . _TSX_PROJECT_LBL_AU . ':</span> ';

                for ($k = 0; $k < $num_workers; $k++) {
                    $worker = dbResult($qh2);

                    $workers .= "$worker[username], ";
                }

                $workers = preg_replace(', $', '', $workers);

                print $workers;

                print '</td></tr>';
            } ?>


																</table>							    	  
															</td>
															<td width="30%">
																<div class="project_task_list">
																	<a href="task_maint.php?proj_id=<?php echo $data['proj_id']; ?>"><span class="label">Tasks:</span></a>&nbsp; &nbsp;<br>
<?php
            //get tasks
            [$qh3, $num_tasks] = dbQuery("select name, task_id FROM $TASK_TABLE WHERE proj_id=$data[proj_id]");

            //are there any tasks?

            if ($num_tasks > 0) {
                while ($task_data = dbResult($qh3)) {
                    $taskName = str_replace(' ', '&nbsp;', $task_data['name']);

                    print "<a href=\"javascript:void(0)\" onclick=window.open(\"task_info.php?proj_id=$data[proj_id]&task_id=$task_data[task_id]\",\"TaskInfo\",\"location=0,directories=no,status=no,menubar=no,resizable=1,width=550,height=220\")>$taskName</a><br>";
                }
            } else {
                print 'None.';
            } ?>						
																</div>
															</td>
														</tr>
													</table>
						 						</td>
						 					</tr>
						 				</table>
						 			</td>
						 		</tr>
 					
<?php
        }
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
					
<?php
include('footer.inc');
?>
<!-- </BODY> -->
<!-- </HTML> -->


