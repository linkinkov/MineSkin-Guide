<?php
/*----------------------------------------------------------------
	Guide By - RiFlowTH (VectierThailand Member)

	- API Source
	https://github.com/MineSkin/api.mineskin.org/wiki/REST-API	
	
	License by MIT
	Copyright (c) 2018 RiFlowTH
----------------------------------------------------------------*/
/* NOTE: First, Sorry for my bad english.
         Second, Hope you understand this guide, Good Luck! */
/*--------------------------------------------------------------*/

/* Change '*' to anything you want.
	- If you want to generate a texture from an image URL.
	  You should to change '*' to generate/url
	- Example: https://api.mineskin.org/generate/url
	
	- If you want to generate a texture from an uploaded image.
	  You should to change '*' to generate/upload
	- Example: https://api.mineskin.org/generate/upload
*/
$url = "https://api.mineskin.org/*";

/* NOTE: In this guide I want to use 'cURL (Client URL Libraly) to post data*/
$ch = curl_init(); // Initialize cURL lib.

// If you want to use generate/url.
$post_url = "";
// Example: Use Input form to insert url. (Use Below)
// $post_url = $_POST['username'];

// If you want to use generate/upload.
// Make Input form with type of file and then change * to input form name.
$uploadfile = new CURLFile($_FILES['*']["tmp_name"], $_FILES['*']["type"], $_FILES['*']["name"]);

// Post Parameters , Insert anything that you want.
$parameter = [
	// $url ,You can receive data from input form or anything that HTML can do.
	"url" => $post_url,
	
	// All the /generate routes can use parameters like this.
	"file" => $uploadfile,
	"model" => "slim", // The skin model, either empty or slim.
	"visibility" => 0, // 0 for public , 1 for private.
    "name" => $name, // The generated skin's name. 
];

// cURL lib use it to communicate MineSkin.
curl_setopt($ch, CURLOPT_URL, $url); // URL that you want to send.
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Fix certificate issue.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify host.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return data to string form.
curl_setopt($ch, CURLOPT_POST, true); // Use post method.
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter); // For send with parameters.

$response = curl_exec($ch); // Execute data.

if($response == true){ // If MineSkin respond it return true.
	curl_close($ch); // Stop using cURL lib.
	
	$data = json_decode($response, true); // Turn json to array.
	
	print_r($data); // Print data in array form.
} 
else { // If MineSkin not respond.
	echo "Error: " . curl_error($ch); // Print Error.
}

/* The guid is end */
/* Good Luck ! */
// Special Thank for MineSkin (https://github.com/MineSkin/)
?>