<?php
// for debugging
ini_set("display_errors", 1);
// Authenticate and pick up Calendar object
require_once("AuthorizeFusion.php");
$TABLEID = "1lg4CsrAeN4viUNTlZxvHCfwP1aD5ydJSF2QnWkzJ";
$Query = $FusiontablesService->query;
$QryStr = "INSERT INTO $TABLEID 
  (title, lastModifyingUserName, webContentURL, thumbnailLink, location, date)
   VALUES 
  ('screen2.jpg', 'midwestworkshop ccsc',
   'https://docs.google.com/uc?id=0B6a7ubBDa-1YLV9hVFNFQUl2bkU',
   'https://docs.google.com/uc?id=0B6a7ubBDa-1YLV9hVFNFQUl2bkU',
   '41.870784722222 -88.069710555556',
   '2014:09:15 15:51:57')";
$Query->sql($QryStr);
?>
