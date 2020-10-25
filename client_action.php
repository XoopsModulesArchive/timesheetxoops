<?php
// Authenticate
require 'class.AuthenticationManager.php';
require 'class.CommandMenu.php';
if (!$authenticationManager->isLoggedIn('clientadmin')) {
    redirect_header(XOOPS_URL . '/index.php', 1, _NOPERM);

    exit();
}

// Connect to database.
$dbh = dbConnect();
$contextUser = mb_strtolower($_SESSION['contextUser']);

//load local vars from superglobals
$action = $_REQUEST['action'];
$client_id = $_REQUEST['client_id'] ?? 0;
$organisation = $_POST['organisation'] ?? '';
$description = $_POST['description'] ?? '';
$address1 = $_POST['address1'] ?? '';
$address2 = $_POST['address2'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';
$contact_first_name = $_POST['contact_first_name'] ?? '';
$contact_last_name = $_POST['contact_last_name'] ?? '';
$client_username = $_POST['client_username'] ?? '';
$contact_email = $_POST['contact_email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$fax_number = $_POST['fax_number'] ?? '';
$gsm_number = $_POST['gsm_number'] ?? '';
$http_url = $_POST['http_url'] ?? '';

if ('add' == $_REQUEST['action']) {
    dbquery("INSERT INTO $CLIENT_TABLE VALUES ('$client_id','$organisation','$description','$address1','$city'," .
    "'L','$country','$postal_code','$contact_first_name','$contact_last_name','$client_username'," .
    "'$contact_email','$phone_number','$fax_number','$gsm_number','$http_url','$address2')");
} elseif ('edit' == $action) {
    //create the query

    $query = "UPDATE $CLIENT_TABLE SET organisation='$organisation'," .
        "description='$description',address1='$address1',city='$city'," .
        "country='$country',postal_code='$postal_code'," .
        "contact_first_name='$contact_first_name'," .
        "contact_last_name='$contact_last_name',username='$client_username'," .
        "contact_email='$contact_email',phone_number='$phone_number'," .
        "fax_number='$fax_number',gsm_number='$gsm_number'," .
        "http_url='$http_url',address2='$address2' " .
        "WHERE client_id=$client_id ";

    //run the query

    [$qh, $num] = dbquery($query);
} elseif ('delete' == $action) {
    //find out if this client is in use

    [$qh, $num] = dbQuery("select * from $PROJECT_TABLE where client_id='$client_id'");

    if ($num > 0) {
        errorPage('You cannot delete a client for which there are projects. Please delete the projects first.');
    } else {
        dbquery("DELETE from $CLIENT_TABLE WHERE client_id='$client_id'");
    }
}

header('Location: client_maint.php');
