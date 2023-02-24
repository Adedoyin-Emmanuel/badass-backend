<?php
// require __DIR__ . '/vendor/autoload.php';
// require_once "base.controller.php";
// use \Convertio\Convertio;
// use \Convertio\Exceptions\APIException;
// use \Convertio\Exceptions\CURLException;
// try {
// 				$format = "jpg";
// 		      $API = new Convertio("eb1fce7567aaebb7a71f191e04220227");
// 		      $API->start("./chain.png", $format)->wait()->download('converted_file.'. $format)->delete();

// 		      $converted_file = file_get_contents('converted_file.'. $format);
// 		      $response = array(
// 		      		"imageData" => base64_encode($converted_file)
// 		      );

// 		      var_dump($response);

// 		      return true;
// 		  } catch (APIException $e) {
// 		      echo "API Exception: " . $e->getMessage() . " [Code: ".$e->getCode()."]" . "\n";
// 		  } catch (CURLException $e) {
// 		      echo "HTTP Connection Exception: " . $e->getMessage() . " [CURL Code: ".$e->getCode()."]" . "\n";
// 		  } catch (Exception $e) {
// 		      echo "Miscellaneous Exception occurred: " . $e->getMessage() . "\n";
// 		  }

require_once "bulk-image-downloader.controller.php";


// $bulk_image = new Bluk_Image_Downloader();

// $bulk_image->search_images("cat");


// var_dump($bulk_image);

