<?php 

namespace MicrosoftAzure\Storage\Samples;
ob_start();
SESSION_start();
if( !isset($_SESSION["nome"]) ){
  header("location: index.php");
  exit();
}
//error_reporting(0);
require 'connection.php';
require 'azureconnection.php';
require_once(__DIR__ . '/vendor/autoload.php');

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
    <title>homepage</title>
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

    <style>
    body{
        margin: 2% 10%;
    }
    .introClass{
        margin: auto;
    }
    .gallery {
        -webkit-column-count: 3;
        -moz-column-count: 3;
        column-count: 3;
        -webkit-column-width: 33%;
        -moz-column-width: 33%;
        column-width: 33%; 
    }
    .gallery .pics {
        -webkit-transition: all 350ms ease;
        transition: all 350ms ease; 
    }
    .gallery .animation {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1); 
    }

@media (max-width: 450px) {
    .gallery {
        -webkit-column-count: 1;
        -moz-column-count: 1;
        column-count: 1;
        -webkit-column-width: 100%;
        -moz-column-width: 100%;
        column-width: 100%;
    }
}

@media (max-width: 400px) {
    .btn.filter {
        padding-left: 1.1rem;
        padding-right: 1.1rem;
    }
}
    </style>
 </head>
  <body>  
        <span class="introClass">Bentornato, <b><?php  echo $_SESSION['nome']; ?></b></span>
        
        <form method="post" action="upload.php" accept="image/*" enctype='multipart/form-data'>
                <div class="input-group w-25">
                    <div class="custom-file">
                        <input type='file' name='file' class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <input type='submit' value='Upload' name='but_upload'>

                </div>
                </form>

                <form action="viewAllByDate.php" >
             <input type="submit" value="Ordina per data" />


        </form>
        <div class=" float-right dropdown w-50">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opzioni
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item mb-auto " href="homepage.php">Home</a>
                <a class="dropdown-item" href="logout.php">Log out</a>
                <a class="dropdown-item" href="deleteAccount.php">Delete Account</a>
                <a class="dropdown-item" href="info.php">Infos</a>
            </div>
        </div>
        <form method="post" action="delete.php">
        
            <?php

                $listBlobsOptions = new ListBlobsOptions();
                $listBlobsOptions->setPrefix("");
                $user =  $_SESSION['userContainer'];

                do{
                    $result = $blobClient->listBlobs(strtolower($user), $listBlobsOptions);
                        //var_dump($result);
            ?> 
                
            <br> <br> <br>
            <div class="gallery d-flex text-center" id="gallery">
                <?php 
                    foreach ($result->getBlobs() as $blob)
                    {    
                            
                ?>
                
                    <div class="introClass responsive">
                        <?php 
                            echo($blob->getName());
                        ?>
                        
                        <input type="checkbox" name="img_list[]" value="<?php echo $blob->getName() ?>"><br>                 
                        <img src="<?php  echo $blob->getUrl() ?>"  class="img-fluid" onclick="Details.php" alt="img" height="200" width="200"><br/><br/> 
                      
			<div class=" float-right dropdown w-50">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Share
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item mb-auto" name="onehour" href='homepage.php?onehour=true&imgURL=<?php echo $blob->getURL()?>&imgName=<?php echo $blob->getName()?>'>1 ora</a>
                            <a class="dropdown-item" name="twelvehours" href='homepage.php?twelvehours=true&imgURL=<?php echo $blob->getURL()?>&imgName=<?php echo $blob->getName()?>'>12 ore</a>
                            <a class="dropdown-item" name="oneday" href='homepage.php?oneday=true&imgURL=<?php echo $blob->getURL()?>&imgName=<?php echo $blob->getName()?>'>1 giorno</a>
                            <a class="dropdown-item" name="oneweek" href='homepage.php?oneweek=true&imgURL=<?php echo $blob->getURL()?>&imgName=<?php echo $blob->getName()?>'>1 settimana</a>
                            <a class="dropdown-item" name="onemonth" href='homepage.php?onemonth=true&imgURL=<?php echo $blob->getURL()?>&imgName=<?php echo $blob->getName()?>'>1 mese</a>
                        </div>

                    	</div> 
                        <?php echo $blob->getProperties()->getCreationTime()->format("F j, Y, g:i a") ;
                     
                        ?>
                        
                    </div>
                 
                    
                    <?php
                    }
                    ?> 
            </div> 

                <?php 
                    $listBlobsOptions->setContinuationToken($result->getContinuationToken());
                    } while($result->getContinuationToken());    
                ?>
            <input type='submit' value='Delete' name='but_delete'>
        </form>


<?php 
        if (isset($_GET['onehour'])) 
        {
	$imgName = $_GET['imgName'];
        $imgURL = $_GET['imgURL'];
            $time = 3600;
            header("location: /createToken.php?timeExpiration=$time&imgName=$imgName&imgURL=$imgURL");
        }
        if (isset($_GET['twelvehours'])) 
        {	
	$imgName = $_GET['imgName'];
        $imgURL = $_GET['imgURL'];
            $time = 43200;
            header("location: /createToken.php?timeExpiration=$time&imgName=$imgName&imgURL=$imgURL");
        }
        if (isset($_GET['oneday'])) 
        {
	$imgName = $_GET['imgName'];
        $imgURL = $_GET['imgURL'];
            $time = 86400;
            header("location: /createToken.php?timeExpiration=$time&imgName=$imgName&imgURL=$imgURL");
        }
        if (isset($_GET['oneweek'])) 
        {
	$imgName = $_GET['imgName'];
        $imgURL = $_GET['imgURL'];
            $time = 604800;
            header("location: /createToken.php?timeExpiration=$time&imgName=$imgName&imgURL=$imgURL");
        }
        if (isset($_GET['onemonth'])) 
        {
	$imgName = $_GET['imgName'];
        $imgURL = $_GET['imgURL'];
            $time = 2419200;
            header("location: /createToken.php?timeExpiration=$time&imgName=$imgName&imgURL=$imgURL");
        }   
    ?>
  </body>

</html>