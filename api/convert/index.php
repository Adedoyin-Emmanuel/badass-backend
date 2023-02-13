<?php


require_once "./../controllers/convert.controller.php";

use controller\convert_controller\Base_Converter;

$converter = new Base_Converter();

echo $converter->get_api_key();

?>