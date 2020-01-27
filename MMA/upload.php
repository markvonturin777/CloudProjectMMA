<?php 
namespace MicrosoftAzure\Storage\Samples;
error_reporting(0);

SESSION_start();
if( !isset($_SESSION["nome"]) ){
  header("location: index.php");
  exit();
}

require_once "vendor/autoload.php";
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


$connectionString = 'DefaultEndpointsProtocol=https;AccountName=blobexamplephp;AccountKey=VWi8DOUFl09513L8ydnbxI81tBagct8fQWTpU6q8KR3UFY0vHnwXLyWm1hPWmdZcvEJ9KH4OIHwpYyBQgQov6Q==;EndpointSuffix=core.windows.net';
$blobClient = BlobRestProxy::createBlobService($connectionString);

    if(isset($_POST['but_upload'])){

        $tmpname = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif')
        {
        
            $uploaded = move_uploaded_file($tmpname, __DIR__ . "..\uploads\\" . $name);

            if($uploaded) {
                echo "Upload Successful";
                sleep(1);
            }
            else{
                echo "Failed to upload your image! Were you really trying to send an image?";
                sleep(2);
                header("location: /homepage.php");
            }
            $ffile =  __DIR__ . "..\uploads\\" . $name;

            $handle = fopen( $ffile, "r");

            try {        
                uploadBlobSample($blobClient,$name,$handle);
                sleep(1);
                header("location: /homepage.php");
            }
            catch(ServiceException $e){
                $code = $e->getCode();
                $error_message = $e->getMessage();
                echo $code.": ".$error_message."<br />";
            }
            catch(InvalidArgumentTypeException $e){
                $code = $e->getCode();
                $error_message = $e->getMessage();
                echo $code.": ".$error_message."<br />";
            }
            catch(Exception $e){
                $error_message = $e->getMessage();
                echo $error_message;
            }        
            $handle = @fclose($name);
        }
        //if the file isn't matching the right extension it redirects to the homepage 
        else{
            
            echo "<script>
            alert('The uploaded file must be an image of this extension: jpg,jpeg,png,gif');";
            sleep(2);
            echo "window.location = '/homepage.php';
                </script>";
        }
    }  
    else {
        echo "Sorry, there was an error uploading your file.";
    }

    
    function uploadBlobSample($blobClient,$fileToUpload, $content)
    {
        $containerName = $_SESSION['userContainer'];
        $containerNameLow = strtolower($containerName);
        var_dump($containerName);

        try {
            //Upload blob
            $blobClient->createBlockBlob($containerNameLow, $fileToUpload, $content);

        } catch (ServiceException $e) {
            $code = $e->getCode();
            $error_message = $e->getMessage();
            var_dump($error_message);
            echo $code.": ".$error_message.PHP_EOL;
        }
 
    }

?>
