<?php 

require __DIR__ . '/vendor/autoload.php';
require_once "base.controller.php";
use \Convertio\Convertio;
use \Convertio\Exceptions\APIException;
use \Convertio\Exceptions\CURLException;
/**
 * Base controller for the Badass convert module
 * @see https://github.com/Adedoyin-Emmanuel/Badass-Backend/
 * */
session_start();

 
final class File_Converter extends Base_Controller
{
	
	private $CONVERTIO_API_KEY;
	private $API;

	public function __construct()
	{
		parent::__construct();
		$this->CONVERTIO_API_KEY = "eb1fce7567aaebb7a71f191e04220227";
		

	}

	public function get_api_key()
	{
		return $this->CONVERTIO_API_KEY;
	}

	public function convert_file($file_tmp_name, $format)
	{
	 	
		  try {
		      $API = new Convertio("eb1fce7567aaebb7a71f191e04220227");
		      $API->start($file_tmp_name, $format)->wait()->download('converted_file.'. $format)->delete();

		      $converted_file = file_get_contents('converted_file.'. $format);
		      $response = base64_encode($converted_file);


		      return $response;
		  } catch (APIException $e) {
		      echo "API Exception: " . $e->getMessage() . " [Code: ".$e->getCode()."]" . "\n";
		  } catch (CURLException $e) {
		      echo "HTTP Connection Exception: " . $e->getMessage() . " [CURL Code: ".$e->getCode()."]" . "\n";
		  } catch (Exception $e) {
		      echo "Miscellaneous Exception occurred: " . $e->getMessage() . "\n";
		  }

	}

	public function get_uploaded_file_extension($file)
	{
		return pathinfo($file, PATHINFO_EXTENSION);
	}

	public function custom_get_file_extension($file)
	{
		return end(explode(".",$file));
	}

	public function convert_bytes_to_kb($bytes)
	{	
		//returns the btyes to KB in 2 decimal places
		//return  (number_format($bytes / 1024, 2, ".", ""));

		//return a round up number
		return (ceil($bytes / 1024));
	}

	public function remove_file_extension($file)
	{
		//returns the filename, excluding the extension
		return reset(explode(".", $file));
	}
	
	public function check_file_request_sent($request, $converting_to)
	{
	
		//we should be expecting only files.
		$this->request_received = $_FILES[$request];
		$this->converting_to = $converting_to;
		$this->filenames_array = array();
		$test = "";
		//$_SESSION["files"] = $this->request_received;

		for($i = 0; $i < count($this->request_received["name"]); $i++)
		{
			$this->filename = $this->request_received["name"][$i];
			//we want the filesize in KB
			$this->filesize = $this->convert_bytes_to_kb($this->request_received["size"][$i]);
			$this->current_file_extension = $this->get_uploaded_file_extension($this->filename);

			$this->image_data_from_api = $this->convert_file($this->request_received["tmp_name"][$i], $this->converting_to);
			array_push($this->filenames_array, [ 
					"id" 		=> $i,
					"filename"  => $this->remove_file_extension($this->filename),
					"previous_extension" => $this->current_file_extension,
					"filesize"  => $this->filesize,
					"converting_to" => $this->converting_to,
					"convert_status" => 200,
					"message" => "file conversion successful",
					"image_data" => $this->image_data_from_api
			]);
		}

		return json_encode($this->filenames_array);

		//return $test;
	}

	public function check()
	{
		if(isset($_SESSION["uploaded_files"]))
		{	
			return "session is set";
		}
		else{
			return "session is not set";
		}
	}

}
