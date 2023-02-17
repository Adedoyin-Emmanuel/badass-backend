<?php

require_once "./../controllers/remove_bg.controller.php";

const REMOVE_BG_CONTROLLER = new Remove_Bg();

$USER_APP_ID  = $_REQUEST["app_id"];

$SERVER_RESPONSE = REMOVE_BG_CONTROLLER->check_app_credentials($USER_APP_ID);

//check if the API key is legit
if(!REMOVE_BG_CONTROLLER->valid_key)
{
	echo $SERVER_RESPONSE;
}

$dummy_image_path = __DIR__ ."/chain.png";

echo REMOVE_BG_CONTROLLER->remove_image_bg($dummy_image_path);



?>