<?php 
	header('HTTP/1.1 200 OK');

	try{
		// Get the data
		$data = $_REQUEST;

		// Get data from webhooks json file
		$json = file_get_contents('webhooks.json');

		// Converts json data into array
		$array = json_decode($json, true);

		array_push($array, $data);

		// Convert updated array to JSON
		$new_json = json_encode($array);

		// write json data into webhooks json file
	    file_put_contents('webhooks.json', $new_json);
    } catch (Exception $e) {
        error_log($e->getMessage(), 3, "error.log");
    }
?>