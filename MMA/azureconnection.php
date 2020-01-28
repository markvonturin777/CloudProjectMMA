<?php 
namespace MicrosoftAzure\Storage\Samples;
require 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\BlobSharedAccessSignatureHelper;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\DeleteBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\GetBlobOptions;
use MicrosoftAzure\Storage\Common\Models\ServiceProperties;

    try {
        $connectionString = 'DefaultEndpointsProtocol=https;AccountName=blobexamplephp;AccountKey=VWi8DOUFl09513L8ydnbxI81tBagct8fQWTpU6q8KR3UFY0vHnwXLyWm1hPWmdZcvEJ9KH4OIHwpYyBQgQov6Q==;EndpointSuffix=core.windows.net';
        $blobClient = BlobRestProxy::createBlobService($connectionString);
    } catch(Exception $e){
        $error_message = $e->getMessage();
        echo $error_message;
    }  