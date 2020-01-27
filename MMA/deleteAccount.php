<?php 
namespace MicrosoftAzure\Storage\Samples;

SESSION_start();
require 'connection.php';
if( !isset($_SESSION["nome"]) ){
  header("location: index.php");
  exit();
}
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
?>

<html>
  <head>

    <title>Delete your Account</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    $(function() {
        var selectedClass = "";
        $(".filter").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#gallery").fadeTo(100, 0.1);
            $("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
            setTimeout(function() {
                $("."+selectedClass).fadeIn().addClass('animation');
                $("#gallery").fadeTo(300, 1);
            }, 300);
        });
    });
    </script>
   

 </head>
  <body>
        <div class=" float-right dropdown ">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="homepage.php">Home</a>
                <a class="dropdown-item" href="logout.php">Log out</a>
                <a class="dropdown-item" href="deleteAccount.php">Delete your account</a>           
                <a class="dropdown-item" href="info.php">Infos</a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <h1 class="w-75">Sei davvero sicuro di voler eliminare il tuo account? Una volta eliminato tutte le foto caricate su cloud non saranno piu recuperabili</h1>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary" name="YesResponse">
                SI
            </button>
            &nbsp; &nbsp;
            <button class="btn btn-primary" name="NoResponse">
                NO
            </button>
        </div>
        </form>
</br>
        <?php
        
        if(isset($_POST['YesResponse'])){
            $connectionString = 'DefaultEndpointsProtocol=https;AccountName=blobexamplephp;AccountKey=VWi8DOUFl09513L8ydnbxI81tBagct8fQWTpU6q8KR3UFY0vHnwXLyWm1hPWmdZcvEJ9KH4OIHwpYyBQgQov6Q==;EndpointSuffix=core.windows.net';
            $blobClient = BlobRestProxy::createBlobService($connectionString);
            $user =  $_SESSION['userContainer'];

            $queryDelete="DELETE FROM users WHERE cognome='".$user."'";
            $sth1 = $pdo->prepare($queryDelete);
            $sth1->execute();

            $blobClient->deleteContainer(strtolower($user));

            SESSION_destroy();
            header("location: /index.php");

        }
        if(isset($_POST['NoResponse'])){
            header("location: /homepage.php");

        }
?>

  </body>

</html>