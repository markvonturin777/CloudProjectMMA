<?php
    SESSION_start();

    require 'connection.php';

	$imgName = $_GET['imgName'];
        $query='SELECT id FROM foto WHERE nome="'.$imgName.'"';
        //echo $query;
        $sth1 = $pdo->prepare($query);
        $sth1->execute();
        $resultVerification = $sth1->fetch(\PDO::FETCH_ASSOC);
    
        if($resultVerification["id"] == ""){
            echo "not the shark you're looking for";
        }
        else
        {
            $idfoto = $resultVerification["id"];

            $query1='SELECT idfoto,expiring_date FROM token WHERE idfoto="'.$idfoto.'"';
            //echo $query1;
            $sth2 = $pdo->prepare($query1);
            $sth2->execute();
            $resultVerification2 = $sth2->fetch(\PDO::FETCH_ASSOC);
    
            if($resultVerification2["idfoto"] == "")
            {
                echo "not the shark you're looking for";
            }
            else
            {
		//http://localhost:2000/tokenizedImage.php?imgName=kachoww.jpg&imgURL=https://blobexamplephp.blob.core.windows.net/stronzo/kachoww.jpg
                $currentDate = date("Y/m/d").date("h:i:s");
		$queryExpireDate = date("Y-m-d h:i:s", $resultVerification2["expiring_date"]);
                if($currentDate < $queryExpireDate)
                    echo "not the shark you're looking for";
                else 
                    echo "<img src=". $_GET['imgURL']."  class='img-fluid' alt='img' height='400' width='400'><br/><br/> ";

            }
		
            //header("location: /homepage.php");
        }

 