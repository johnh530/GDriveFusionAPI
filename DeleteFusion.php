<?php
// for debugging
ini_set("display_errors", 1);
// Authenticate and pick up Calendar object
require_once("AuthorizeFusion.php");
$TABLEID = "1lg4CsrAeN4viUNTlZxvHCfwP1aD5ydJSF2QnWkzJ";
$Query = $FusiontablesService->query;
$Query->sql("DELETE FROM $TABLEID");
?>
