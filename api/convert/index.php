<?php

require_once "./../controllers/convert.controller.php";

const CONVERT_FIILE_CONTROLLER = new File_Converter();

$USER_APP_ID  = $_REQUEST["app_id"];

$SERVER_RESPONSE = CONVERT_FIILE_CONTROLLER->check_app_credentials($USER_APP_ID);

//check if the API key is legit
if(!CONVERT_FIILE_CONTROLLER->valid_key)
{
	echo $SERVER_RESPONSE;
}


echo "Hello world";


?>