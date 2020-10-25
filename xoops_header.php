<?php
/*
** Xoops specific variables
*/
require dirname(__DIR__, 2) . '/mainfile.php';

// timesheetXoops configuration settings
//

$GLOBALS['xoopsOption']['template_main'] = 'timesheet_index.html';

require XOOPS_ROOT_PATH . '/header.php';

//collect timesheet_index template

if (!isset($tsxFlag)) {
    ob_start();

    $tsxFlag = true;
}
