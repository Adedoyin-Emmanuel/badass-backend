<?php 

require __DIR__ . '/vendor/autoload.php';
/**
 * Base controller for the Badass convert module
 * @see https://github.com/Adedoyin-Emmanuel/Badass-Backend/
 * */




final class File_Converter 
{
	private $api_key;
	private $convertio_api_key;
	private $valid_key; //checks if the user request app id is legit
	private $client;



	public function __construct()
	{
		$this->api_key = "d847b2e0-14f9-11e9-b5dc-0242ac130003";
		$this->convertio_api_key = "balablu";
		$this->valid_key = false;
	}

	public function get_api_key()
	{
		return $this->api_key;
	}


	public function check_app_credentials()
	{

	}

	public function convert_file()
	{
		$this->client = null //request the guzzelHTTP module
	}
}