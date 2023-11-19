<?php

// Simulate server variables
$_SERVER['HTTP_HOST'] = ''; // Add your domain name here
$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI'] = ''; // Add your URI here
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';

// Other variables may be necessary depending on the application's needs

// Define the auto-loader
require __DIR__ . '/vendor/autoload.php';

error_log("direct-laravel.php 1");

// Bootstrap the application
$app = require_once __DIR__ . '/bootstrap/app.php';
// error_log("$" . "app: " . print_r($app, true) . " - direct-laravel.php 15");
error_log("direct-laravel.php 2");
// Create a request instance from the global PHP variables.
$request = Illuminate\Http\Request::capture();
$app->instance('request', $request);

// Run the application and get the response
$response = $app->handle($request);

// Output the response content
echo $response->getContent();

// If you want to return the proper status code to the console
http_response_code($response->getStatusCode());
