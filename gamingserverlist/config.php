
<?php


//config.php

//Include Google Client Library for PHP autoload file
require_once '/opt/lampp/vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('973724767208-fos7hq4068i8rj0kv8en4nb8fadhk84p.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('dI2ctL7S2gaDBIzLiadRsP3M');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://gamingserverlist.com/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>