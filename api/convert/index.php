<?php

require_once "./../controllers/convert.controller.php";

$convert_file_controller = new File_Converter();

$user_app_id  = $_REQUEST["app_id"];

$server_response = $convert_file_controller->check_app_credentials($user_app_id);

//check if the API key is legit
if(!$convert_file_controller->valid_key)
{
	echo $server_response;
}

if(isset($_REQUEST["convert_to"]) AND isset($_FILES["files"]))
{
	echo($convert_file_controller->check_file_request_sent("files", $_REQUEST["convert_to"]));
}

?>