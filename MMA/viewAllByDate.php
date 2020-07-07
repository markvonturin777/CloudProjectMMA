<?php

<<<<<<< HEAD



=======
<<<<<<< HEAD



=======
namespace MicrosoftAzure\Storage\Samples;
>>>>>>> dfc9568bc4abb9c563ddd4e9e6dcd669c54d9752
>>>>>>> 43dc006b259dbeca3b28081a175fcea5e0b11e32
SESSION_start();
if( !isset($_SESSION["nome"]) ){
  header("location: index.php");
  exit();
}
<<<<<<< HEAD
require_once(__DIR__ . '/photo.php');
=======
<<<<<<< HEAD
require_once(__DIR__ . '/photo.php');
=======
>>>>>>> dfc9568bc4abb9c563ddd4e9e6dcd669c54d9752
>>>>>>> 43dc006b259dbeca3b28081a175fcea5e0b11e32
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 43dc006b259dbeca3b28081a175fcea5e0b11e32
</head>
<body>
<input type="button" value="Homepage" class="homebutton" id="btnHome" 
onClick="document.location.href='homepage.php'" />
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
<<<<<<< HEAD
=======

</body>
</html>


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



foreach ($result->getBlobs() as $blob) // rendo piu semplice l'oggetto blob memorizzando  nome url e data
{
    $photo = new Photo();
    $photo->name = $blob->getName();
    $photo->url = $blob->getUrl();
    $photo->date = $blob->getProperties()->getCreationTime()->format("F j, Y, g:i a");


    $blobEasy[] = $photo;

      
    };



    usort($blobEasy, function($a, $b)
    {
    $date1 = strtotime($a->date);
    $date2 = strtotime($b->date);
    if ($date1 < $date2) return -1;
    if ($date1 == $date2) return 0;
    if ($date1 > $date2) return 1;
    });
    

    foreach ($blobEasy as $blob)
    {  
        
        
?>
<li>

    <div class="introClass">
        <?php 
            echo($blob->name);
        ?>
              
        <img src="<?php  echo $blob->url ?>"  class="img-fluid" onclick="Details.php" alt="img" height="200" width="200"><br/><br/> 
      
        <?php echo $blob->date;

      
    
        



     
        ?>
        
=======
    </head>
    <body>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
>>>>>>> 43dc006b259dbeca3b28081a175fcea5e0b11e32

</body>
</html>


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



foreach ($result->getBlobs() as $blob) // rendo piu semplice l'oggetto blob memorizzando  nome url e data
{
    $photo = new Photo();
    $photo->name = $blob->getName();
    $photo->url = $blob->getUrl();
    $photo->date = $blob->getProperties()->getCreationTime()->format("F j, Y, g:i a");


    $blobEasy[] = $photo;

      
    };



    usort($blobEasy, function($a, $b)
    {
    $date1 = strtotime($a->date);
    $date2 = strtotime($b->date);
    if ($date1 < $date2) return -1;
    if ($date1 == $date2) return 0;
    if ($date1 > $date2) return 1;
    });
    

    foreach ($blobEasy as $blob)
    {  
        
        
?>
<li>

    <div class="introClass">
        <?php 
            echo($blob->name);
        ?>
              
        <img src="<?php  echo $blob->url ?>"  class="img-fluid" onclick="Details.php" alt="img" height="200" width="200"><br/><br/> 
      
        <?php echo $blob->date;

      
    
        



     
        ?>
<<<<<<< HEAD
        
=======
>>>>>>> dfc9568bc4abb9c563ddd4e9e6dcd669c54d9752
>>>>>>> 43dc006b259dbeca3b28081a175fcea5e0b11e32
    </div>
 </li>
    
    <?php
    }
    ?> 
</div> 

<?php 
    $listBlobsOptions->setContinuationToken($result->getContinuationToken());
    } while($result->getContinuationToken());    
?>

</form>

</body>

</html>


