<?php 
// loginly_storage/Login
global $url;
// dev purposes (debug) :)
$debug = True;

if (!isset($_POST['email'])) {
	die("Something is missing here...");
}

// VARIABLEs
$email = $_POST['email'];


# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php'; 

// Storage client package req
use Google\Cloud\Storage\StorageClient;

/**
 * List all Cloud Storage buckets for the current project.
 * 
 * @return void
 */
// list_buckets();
// function list_buckets()
// {
//     $storage = new StorageClient(['keyFile' => json_decode(file_get_contents('key.json'), true)]);
//     foreach ($storage->buckets() as $bucket) {
//         printf('Bucket: %s' . PHP_EOL, $bucket->name());
//     }
// }






 
 // Count total files
 $countfiles = count($_FILES['file']['name']);

die(var_dump($countfiles));
 // Loop

function upload_object($bucketName, $objectName, $source)
{
	$storage = new StorageClient(['keyFile' => json_decode(file_get_contents('key.json'), true)]);
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName
    ]);
    if ($GLOBALS['debug']) {
		print("<br>FILE UPLOADED:");
    	printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
	}
}




// check if is a list ? ¿?
$filename = $_FILES['file']['name'][0];

// $filevalue = $_FILES['file']['tmp_name'][$i];
move_uploaded_file($_FILES['file']['tmp_name'][0],'upload/'.$filename);
$finalpath = "Login/".$name."_".$email."/".$filename;

$sourcef = "./upload/".$filename;
upload_object("loginly_storage", $finalpath, $sourcef);


$requeststring = "https://us-central1-loginly.cloudfunctions.net/cleanData?";

$requeststring .= "img1"."=".$filename."&";


$requeststring .= "name=".$name."&email=".$email;


if ($debug) {
	print("<br> REQUEST STRING: ".$requeststring);
}


 $requeststring = str_replace(" ", "%20", $requeststring);

// cURL method
// require 'requestclean.php';

// old way method, but useful
// $requestOutput = file_get_contents($requeststring);
 
if ($debug) {
	print("<br>REQUEST OUTPUT: ".$requestOutput);
}


// header("location:pleasewait.html");

 ?>
 
