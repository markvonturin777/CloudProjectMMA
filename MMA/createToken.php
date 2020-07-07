<?php
    SESSION_start();

    require 'connection.php';

	echo $_GET['imgName']; 
	echo "<br><br><br><br>";
    if( isset($_SESSION["nome"]) ){

	$imgName = $_GET['imgName'];
        $query='SELECT id,nome,data FROM foto WHERE nome="'.$imgName.'"';
        echo $query;
	echo "<br><br><br><br>";
        $sth1 = $pdo->prepare($query);
        $sth1->execute();
        $resultVerification = $sth1->fetch(\PDO::FETCH_ASSOC);


    	echo $resultVerification["nome"]."porcodio";
	echo "<br><br><br><br>";
        if($resultVerification["nome"] == ""){
            //header("location: /homepage.php");
        }
        else
        {
	    $iduser = $_GET['id'];
            $time = $_GET['timeExpiration'];
            $imgId = $resultVerification["id"];
            $imgURL = $_GET["imgURL"];
            //$imgUploadDate = //$resultVerification["data"]; //si prende l'ora corrente e si calcola dal tempo quando scade
		echo "prova";
		if($time == 3600)
			$imgexpiredate=mktime(date("h")+1, date("i"), date("s"),date("m"),date("d"),date("Y"));
		else if($time == 43200)
		{
			if(date("h") > 11)
			{
				$Hvalue = date("h");
				$Hvalue = ($Hvalue + 12) - 24;
				$imgexpiredate=mktime($Hvalue, date("i"), date("s"),date("m"),date("d")+1,date("Y"));
			}
			else
				$imgexpiredate=mktime(date("h")+12, date("i"), date("s"),date("m"),date("d"),date("Y"));
	
		}
		else if($time == 86400)
			$imgexpiredate=mktime(date("h"), date("i"), date("s"),date("m"),date("d")+1,date("Y"));
		else if($time == 604800)
		{
			if(date("d") > 23)
			{
				$Dvalue = date("d");
				$Dvalue = ($Dvalue+ 7) - 30;
				$imgexpiredate=mktimedate(date("h"), date("i"), date("s"),date("m")+1,$Dvalue,date("Y"));
			}
			else
				$imgexpiredate=mktime(date("h"), date("i"), date("s"),date("m"),date("d")+7,date("Y"));
		}
		else if($time == 2419200)
			$imgexpiredate=mktime(date("h"), date("i"), date("s"),date("m")+1,date("d"),date("Y"));


            $query1="INSERT INTO token (expiring_date, tokentime, generated_token, idfoto, iduser) VALUES ('".$imgexpiredate."','".$time."','".$imgURL."','".$imgId."','".$iduser."')";
            $sth2 = $pdo->prepare($query1);
            $bool=$sth2->execute();
	    header("location: /tokenizedImage.php?imgName=$imgName&imgURL=$imgURL");

		echo "<br><br><br><br>";
		echo "MAKETIME : ".date("Y-m-d h:i:s", $imgexpiredate);

            
        }
    }
 