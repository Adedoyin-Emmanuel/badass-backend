<?php

require __DIR__ . '/vendor/autoload.php';
require_once "base.controller.php";

/**
 * Base class controller for the convert API
 * @see https://github.com/Adedoyin-Emmanuel/badass-backend/ 
 * */



final class Remove_Bg extends Base_Controller
{
	
	public  $client;
	private $remove_bg_app_id;


	public function __construct()
	{
		parent::__construct();
		$this->remove_bg_app_id = 1245;
	}

	public function get_api_key () 
	{
		return $this->API_KEY;
	}

	public function remove_image_bg($image_path){
		
		/**
		 * If you are seeing this source code. GREAT you can definately use it, but as at the time of building this project, I used a TypeScript Frontend approach to build the image removal module in Badass, WHY?? well that's becuase the API i planned to use didn't have a good Documentation as at the time of building this, also their plans weren't friendly, so I had to look for another alternative which was probably better.
		 * @see https://github.com/Adedoyin-Emmanuel/Badass/ for more info
		 * 
		 * 
		 * */

		if(empty($image_path) OR !isset($image_path))
		{
			return false;
		}

		$this->image_path = $image_path;
		$this->remove_bg_app_id = "ndjs8DYnpUJxe79aR3vtoHrF";

		$this->absolute_url ="/download";


		$this->client = new GuzzleHttp\Client();
		$this->response = $this->client->post('https://api.remove.bg/v1.0/removebg', [
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
		        'X-Api-Key' => $this->rem/ove_bg_app_id
		    ]
		]);

		$this->fp = fopen("no-bg.png", "wb");
		fwrite($this->fp, $this->response->getBody());
		fclose($this->fp);
		
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