<?php 

require __DIR__ . '/vendor/autoload.php';
require_once "base.controller.php";
use \Convertio\Convertio;
/**
 * Base controller for the Badass convert module
 * @see https://github.com/Adedoyin-Emmanuel/Badass-Backend/
 * */




final class File_Converter extends Base_Controller
{
	
	private $CONVERTIO_API_KEY;
	private $API;

	public function __construct()
	{
		parent::__construct();
		$this->CONVERTIO_API_KEY = "e94304ca6166ccff5aa38484b68a3d6a";
		
	}

	public function get_api_key()
	{
		return $this->CONVERTIO_API_KEY;
	}

	public function convert_file($default_file, $file_to_convert_to)
	{
		$this->default_file = $default_file;
		$this->file_to_convert_to = get_file_to_convert_to($file_to_convert_to);
		$this->file_to_convert_to_extension = get_uploaded_file_extension($default_file);

		$this->API = new Convertio(get_api_key());
  		$this->API->start($this->default_file, $this->file_to_convert_to)->wait()->download('./output'.$this->file_to_convert_to_extension)->delete();
	}

	public function get_uploaded_file_extension($file)
	{
		return pathinfo($file, PATHINFO_EXTENSION);
	}

	public function custom_get_file_extension($file)
	{
		return end(explode(".",$file));
	}

	public function get_file_to_convert_to ($file)
	{
		$this->converting_to = $_POST[$file];

		return $this->converting_to;
	}

	public function check_file_request_sent($request)
	{
			//we should be expecting only files.
			$this->request_received = $_FILES[$request];
			$this->filenames_array = array();

			for($i = 0; $i < count($this->request_received["name"]); $i++)
			{
				$this->filename = $this->request_received["name"][$i];
				$this->current_file_extension = $this->get_uploaded_file_extension($this->filename);

				array_push($this->filenames_array, [
					"filename" => $this->filename,
					"extension" => $this->current_file_extension
				]);
			}

			return json_encode($this->filenames_array);

	}

}
