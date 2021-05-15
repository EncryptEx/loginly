<?php 

//The Cloud Function's trigger URL
$url = $requeststring;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Get the response and close the channel.
$response = curl_exec($ch);
echo "Printing response: \n\n";
echo $response;
curl_close($ch); ?>