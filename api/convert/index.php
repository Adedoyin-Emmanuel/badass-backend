<?php


require_once "./../controllers/convert.controller.php";

use controller\convert_controller\Base_Converter;

const CONVERTER_CONTROLLER = new Base_Converter();

$USER_APP_ID  = $_REQUEST["app_id"];

$SERVER_RESPONSE = CONVERTER_CONTROLLER->check_app_credentials($USER_APP_ID);

//check if the API key is legit
if(!CONVERTER_CONTROLLER->valid_key)
{
	echo $SERVER_RESPONSE;
}






?>