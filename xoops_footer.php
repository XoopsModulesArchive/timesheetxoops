<?{
// 
// timesheetxoops SPECIFIC FOOTER
// 

$timesheetXoopsContent = ob_get_contents();
ob_end_clean();
$xoopsTpl->assign('timesheetXoopsContent', $timesheetXoopsContent);

/////////////////////////////////////////////////////////////////////////
// XOOPS_ROOT_PATH should be set in the xoops_header.php file
/////////////////////////////////////////////////////////////////////////
if( file_exists(XOOPS_ROOT_PATH . '/footer.php') ) {
require_once XOOPS_ROOT_PATH . '/footer.php';
}

}
