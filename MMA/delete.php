<?php 
namespace MicrosoftAzure\Storage\Samples;
error_reporting(0);

SESSION_start();
require 'connection.php';
if( !isset($_SESSION["nome"]) ){
  header("location: index.php");
  exit();
}
require 'azureconnection.php';
require_once 'vendor\autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\BlobSharedAccessSignatureHelper;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\DeleteBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\GetBlobOptions;
use MicrosoftAzure\Storage\Blob\Models\ContainerACL;
use MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesOptions;
use MicrosoftAzure\Storage\Blob\Models\ListPageBlobRangesOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Common\Exceptions\InvalidArgumentTypeException;
use MicrosoftAzure\Storage\Common\Internal\Resources;
use MicrosoftAzure\Storage\Common\Internal\StorageServiceSettings;
use MicrosoftAzure\Storage\Common\Models\Range;
use MicrosoftAzure\Storage\Common\Models\Logging;
use MicrosoftAzure\Storage\Common\Models\Metrics;
use MicrosoftAzure\Storage\Common\Models\RetentionPolicy;
use MicrosoftAzure\Storage\Common\Models\ServiceProperties;

        
  if(isset($_POST['but_delete'])){
      if(!empty($_POST['img_list']))
      {
        $user =  $_SESSION['userContainer'];

        foreach($_POST['img_list'] as $imgselected)
        {
          try{
            $verify = $blobClient->deleteBlob(strtolower($user), $imgselected);
            echo $imgselected."</br>";
            }
            catch (ServiceException $e) {
                echo "<script>
                alert('Failed deleting image');";
                sleep(2);
                echo "window.location = '/homepage.php';
                    </script>";
                }
          }
        header("location: /homepage.php");
        }
        else{
          echo "<script>
          alert('You must select a valid image to delete!');";
          sleep(2);
          echo "window.location = '/homepage.php';
              </script>";
        }
  }
        


?>
