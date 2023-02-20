<?php
session_start();
require_once "./../controllers/convert.controller.php";

const CONVERT_FILE_CONTROLLER = new File_Converter();

$USER_APP_ID  = @$_REQUEST["app_id"];

$SERVER_RESPONSE = CONVERT_FILE_CONTROLLER->check_app_credentials($USER_APP_ID);

//check if the API key is legit
if(!CONVERT_FILE_CONTROLLER->valid_key)
{
	echo $SERVER_RESPONSE;
}

if(isset($_REQUEST["convert_to"]) AND isset($_FILES["files"]))
{
	echo (CONVERT_FILE_CONTROLLER->check_file_request_sent("files", $_REQUEST["convert_to"]));
}

?>