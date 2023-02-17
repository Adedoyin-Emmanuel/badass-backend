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

	public function convert_file()
	{
		$this->API = new Convertio(get_api_key());
		$API = new Convertio("_YOUR_API_KEY_");  
  		$API->start('./input.docx', 'pdf')->wait()->download('./output.pdf')->delete();
	}

	public function get_uploaded_file_extension($file)
	{
		$this->filename = $_FILES[$file]["name"];
		$this->file_extension = pathinfo($this->filename, PATHINFO_EXTENSION);

		return $this->file_extension;
	}

	public function get_file_to_convert_to ($file)
	{
		$this->converting_to = $_POST[$file];

		return $this->converting_to;
	}
}