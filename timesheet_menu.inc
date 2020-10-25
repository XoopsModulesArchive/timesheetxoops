<?php
if ( file_exists('./language/' . $xoopsConfig['language'] . '/common.php') ) {
	include './language/' . $xoopsConfig['language'] . '/common.php';
} else {
	include './language/english/common.php';
}

if ( file_exists('./language/' . $xoopsConfig['language'] . '/timesheet.php') ) {
	include './language/' . $xoopsConfig['language'] . '/timesheet.php';
} else {
	include './language/english/timesheet.php';
}

//load local vars from superglobals
$year = $_REQUEST["year"] ?? (int)date("Y");
$month = $_REQUEST["month"] ?? (int)date("m");
$day = $_REQUEST["day"] ?? (int)date("j");
$proj_id = $_REQUEST["proj_id"] ?? 0;
$task_id = $_REQUEST["task_id"] ?? 0;
$client_id = $_REQUEST["client_id"] ?? 0;

//get todays values
$today = time();
$todayYear = date('Y', $today);
$todayMonth = date('n', $today);
$todayDay = date('j', $today);

//default values to today if not set
if (empty($_REQUEST['year']))
	$year = $todayYear;
if (empty($_REQUEST['month']))
	$month = $todayMonth;
if (empty($_REQUEST['day']))
	$day = $todayDay;

// View mode (monthly, weekly, all)
if (isset($_REQUEST['mode']))
	$mode = $_REQUEST['mode'];
else
	$mode = 'all';
if (!($mode == 'all' || $mode == 'monthly' || $mode == 'weekly'))
	$mode = 'all';

//define the command menu
$popup_href = "javascript:void(0)\" onclick=window.open(\"stopwatch.php?client_id=$client_id&proj_id=$proj_id&task_id=$task_id&destination=$_SERVER[PHP_SELF]\",\"Stopwatch\",\"location=0,directories=no,status=no,menubar=no,resizable=1,width=420,height=220\") dummy=\"";
$commandMenu->add(new IconTextCommand(_TSX_MENU_STOPW, true, $popup_href, 'images/icon_stopwatch.gif'));
$commandMenu->add(new IconTextCommand(_TSX_MENU_DTS, true, "daily.php?client_id=$client_id&proj_id=$proj_id&task_id=$task_id&month=$todayMonth&year=$todayYear&day=$todayDay", 'images/icon_daily.gif'));
$commandMenu->add(new IconTextCommand(_TSX_MENU_WTS, true, "weekly.php?month=$todayMonth&year=$todayYear&day=$todayDay", 'images/icon_daily.gif'));
$commandMenu->add(new IconTextCommand(_TSX_MENU_CAL, true, "index.php?month=$month&year=$year&day=$day", 'images/icon_calendar.gif'));
$commandMenu->add(new IconTextCommand(_TSX_MENU_STS, true, "simple.php?client_id=$client_id&proj_id=$proj_id&task_id=$task_id&month=$todayMonth&year=$todayYear&day=$todayDay", 'images/icon_daily.gif'));

//add administrator menu options?

if ($authenticationManager->isInAdminGroup('report')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_REP, true, 'reports.php', 'images/icon_reports.gif'));
}
if ($authenticationManager->isInAdminGroup('clientadmin')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_CLIENT, true, 'client_maint.php', 'images/icon_clients.gif'));
}
if ($authenticationManager->isInAdminGroup('useradmin')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_USER, true, 'user_maint.php', 'images/icon_users.gif'));
}

if ($authenticationManager->isInAdminGroup('projectadmin')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_PROJECT, true, 'proj_maint.php', 'images/icon_projects.gif'));
}
if ($authenticationManager->isInAdminGroup('taskadmin')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_TASK, true, 'task_maint.php', 'images/icon_tasks.gif'));
}
if ($authenticationManager->isInAdminGroup('configadmin')) {
	$commandMenu->add(new IconTextCommand(_TSX_MENU_CONFIG, true, 'config.php', 'images/icon_configuration.gif'));
}



//if (!$authenticationManager->usingLDAP())
//	$commandMenu->add(new IconTextCommand("Change Password", true, "changepwd.php", "images/icon_key.gif"));
//$commandMenu->add(new IconTextCommand("Logout", true, "logout.php?logout=true", "images/icon_logout.gif"));

//disable yourself
$commandMenu->disableSelf();


