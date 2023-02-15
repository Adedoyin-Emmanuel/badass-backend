<?php

require __DIR__ . '/vendor/autoload.php';


/**
 * Base class controller for the convert API
 * @see https://github.com/Adedoyin-Emmanuel/badass-backend/ 
 * */



 class Base_Converter
{
	private $API_KEY;
	private $data_array;
	private $api_key_check;
	public  $valid_key;
	public  $client;


	public function __construct()
	{
		$this->API_KEY = "d847b2e0-14f9-11e9-b5dc-0242ac130003";
		$this->valid_key = false;
		$this->data_array = [];

	}

	public function get_api_key () 
	{
		return $this->API_KEY;
	}

	public function test_guzzle($image_path, $app_id){

		if(empty($image_path) OR !isset($image_path))
		{
			return false;
		}

		$this->image_path = $image_path;
		$this->app_id 	  = $app_id;

		//init the guzzle client
		$this->client = new GuzzleHttp\Client();
		
		$this->response = $this->client->post('https://sdk.photoroom.com/v1/segment', [
		    'multipart' => [
		        [
		            'name'     => 'image_file',
		            'contents' => fopen($this->image_path, 'r')
		        ],
		        [
		            'name'     => 'size',
		            'contents' => 'auto'
		        ]
		    ],
		    'headers' => [
		        'X-Api-Key' =>	$this->app_id
		    ]
		]);

		$this->fp = fopen("no-bg.png", "wb");
		fwrite($this->fp, $this->response->getBody());
		fclose($this->fp);
		
		//return $this->client;
		
	}

	public function check_app_credentials ($app_id)
	{
		if(empty($app_id) OR !isset($app_id))
		{
			$this->data_array = [
					"data" => "App key not specified!",
					"code" => 403
			];

			return json_encode($this->data_array);
		}
		else if($app_id != $this->API_KEY)
		{
			$this->data_array = [
					"data" => "Invalid API key",
					"code" => 403
			];

			return json_encode($this->data_array);

		}
		else if($app_id == $this->API_KEY)
		{
			//correct API key
			$this->data_array = [
					"data" => "Valid API key",
					"code" => 200
			];

			$this->valid_key = true;

			return json_encode($this->data_array);
		}

		else{
			$this->data_array = [
					"data" => "An unknown error occured",
					"code" => 500
			];

			return json_encode($this->data_array);
		}
	}


	#create a method to handle the file
	public function handle_file(){
		
	}

	
}