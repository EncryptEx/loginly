<?php use Google\Cloud\Storage\StorageClient;

/**
 * Upload a file.
 *
 * @param string $bucketName the name of your Google Cloud bucket.
 * @param string $objectName the name of the object.
 * @param string $source the path to the file to upload.
 *
 * @return Psr\Http\Message\StreamInterface
 */

upload_object("loginly_storage", "Storage/testImg_test@gmail.com/a.jpg", "a.jpg");

function upload_object($bucketName, $objectName, $source)
{
	$storage = new StorageClient(['keyFilePath' => 'key.json']);
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName
    ]);
    printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
} ?>