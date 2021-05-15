<?php
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php'; 

use Google\Cloud\Storage\StorageClient;

/**
 * List all Cloud Storage buckets for the current project.
 *
 * @return void
 */
// list_buckets();
function list_buckets()
{
    $storage = new StorageClient(['keyFile' => json_decode(file_get_contents('key.json'), true)]);
    foreach ($storage->buckets() as $bucket) {
        printf('Bucket: %s' . PHP_EOL, $bucket->name());
    }
}


if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['files'])) {
	die("Something is missing here...");
}

$name = $_POST['name'];
$email = $_POST['email'];
$files = $_POST['files'];

foreach ($files as $filename) {
	

$finalpath = "Storage/".$name."_".$email."/".$filename;

upload_object("loginly_storage", $finalpath, $filename);

function upload_object($bucketName, $objectName, $source)
{
	$storage = new StorageClient(['keyFile' => json_decode(file_get_contents('key.json'), true)]);
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName
    ]);
    printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
}


} ?>
 
