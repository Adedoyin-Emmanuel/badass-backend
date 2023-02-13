<?php


require_once "./../controllers/convert.controller.php";

use controller\convert_controller\Base_Converter;

$converter = new Base_Converter();
$api_request = $_REQUEST["app_id"];

$converter->check_api_credentials($api_request);


?>