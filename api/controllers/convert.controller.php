<?php

namespace controller\convert_controller;

/**
 * Base class controller for the convert API
 * @see https://github.com/Adedoyin-Emmanuel/badass-backend/ 
 * */



final class Base_Converter
{
	private $API_KEY;
	private $data_array;
	private $api_key_check;
	public  $valid_key;


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
		$this->upload_file_name = $this->product_img["name"];
		#reference the file upload folder
		$this->upload_dir= "../images/";
		#create a file size constant
		#this is 1mb, the max amount of file size we can accept
		$this->max_file_size=1000000;
		
		$this->striped_file=explode('.',$this->upload_file_name);
		#create an array for the possible type of file allowed for upload
		$this->legit_file_extension=array("png","jpeg","jpg","gif");
		$this->legit_upload_file_ext=strtolower(end($this->striped_file));
		#explode the file name to check for the extension
		
		$this->upload_tmp_name=$this->product_img["tmp_name"];
		$this->upload_file_error=$this->product_img["error"];
		$this->upload_file_size=$this->product_img["size"];
		#the file is not uploaded by default
		$this->file_match_success=false;

		#rename the file
		$this->randomNumber=rand(0,10000000);
		$this->randomTime=time();
		$this->processed_file_name=$this->randomNumber.$this->randomTime.'.'.$this->legit_upload_file_ext;
		$this->target_file_dir=$this->upload_dir.$this->processed_file_name;
		#check if there was an error uploading the file
		if($this->upload_file_error != 0){
			return 'an error occured while processing file';
		}else{

			#check if the uploaded file is above the legit file size
			if($this->upload_file_size > $this->max_file_size){
				return 'whoza, file size too large';
			}else{

				#check if the uploaded file matches the legit file extension
				if(in_array($this->legit_upload_file_ext,$this->legit_file_extension)){
					#the file matches all the required properties
					$this->file_match_success=true;

				
				
				}else{
					$this->file_match_success= false;

					return 'invalid file extension, use (png, jpg, gif, jpeg)';
					
				}
			}

		}

		return $this->file_match_success;
	}

	
}