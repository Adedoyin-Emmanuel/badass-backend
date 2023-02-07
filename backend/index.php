<?php
    
    $data_array = [];

    $data_to_frontend;

    $api_key_check = $_POST["app_id"];
    
    //App specific key
    const API_KEY = "d847b2e0-14f9-11e9-b5dc-0242ac130003";

    //check if the API key wasn't passed
    if(empty($api_key_check) OR !isset($api_key_check))
    {
        $data_array = [
            "data" => "No app key specified!",
            "code" => "403"
        ];

         die(json_encode($data_array));
      
        
    }
    
    else if($api_key_check!= API_KEY)
    {
        $data_array = [
            "data" => "Invalid app key!",
            "code" => "403"
        ];

        die (json_encode($data_array));
        
    }
