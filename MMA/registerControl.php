<?php

namespace MicrosoftAzure\Storage\Samples;
require_once "vendor/autoload.php";
require 'azureconnection.php';
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

    SESSION_start();
    require 'connection.php';

    if ($_POST['email']=='' || $_POST['psw']=='' || $_POST['name']=='' || $_POST['surname']=='') {
        header("location: /register.php");
        return;
    }
    $_SESSION['resultRegistration'] = 0;

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $query='SELECT email FROM users WHERE email="'.$email.'"';
    echo $query;
    $sth1 = $pdo->prepare($query);
    $sth1->execute();
    $resultVerification = $sth1->fetch(\PDO::FETCH_ASSOC);

    if($resultVerification["email"]==$email){
        $_SESSION['resultRegistration'] = 2;
        header("location: /register.php");
    }
    else{
        $query1="INSERT INTO users (Nome, Cognome, Email, Password) VALUES ('".$name."','".$surname."','".$email."','".$psw."')";
        $sth2 = $pdo->prepare($query1);
        $bool=$sth2->execute();

        if($bool==true){
            sleep(2);
            
            $containerName = ($surname);
            echo "</br></br></br>";
            //var_dump($containerName);
            $containerNameLow = strtolower($containerName);
            var_dump($containerName);

            try{
                /*$createContainerOptions = new CreateContainerOptions();

                // Set public access policy. Possible values are
                $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
                $container=$blobClient->createContainer($containerNameLow, $createContainerOptions);*/
                createContainer($blobClient,$containerNameLow);
            }
            catch(ServiceException $e) 
            {
                $code = $e->getCode();
                
                $error_message = $e->getMessage();
                echo $code.": ".$error_message.PHP_EOL;
            }
            //header("location: /index.php");
        }
        else {
            header("location: /register.php");
            $_SESSION['resultRegistration'] = 1;
        }
    
}

function createContainer($blobClient,$name)
{
    $createContainerOptions = new CreateContainerOptions();
    $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
    var_dump($createContainerOptions);
    var_dump($createContainerOptions->getPublicAccess());
    try {
        $container=$blobClient->createContainer($name, $createContainerOptions);
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message.PHP_EOL;
    }
}
