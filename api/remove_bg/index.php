<?php

require_once "./../controllers/convert.controller.php";

const CONVERTER_CONTROLLER = new Base_Converter();

$USER_APP_ID  = $_REQUEST["app_id"];

$SERVER_RESPONSE = CONVERTER_CONTROLLER->check_app_credentials($USER_APP_ID);

//check if the API key is legit
if(!CONVERTER_CONTROLLER->valid_key)
{
	echo $SERVER_RESPONSE;
}

$dummy_image_path = __DIR__ . "/dummy_img/chain.png";

CONVERTER_CONTROLLER->test_guzzle($dummy_image_path);


?>