<?php
require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'http://omdbapi.com', [
				'query' => [
					'apikey' => '7b90f2fe',
					's' => 'transformers'	
				]
				
			]);

$result = json_decode($response->getBody()->getContents(), TRUE);

var_dump($result);

?>
