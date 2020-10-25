<?php

require 'class.AuthenticationManager.php';

//log the user out
$authenticationManager->logout();

//go to the login page
header('Location: login.php');
