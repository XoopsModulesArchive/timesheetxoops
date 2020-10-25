<?php
// $Header: /cvsroot/tsheet/timesheet.php/config_action.php,v 1.6 2005/02/03 08:06:10 vexil Exp $
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('configadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$action = $_REQUEST['action'];
$headerhtml = $_REQUEST['headerhtml'] ?? '';
$bodyhtml = $_REQUEST['bodyhtml'] ?? '';
$footerhtml = $_REQUEST['footerhtml'] ?? '';
$errorhtml = $_REQUEST['errorhtml'] ?? '';
$bannerhtml = $_REQUEST['bannerhtml'] ?? '';
$tablehtml = $_REQUEST['tablehtml'] ?? '';
$locale = $_REQUEST['locale'] ?? '';
$timezone = $_REQUEST['timezone'] ?? '';
$timeformat = $_REQUEST['timeformat'] ?? '';
$headerReset = $_REQUEST['headerReset'] ?? false;
$bodyReset = $_REQUEST['bodyReset'] ?? false;
$footerReset = $_REQUEST['footerReset'] ?? false;
$errorReset = $_REQUEST['errorReset'] ?? false;
$bannerReset = $_REQUEST['bannerReset'] ?? false;
$tableReset = $_REQUEST['tableReset'] ?? false;
$localeReset = $_REQUEST['localeReset'] ?? false;
$timezoneReset = $_REQUEST['timezoneReset'] ?? false;
$timeformatReset = $_REQUEST['timeformatReset'] ?? false;
$useLDAP = $_REQUEST['useLDAP'] ?? false;
$LDAPScheme = $_REQUEST['LDAPScheme'];
$LDAPHost = $_REQUEST['LDAPHost'];
$LDAPPort = $_REQUEST['LDAPPort'];
$LDAPBaseDN = $_REQUEST['LDAPBaseDN'];
$LDAPUsernameAttribute = $_REQUEST['LDAPUsernameAttribute'];
$LDAPSearchScope = $_REQUEST['LDAPSearchScope'];
$LDAPFilter = $_REQUEST['LDAPFilter'];
$LDAPProtocolVersion = $_REQUEST['LDAPProtocolVersion'];
$LDAPBindUsername = $_REQUEST['LDAPBindUsername'];
$LDAPBindPassword = $_REQUEST['LDAPBindPassword'];
$weekstartday = $_REQUEST['weekstartday'] ?? 0;
$weekStartDayReset = $_REQUEST['weekStartDayReset'] ?? false;

    function resetConfigValue($fieldName)
    {
        include 'table_names.inc';

        //get the default value

        [$qh, $num] = dbQuery("SELECT $fieldName FROM $CONFIG_TABLE WHERE config_set_id='0';");

        $resultset = dbResult($qh);

        //set it

        dbQuery("UPDATE $CONFIG_TABLE SET $fieldName='" . $resultset[$fieldName] . "' WHERE config_set_id='1';");
    }

if (!isset($action)) {
    header("Location: $HTTP_REFERER");
} elseif ('edit' == $action) {
    $headerhtml = addslashes(unhtmlentities(trim($headerhtml)));

    $bodyhtml = addslashes(unhtmlentities(trim($bodyhtml)));

    $footerhtml = addslashes(unhtmlentities(trim($footerhtml)));

    $errorhtml = addslashes(unhtmlentities(trim($errorhtml)));

    $bannerhtml = addslashes(unhtmlentities(trim($bannerhtml)));

    $tablehtml = addslashes(unhtmlentities(trim($tablehtml)));

    $locale = addslashes(unhtmlentities(trim($locale)));

    $timezone = addslashes(unhtmlentities(trim($timezone)));

    $query = "UPDATE $CONFIG_TABLE SET " .
        "headerhtml='$headerhtml'," .
        "bodyhtml='$bodyhtml'," .
        "footerhtml='$footerhtml'," .
        "errorhtml='$errorhtml'," .
        "bannerhtml='$bannerhtml'," .
        "tablehtml='$tablehtml'," .
        "locale='$locale'," .
        "timezone='$timezone'," .
        "timeformat='$timeformat', " .
        "useLDAP='$useLDAP', " .
        "LDAPScheme='$LDAPScheme', " .
        "LDAPHost='$LDAPHost', " .
        "LDAPPort='$LDAPPort', " .
        "LDAPBaseDN='$LDAPBaseDN', " .
        "LDAPUsernameAttribute='$LDAPUsernameAttribute', " .
        "LDAPSearchScope='$LDAPSearchScope', " .
        "LDAPFilter='$LDAPFilter', " .
        "LDAPProtocolVersion='$LDAPProtocolVersion', " .
        "LDAPBindUsername='$LDAPBindUsername', " .
        "LDAPBindPassword='$LDAPBindPassword', " .
        "weekstartday='$weekstartday' " .
        "WHERE config_set_id='1';";

    [$qh, $num] = dbquery($query);

    if (true === $headerReset) {
        resetConfigValue('headerhtml');
    }

    if (true === $bodyReset) {
        resetConfigValue('bodyhtml');
    }

    if (true === $footerReset) {
        resetConfigValue('footerhtml');
    }

    if (true === $errorReset) {
        resetConfigValue('errorhtml');
    }

    if (true === $bannerReset) {
        resetConfigValue('bannerhtml');
    }

    if (true === $tableReset) {
        resetConfigValue('tablehtml');
    }

    if (true === $localeReset) {
        resetConfigValue('locale');
    }

    if (true === $timezoneReset) {
        resetConfigValue('timezone');
    }

    if (true === $timeformatReset) {
        resetConfigValue('timeformat');
    }

    if (true === $weekStartDayReset) {
        resetConfigValue('weekstartday');
    }
}

//return to the config.php page
header('Location: config.php');
