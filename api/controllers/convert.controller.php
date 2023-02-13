<?php


/**
 * Base class controller for the convert API
 * @see https://github.com/Adedoyin-Emmanuel/badass-backend/ 
 * */


namespace controller\convert_controller;

final class Base_Converter
{
	private $API_KEY;
	private $data_array;
	private $api_key_check;
	private $API_KEY;
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

	public function check_api_credentials($app_id)
	{
		$this->api_key_check = $this->get_api_key();
		
		if(empty($app_id) OR !isset($app_id))
		{
			$this->data_array = [
				"data"  => "No key specified",
				"code" => 403
			];

			return json_encode($this->data_array);
		}
		else if($this->api_key_check != $app_id)
		{
			$this->data_array = [
				"data" => "Invalid API key",
				"code" => 403
			]

			return json_encode($this->data_array);
		}else if($this->api_key_check == $app_id)
		{
			$this->valid_key = true;

			 $this->data_array = [
	            "data" => "Hello World",
	            "code" => "200"
       		 ];

       		 return json_encode($this->data_array);

		}
		else
		{
			$this->data_array = [
	            "data" => "An Error Has Occurred",
	            "code" => 500
        	];

        	return json_encode($this->data_array);

		}

	}


	public function process_file_upload($file)
	{

		if(empty($file) OR !isset($file))
		{
			return "please upload a file";
			die();
		}

		$this->file_uploaded = $file;

	}
}