<?php
// $Header: /cvsroot/tsheet/timesheet.php/task_action.php,v 1.7 2005/05/23 07:32:00 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('taskadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$action = $_REQUEST['action'];
$task_id = $_REQUEST['task_id'] ?? 0;
$proj_id = $_REQUEST['proj_id'];

if ('add' == $action || 'edit' == $action) {
    $name = $_REQUEST['name'];

    $description = $_REQUEST['description'];

    $assigned = $_REQUEST['assigned'] ?? [];

    $task_status = $_REQUEST['task_status'];
}

if (!isset($action)) {
    header("Location: $HTTP_REFERER");
} elseif ('add' == $action) {
    $name = addslashes($name);

    $description = addslashes($description);

    //create a time string for >>now<<

    $time_string = date('Y-m-d H:i:00');

    [$qh, $num] = dbQuery(
        "INSERT INTO $TASK_TABLE (proj_id, name, description, assigned, started, status) VALUES " . "('$proj_id', '$name','$description', " . "'$time_string', '$time_string', '$task_status')"
    );

    $task_id = dbLastID($dbh);

    if (isset($assigned)) {
        while (list(, $username) = each($assigned)) {
            dbQuery("INSERT INTO $TASK_ASSIGNMENTS_TABLE (proj_id, task_id, username) VALUES ($proj_id, $task_id, '$username')");
        }
    }

    // redirect to the task management page (we're done)

    header("Location: task_maint.php?proj_id=$proj_id");
} elseif ('edit' == $action) {
    $name = addslashes($name);

    $description = addslashes($description);

    $query = "UPDATE $TASK_TABLE set name='$name',description='$description'," .
                " status='$task_status' " .
                " where task_id=$task_id";

    [$qh, $num] = dbquery($query);

    if ($assigned) {
        dbQuery("Delete from $TASK_ASSIGNMENTS_TABLE where task_id = $task_id");

        while (list(, $username) = each($assigned)) {
            dbQuery("INSERT INTO $TASK_ASSIGNMENTS_TABLE(proj_id, task_id, username) VALUES ($proj_id, $task_id, '$username')");
        }
    }

    // we're done so redirect to the task management page

    header("Location: task_maint.php?proj_id=$proj_id");
} elseif ('delete' == $action) {
    dbQuery("delete from $TASK_TABLE where task_id = $task_id");

    dbQuery("delete from $TASK_ASSIGNMENTS_TABLE where task_id = $task_id");

    header("Location: task_maint.php?proj_id=$proj_id");
}


    


