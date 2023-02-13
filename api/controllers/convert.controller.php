<?php

namespace controller\convert_controller;

/**
 * Base class controller for the convert API
 * @see https://github.com/Adedoyin-Emmanuel/badass-backend/ 
 * */



final class Base_Converter
{
	protected $API_KEY;
	protected $data_array;
	protected $api_key_check;
	public  $valid_key;


	public function __construct()
	{
		$this->API_KEY = "d847b2e0-14f9-11e9-b5dc-0242ac130003";
		$this->valid_key = false;
	}

	public function get_api_key () 
	{
		return $this->API_KEY;
	}

	
}