<?php
// This is a working example for use with drie and fusion api using service account - 
//   Can be used as a template for other api - see particulars which need to
//   be changed for other api with //### Other APIs 

// keys to access calendars from google api console credentials
$CLIENTID = "50547440225-pfitg90gttkvtk0ubc4i4lfcbfl65aaq.apps.googleusercontent.com";
$SERVICEACCOUNTNAME = "50547440225-pfitg90gttkvtk0ubc4i4lfcbfl65aaq@developer.gserviceaccount.com";
$KEYFILELOCATION = "Keys/6f5438f176261b2693a24a3d1ac6ebf401389794-privatekey.p12";

// URL to come back to
session_start();
// Reference google api php client - this assumes that ../google-api-php-client
// directory is in the parent directory of this project
set_include_path("../google-api-php-client/src/" . PATH_SEPARATOR . get_include_path());
require_once('Google/Client.php');
//### Other APIs -- pick up objects for code - change for other APIs
require_once('Google/Service/Fusiontables.php');

$client = new Google_Client();
$FusiontablesService = new Google_Service_Fusiontables($client);

if (isset($_SESSION['fusiontables_service_token'])){
    $client->setAccessToken($_SESSION['fusiontables_service_token']);
}
$key = file_get_contents($KEYFILELOCATION);
$cred = new Google_Auth_AssertionCredentials(
   $SERVICEACCOUNTNAME,
   array('https://www.googleapis.com/auth/fusiontables'),
   $key
);
$client->setAssertionCredentials($cred);
if ($client->getAuth()->isAccessTokenExpired()){
    $client->getAuth()->refreshTokenWithAssertion($cred);
}
$_SESSION['fusiontables_service_token'] = $client->getAccessToken();
// fall through and start to work with $DriveService object
?>
