<?php 
// loginly_storage/Login
global $url;
// dev purposes (debug) :)
$debug = True;

if (!isset($_POST['email']) || !isset($_POST['file'])) {
	die("Something is missing here...");
}

// VARIABLEs
$email = $_POST['email'];
$image = $_POST['file'];
$timestampp = time(); 


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
 // $countfiles = count($_FILES['file']['name']);

// die(var_dump($_POST['file']));
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
$filename = "login_".$timestampp.".txt";
$myfile = fopen($filename, "w") or die("cound't create the file.");
fclose($myfile);
// clean last time was opened
unlink($filename);
// now we can open it


$myfile1 = fopen($filename, "w")or die("cound't create the file.");

fwrite($myfile1, $image);
fclose($myfile1);
 

$finalpath = "Login/".$filename;

$sourcef = $filename;


//$movereuslt = rename($filename,"logindump/".$filename);


//if($movereuslt) {	die("couldn't move the file");}






upload_object("loginly_storage", $finalpath, $sourcef);


// $requeststring = "https://us-central1-loginly.cloudfunctions.net/modelCreation?train=RUN";
$requeststring = "https://us-central1-loginly.cloudfunctions.net/login?txtFile=".$filename;

// $requeststring .= "img1"."=".$filename."&";


// $requeststring .= "&email=".$email;


if ($debug) {
	print("<br> REQUEST STRING: ".$requeststring);
}


 $requeststring = str_replace(" ", "%20", $requeststring);

// cURL method
// require 'requestclean.php';

// old way method, but useful
$requestOutput = file_get_contents($requeststring);
 
if ($debug) {
	print("<br>REQUEST OUTPUT: ".$requestOutput);
}


// header("location:pleasewait.html");

 ?>
 
